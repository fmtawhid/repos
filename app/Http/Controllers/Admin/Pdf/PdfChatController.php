<?php

namespace App\Http\Controllers\Admin\Pdf;

use App\Utils\AppStatic;
use App\Utils\SessionLab;
use App\Models\ChatExpert;
use Illuminate\Http\Request;
use function Pest\Laravel\json;
use App\Services\Chat\ChatService;
use App\Services\Model\PdfService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Traits\Api\ApiResponseTrait;
use App\Traits\File\FileUploadTrait;
use App\Http\Requests\Admin\Chat\ChatStoreRequest;
use App\Services\Model\ChatExpert\ChatExpertService;
use App\Services\Model\ChatThread\ChatThreadService;
use App\Http\Resources\Admin\ChatThreadMessage\ChatThreadMessageResource;

class PdfChatController extends Controller
{
    use ApiResponseTrait;
    use FileUploadTrait;
    public function aiPdfChat(Request $request, ChatService $chatService, AppStatic $appStatic)
    {
        $request["type"]            = $appStatic::PURPOSE_PDF;
        $request['content_purpose'] = $appStatic::PURPOSE_PDF;
        $data                       = $chatService->aiPdfChatGetData($request);
       
        if ($request->ajax()) {
            $chat_threads = $request->render_type == 'threads' ?  view("backend.admin.chats.chat_threads", $data)->render() : false;
            return $this->sendResponse(
                \appStatic()::SUCCESS_WITH_DATA,
                localize("Pdf Chats fetched successfully."),
                $chat_threads,
                [],
                [
                    "messages" => view("backend.admin.chats.chat_messages",  ["messages" => $data['messages'], ["chat_thread_id" => $data['chat_thread_id']]])->render(),
                    "chat_thread_id" => $data['chat_thread_id']
                ]
            );
        }

         return view("backend.admin.chats.index")->with($data);
    }



    /**
     * PDF Chat
     *
     * Step 1,2 : Generate a dynamic filename of the uploadble file ex. a1b2c3.pdf & Upload it to the desired folders & return from the trait file with file path location including file name
     * Step 3 : Parse the PDF file and get the text from it
     * Step 3.1 : Upload it to the S3 if the settings is enabled
     * Step 4 : Make embed vector from the parsed text of PDF.
     * Step 5 : Declare a parameter called $prompt and store user input prompt into $prompt variable
     * Step 6 : Make embed vector from the prompt user input.
     * Step 7 : Combine the two embed vectors and return similarity score
     * Step 8 : declare a final prompt from variable
     * Step 9 : Make a Chat Completion from OpenAI API
     * */
    public function pdfChatEmbedding(ChatStoreRequest $request, PdfService $pdfService, AppStatic  $appStatic, ChatThreadService $chatThreadService)
    {
        try {
            DB::beginTransaction();
            $pdfFile = $request->file("pdfFile");
            session([SessionLab::SESSION_CHAT_THREAD_ID => $request->chat_thread_id]);
            // Step 1 & 2 : Generate a dynamic filename of the uploadble file ex. a1b2c3.pdf & Upload it to the desired folders & return from the trait file with file path location including file name
            $destinationDir = fileService()::TEMP_PDF_DIR."/parent_user_id_".userID();
            $uploadedPdfFile = $this->uploadFile($pdfFile, $destinationDir,false);
            // Step 3 : Parse the PDF file and get the text from it
            $pdfBodyText = $pdfService->getText($uploadedPdfFile);
            $pageBody    = $pdfBodyText;
            // Step 3.1 : Upload it to the S3 if the settings is enabled
            //TODO::S3 Bucket Upload

            if (!mb_check_encoding($pdfBodyText, 'UTF-8')) {
                $pageBody = mb_convert_encoding($pdfBodyText, 'UTF-8', mb_detect_encoding($pdfBodyText));
            }

            info("Before storing PDF Body : " . $pageBody);
            session([SessionLab::SESSION_PDF_CHAT_PDF_CONTENT => $pageBody]);

            // Step 4 : Make embed vector from the parsed text of PDF.
            $pdfBodyEmbed = $pdfService->getEmbeddingData($pdfBodyText);

            #    Log::info("PDF Body  Embedding : ".json_encode($pdfBodyEmbed));

            $isOpenAiRaiseError = isOpenAiRaiseError($pdfBodyEmbed);

            if($isOpenAiRaiseError != false){
                DB::rollBack();

                return $this->sendResponse(
                    $appStatic::FALSE,
                    "Error is : $isOpenAiRaiseError",
                    [],
                    $isOpenAiRaiseError
                );
            }

            // Step 5 : Declare a parameter called $prompt and store user input prompt into $prompt variable
            $prompt = $request->prompt ?? $request->message;

            // Step 6 : Make embed vector from the prompt user input.
            $promptEmbed = $pdfService->getEmbeddingData($prompt);

            #  Log::info("Prompt Embedding : ".json_encode($promptEmbed));

            $isOpenAiRaiseError = isOpenAiRaiseError($promptEmbed);

            if($isOpenAiRaiseError != false){
                DB::rollBack();

                return $this->sendResponse(
                    $appStatic::VALIDATION_ERROR,
                    "Embedding Error : {$isOpenAiRaiseError}",
                    $isOpenAiRaiseError
                );
            }

            /**
             * ============ Store the PDF Chat Conversation Start ================
             * */

            $payloads = [
                "prompt"                   => $prompt,
                "file_content"             => $pageBody,
                "file_path"                => $uploadedPdfFile,
                "file_embedding_content"   => $pdfBodyEmbed,
                "prompt_embedding_content" => $promptEmbed
            ];


            $chatThreadConversation = $chatThreadService->storeChatThreadMessage($request, $payloads);
            //TODO::Need to store the chat thread conversation random number in session

            /**
             * ============ Store the PDF Chat Conversation End ================
             * */

            $getSimilarityScore = $pdfService->getSimilarityScore($pageBody, $promptEmbed, $pdfBodyEmbed);

            #     Log::info("Similarity : ".json_encode($getSimilarityScore));

            DB::commit();

            $sessionLab = new SessionLab();
            // Chat Thread Conversation Random Number saving to session.
            setSession($sessionLab::SESSION_CHAT_RANDOM_NUMBER, $chatThreadConversation->random_number);

            // Chat Thread Conversation ID saving to session.
            setSession($sessionLab::SESSION_CHAT_THREAD_CONVERSATION_ID, $chatThreadConversation->id);

            // Chat Thread Pdf Content saving to session.
            setSession($sessionLab::SESSION_PDF_CHAT_PDF_CONTENT, $chatThreadConversation->file_content);

            // Chat Thread Prompt Content saving to session.
            setSession($sessionLab::SESSION_PDF_CHAT_PROMPT_CONTENT, $chatThreadConversation->prompt);

            return $this->sendResponse(
                $appStatic::SUCCESS_WITH_DATA,
                localize("PDF Chat Processed Successfully"),
                view("backend.admin.chats.chat_body_me", ["message" => $chatThreadConversation,"rawFile" =>true])->render()
            );
        }
        catch (\Throwable $e){
            DB::rollBack();
            Log::info("Failed to Embedding PDF and action ".json_encode(errorArray($e)));
            return $this->sendResponse(
                $appStatic::VALIDATION_ERROR,
                $e->getMessage(),
                [],
                errorArray($e)
            );
        }
    }

}
