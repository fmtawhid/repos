<?php

namespace App\Http\Controllers\Admin\Balance;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ContentBalanceUpdateRequest;
use App\Services\AiData\AiDataService;
use App\Services\Balance\BalanceService;
use App\Traits\Api\ApiResponseTrait;
use Illuminate\Http\Request;

class BalanceUpdateController extends Controller
{
    use ApiResponseTrait;

    public $balanceService;
    public function __construct()
    {
        $this->balanceService = new BalanceService();
    }

    /**
     * @throws \JsonException
     */
    public function updateBalance(ContentBalanceUpdateRequest $request, AiDataService $aiDataService)
    {
        info("i am in to calculate & update User Balance : ".json_encode($request->all()));

        $appStatic       = appStatic();
        $sessionLab      = sessionLab();
        $calculationType = (string) $request->calculation_type;
        $platform        = (string) $request->platform;
        // Open AI + Article Content Balance Update
        if(isArticleGenerating($calculationType)){
            //if($platform === $appStatic::ENGINE_OPEN_AI){
               info("Balance Update for Article Generation");
              
                 $this->balanceService->openAiWordBalanceUpdate();
   
                session()->forget($sessionLab::SESSION_ARTICLE_PROMPT);
                session()->forget($sessionLab::SESSION_ARTICLE_CONTENTS);
                session()->forget($sessionLab::SESSION_ARTICLE_TITLE);
                session()->forget($sessionLab::SESSION_ARTICLE_ID);
                session()->forget($sessionLab::SESSION_ARTICLE_OUTLINES);
                session()->forget($sessionLab::SESSION_ARTICLE_PLATFORM);
            //}
        }
       
        // Generate Text
        else if(isAiText($calculationType)){
            $this->balanceService->openAiWordBalanceUpdate();

            session()->forget($sessionLab::SESSION_GENERATE_TEXT);
            session()->forget($sessionLab::SESSION_GENERATE_TEXT_ID);
        }

        // Template Content
        else if(isAiTemplate($calculationType)){
            $this->balanceService->openAiWordBalanceUpdate();
            session()->forget($sessionLab::SESSION_TEMPLATE_CONTENTS);
            session()->forget($sessionLab::SESSION_TEMPLATE_PROMPT);

        }

        // Chat
        else if(isAiChat($calculationType)){
       
            $this->balanceService->openAiWordBalanceUpdate();

            session()->forget($sessionLab::SESSION_AI_CHAT_PROMPT);
            session()->forget($sessionLab::SESSION_AI_CHAT_CONTENTS);
            session()->forget($sessionLab::SESSION_CHAT_EXPERT_ID);
            session()->forget($sessionLab::SESSION_CHAT_THREAD_ID);
        }

        // Chat
        else if(isAiPdf($calculationType)){
            $this->balanceService->openAiWordBalanceUpdate();

           session()->forget($sessionLab::SESSION_PDF_CHAT_PDF_CONTENT);
           session()->forget($sessionLab::SESSION_PDF_STREAM_CONTENT);
        }

        // Code Generation Balance Update
        else if(isAiCode($calculationType)){
            // TODO :: Code Balance Update
        }

        // AI Vision Balance Update
        else if(isAiVision($calculationType)){
            $this->balanceService->openAiWordBalanceUpdate();

            session()->forget($sessionLab::SESSION_CHAT_RANDOM_NUMBER);
            session()->forget($sessionLab::SESSION_AI_VISION_PROMPT);
            session()->forget($sessionLab::SESSION_AI_VISION_CONTENTS);
            session()->forget($sessionLab::SESSION_CHAT_THREAD_ID);
            session()->forget($sessionLab::SESSION_CHAT_EXPERT_ID);
        }

        else if($calculationType === $appStatic::PURPOSE_IMAGE){
            
        }

        $type = $request->type;
        $view = view('backend.admin.balance.index', compact('type'))->render();
     
        return $this->sendResponse(
            $appStatic::SUCCESS_WITH_DATA,
            localize("Your balance has been successfully updated"),
            $view,
            [],
            [
                "incomingParams" => $request->all()
            ]
        );
    }

}
