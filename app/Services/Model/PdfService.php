<?php
namespace App\Services\Model;

use App\Models\ChatThreadMessage;
use App\Services\Balance\BalanceService;
use App\Services\OpenAi\OpenAiService;
use Illuminate\Support\Facades\Log;

class PdfService
{
    const SESSION_PDF_CHAT_CONVERSATION = "pdfChatConversation";
    const SESSION_PDF_CHAT_PDF_CONTENT  = "pdfChatPdfContent";
    const SESSION_PDF_CHAT_PROMPT_CONTENT  = "pdfChatPromptContent";
    CONST SESSION_PDF_CHAT_CODE = "chat_code";


    public function storePdfConversation(array $payloads)
    {
        return ChatThreadMessage::query()->create($payloads);
    }

    public function getEmbeddingData($contents)
    {
        $openAi = (new OpenAiService())->initOpenAi();

        $embed = $openAi->embeddings([
            'input' => $contents,
            'model' => appStatic()::TEXT_EMBEDDING,
        ]);

        if (!empty($embed)){
            $embedJsonDecode = convertJsonDecode($embed);


            // Embedding Balance Update Added.
            (new BalanceService())->embedWordBalanceUpdate($contents);

            return isset($embedJsonDecode["data"], $embedJsonDecode["data"][0], $embedJsonDecode["data"][0]["embedding"][0]) ? $embedJsonDecode["data"][0]["embedding"] : $embedJsonDecode;
        }

        return null;
    }

    public function getSimilarityScore($pageBody,$promptEmbeddingContent, $pdfEmbeddingContent)
    {
        $results = [];
        $similarity = $this->cosineSimilarity($promptEmbeddingContent, $pdfEmbeddingContent);

        Log::info("Similarity Score Found : ".json_encode($similarity));

        $results[] = [
            'id' => 1,
            'content' => $pageBody,
            'similarity' => $similarity,
        ];

        usort($results, function ($a, $b) {
            return $b['similarity'] <=> $a['similarity'];
        });

        $result = "";
        $resArr = array_slice($results, 0, 5);
        foreach ($resArr as $item) {
            $result = $result . $item['content'] . "\n\n\n";
        }

        Log::info("Step 9 : Before calling chat completionFinal Content As Result : ".json_encode($result));

        return $result;

    }

    public function cosineSimilarity($u, $v)
    {
        $dotProduct = 0;
        $uLength    = 0;
        $vLength    = 0;
        $iMax       = count($u);

        for ($i = 0; $i < $iMax; $i++)
        {
            $dotProduct += $u[$i] * $v[$i];
            $uLength += $u[$i] * $u[$i];
            $vLength += $v[$i] * $v[$i];
        }

        $uLength = sqrt($uLength);
        $vLength = sqrt($vLength);

        return $dotProduct / ($uLength * $vLength);
    }

    public function getText($pdfFileWithDirectory) : string
    {
        $file = public_path($pdfFileWithDirectory);

        info("File Path to get text: ".$file);

        return initPdfParser()->parseFile($file)->getText();
    }

    public function pageBody($pdfFileWithDirectory)
    {
        $pdfBodyText = $this->getText($pdfFileWithDirectory);
        if (!mb_check_encoding($pdfBodyText, 'UTF-8')) {
            $pageBody = mb_convert_encoding($pdfBodyText, 'UTF-8', mb_detect_encoding($pdfBodyText));
        }
        return $pageBody;
    }

    public function pdfChatFinalPrompt($userPrompt, $pdfContent)
    {
        $sofliq =  "'this pdf' means pdf content. Do not reference previous chats, when user asking about pdf. Include reference pdf content when user only ask about the pdf. Otherwise response as assistant in short and professional and don't refere the pdf content. \n\n\n User Question: {$userPrompt} \n\n\nPDF content: {$pdfContent}";

        return $sofliq;
    }


    public function chatCompletionFinal($finalPrompt, $userPrompt, $pdfContent)
    {
        $openAi = initOpenAi();


        $completion =  $openAi->chat();

        $completion = convertJsonDecode($completion);

        $responseContent = isset($completion["choices"][0], $completion["choices"][0]["message"], $completion["choices"][0]["message"]["content"]) ? $completion["choices"][0]["message"]["content"] : null;

        return $responseContent;
    }

 

    public function updateAiResponse($pdfChatConversation, $aiResponse = null)
    {
        if(empty($aiResponse)) {
            return null;
        }

        $pdfChatConversation->update([
            "ai_response" => $aiResponse
        ]);

        return $pdfChatConversation;
    }

    public function setPdfSessionChatCode($chatCode)
    {
        session()->put(["chat_code" => $chatCode]);
    }

    public function getPdfSessionChatCode()
    {
       return  session("chat_code");
    }

 





    public function parseChatResponse($chatResponse = null)
    {
        $text = $output ="";
        if (!empty($chatResponse)) {
            foreach ($chatResponse as $singleData) {
                if (!empty($singleData)) {
                    $singleData = convertJsonDecode(trim($singleData));

                    if (isset($singleData["choices"][0]["delta"]["content"])) {
                        $content = $singleData["choices"][0]["delta"]["content"];
                        $text   .= $content;
                        $output .= $content;
                    }
                }
            }
        }

        return [
            "text" => $text,
            "output" => $output
        ];
    }

}
