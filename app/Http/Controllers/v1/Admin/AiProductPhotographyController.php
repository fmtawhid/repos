<?php

namespace App\Http\Controllers\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Image\AiProductShotRequest;
use App\Services\Action\AiProductPhotographyActionService;
use App\Traits\Api\ApiResponseTrait;
use Illuminate\Http\Request;

class AiProductPhotographyController extends Controller
{
    private $aiService;

    use ApiResponseTrait;
    public function __construct()
    {
        $this->aiService = new AiProductPhotographyActionService();
    }

    public function getThemes()
    {
        try {
            $themes = $this->aiService->getThemes();
            return response()->json(['success' => true, 'themes' => $themes]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function index(Request $request)
    {
        $data["dimensions"] = $this->aiService->getDimensions();

        if($request->ajax()){
            $data["themes"] = $this->aiService->getThemes();

            return $this->sendResponse(
                appStatic()::SUCCESS_WITH_DATA,
                "AI Product Shot Themes",
                view("backend.admin.images.product-shot.ajax-product-shot-theme")->with($data)->render()
            );
        }

        return view("backend.admin.images.product-shot.index")->with($data);
    }

    public function generateProductShotImage(AiProductShotRequest $request)
    {
        try{
            if(!hasBalance(appStatic()::PURPOSE_IMAGE)) {
                return $this->sendResponse(
                    appStatic()::BALANCE_ERROR,
                    localize("your subscription image balance empty"),
                );
            }

            // Check Valid Feature.
            checkValidCustomerFeature(allowAiProductShot());

            \DB::beginTransaction();

            $createBackground = $this->aiService->createBackground($request->file("image"), $request->theme_id, getUserObject());

            \DB::commit();

            flashMessage(localize("Successfully Product Shot Generated"));

            return to_route("admin.images.index");
        }
        catch(\Throwable $e){
            \DB::rollBack();
            wLog("Failed to Generate Product Shot", errorArray($e));
            flashMessage($e->getMessage(), "error");

            return redirect()->back();
        }
    }


}
