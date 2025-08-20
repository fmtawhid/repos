<?php

namespace App\Http\Controllers\Admin\Seo;

use App\Http\Controllers\Controller;
use App\Services\Action\SeoCheckerActionService;
use App\Services\Balance\BalanceService;
use App\Services\Model\Article\ArticleService;
use App\Traits\Api\ApiResponseTrait;
use Illuminate\Http\Request;

class SeoCheckerController extends Controller
{
    use ApiResponseTrait;



    public function index(Request $request, SeoCheckerActionService $seoCheckerActionService)
    {
        $appStatic  = appStatic();
        $jsonResult = $seoCheckerActionService->getJson();
        $seoReport  = $seoCheckerActionService->getSeoContentOptimizationAnalysis(json_decode($jsonResult, true));

        $seoFeedBackBlade = view("backend.admin.seo.render.seo-feedback")->with($seoReport)->render();
        $seoMeeterBlade   = view("backend.admin.seo.render.seo-meeter-section")->with($seoReport)->render();

        return $this->sendResponse(
            $appStatic::SUCCESS_WITH_DATA,
            "Successfully SEO Content Optimization",
            [
                "meeter"         => $seoReport["meeter"],
                "feedback_blade" => $seoFeedBackBlade,
                "meeter_blade"   => $seoMeeterBlade,
                "seo_report"     => $seoReport,
            ]
        );
    }

    public function articleSeoChecker(ArticleService $articleService, $id)
    {
        try{
            // Get the Article
            $article = $articleService->findArticleById($id);

            // Post Ownership validation
            validateRecordOwnerCheck($article);

            $data['article'] = $article;

            return view("backend.admin.seo.article.show-article-seo-checker", $data);
        }
        catch(\Throwable $e){
            wLog("Failed to show article", errorArray($e));

            flashMessage($e->getMessage(),"error");

            return redirect()->back();
        }
    }

    public function wpPostSeoChecker(ArticleService $articleService, int $id)
    {
        try{
            // Get the Article
            $article = $articleService->findArticleById($id);

            // Post Ownership validation
            validateRecordOwnerCheck($article);

            $data['article'] = $article;

            return view("backend.admin.seo.article.show-wp-post-seo-checker", $data);
        }
        catch(\Throwable $e){
            wLog("Failed to show article", errorArray($e));

            flashMessage($e->getMessage(),"error");

            return redirect()->back();
        }
    }

    public function storeWpPostSeoChecker(ArticleService $articleService, SeoCheckerActionService $seoCheckerActionService, int $id)
    {
        $appStatic = appStatic();

        try {
            // Get the Article
            $article = $articleService->findArticleById($id);

            // Post Ownership validation
            validateRecordOwnerCheck($article);

            $articlePayload = $seoCheckerActionService->prepareDataForHelpFulContentAnalysis($article);            
            $seoContent = $seoCheckerActionService->getHelpfulContentAnalysis($articlePayload);

            return $this->sendResponse(
                $appStatic::SUCCESS_WITH_DATA,
                localize("Successfully SEO Content Optimization"),
                $seoContent
            );
        } catch(\Throwable $e){
            wLog("Failed to show article", errorArray($e), logService()::LOG_SEO);

            return $this->sendResponse(
                $appStatic::NOT_FOUND,
                $e->getMessage(),
                [],
                errorArray($e)
            );
        }
    }

    public function storeArticleSeoChecker(ArticleService $articleService, SeoCheckerActionService $seoCheckerActionService, int $id)
    {
        $appStatic = appStatic();
        
        try{
            // Get the Article
            $articleObj = $articleService->findArticleById($id);
            
            // Post Ownership validation
            validateRecordOwnerCheck($articleObj);

            $articlePayload = $seoCheckerActionService->prepareDataForSeoContentOptimizationAnalysis($articleObj);

            $seoContent = $seoCheckerActionService->getSeoContentOptimizationAnalysis($articlePayload);

            // Content Optimization Balance Update
            (new BalanceService())->seoContentOptimizationBalanceUpdate(getUserObject());

            return $this->sendResponse(
                $appStatic::SUCCESS_WITH_DATA,
                localize("Successfully SEO Content Optimization"),
                $seoContent
            );
        }
        catch(\Throwable $e){
            wLog("Failed to show article", errorArray($e), logService()::LOG_SEO);

            return $this->sendResponse(
                $appStatic::NOT_FOUND,
                $e->getMessage(),
                [],
                errorArray($e)
            );
        }

    }
}
