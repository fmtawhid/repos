<?php

namespace App\Http\Controllers\Admin\Image;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Image\DallE2Request;
use App\Http\Requests\Admin\Image\DallE3Request;
use App\Http\Requests\Admin\StableDiffusion\Image2ImageUpScaleRequest;
use App\Http\Requests\Admin\StableDiffusion\Text2ImageMultiPromptRequest;
use App\Http\Requests\Admin\StableDiffusion\Text2ImageRequest;
use App\Services\Balance\BalanceService;
use App\Services\Integration\IntegrationService;
use App\Services\Model\GeneratedImage\GeneratedImageService;
use App\Traits\Api\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stability;

class ImageGenerateController extends Controller
{
    use ApiResponseTrait;
    public $appStatic;
    protected $generatedImageService;
    public function __construct()
    {
        $this->appStatic = appStatic();
        $this->generatedImageService = new GeneratedImageService();
    }

    public function index(Request $request)
    {
        $data["images"] = $this->generatedImageService->getAll();

        if($request->ajax()){

            return view('backend.admin.images.image-list', $data)->render();
        }

        return view("backend.admin.images.index")->with($data);
    }

    public function generateImage(Request $request)
    {

        return $request->all();
    }

    public function dallE2(DallE2Request $request, IntegrationService $integrationService)
    {
        set_time_limit(120);

        try{
            if(!hasBalance(appStatic()::PURPOSE_IMAGE)) {
                return $this->sendResponse(
                    $this->appStatic::BALANCE_ERROR,
                    localize("your subscription image balance empty"),
                );
            }

            DB::beginTransaction();

            $dallE2 = $integrationService->imageGenerator($this->appStatic::ENGINE_OPEN_AI, $request);
            (new BalanceService())->updateImageBalance(getUserObject(), $request->number_of_results);
               
              

            DB::commit();



            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                $this->appStatic::MESSAGE_IMAGE_GENERATED,
                $dallE2,
                [],
                
            );
        }
        catch(\Throwable $e){
            DB::rollBack();

            return $this->sendResponse($this->appStatic::VALIDATION_ERROR, $e->getMessage(), [], errorArray($e));
        }
    }

    public function dallE3(DallE3Request $request, IntegrationService $integrationService)
    {
        set_time_limit(120);
        try{
            if(!hasBalance(appStatic()::PURPOSE_IMAGE)) {
                return $this->sendResponse(
                    $this->appStatic::BALANCE_ERROR,
                    localize("your subscription image balance empty"),
                );
            }
            DB::beginTransaction();
            $dallE3 = $integrationService->imageGenerator($this->appStatic::ENGINE_OPEN_AI, $request);
       
            (new BalanceService())->updateImageBalance(getUserObject(), $request->number_of_results);
            
            DB::commit();

            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                $this->appStatic::MESSAGE_IMAGE_GENERATED,
                $dallE3
            );
        }
        catch(\Throwable $e){
            DB::rollBack();

            return $this->sendResponse($this->appStatic::VALIDATION_ERROR, $e->getMessage(), [], errorArray($e));
        }
    }

    public function sdText2Image(Text2ImageRequest $request, IntegrationService $integrationService)
    {
        set_time_limit(120);

        try{
            if(!hasBalance(appStatic()::PURPOSE_IMAGE)) {
                return $this->sendResponse(
                    $this->appStatic::BALANCE_ERROR,
                    localize("your subscription image balance empty"),
                );
            }
            DB::beginTransaction();

            $sdText2Image = $integrationService->imageGenerator($this->appStatic::ENGINE_STABLE_DIFFUSION, $request);
           
            (new BalanceService())->updateImageBalance(getUserObject(), $request->number_of_results);
            
            DB::commit();

            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                $this->appStatic::MESSAGE_IMAGE_GENERATED,
                $sdText2Image
            );
        }
        catch(\Throwable $e){
            DB::rollBack();

            return $this->sendResponse($this->appStatic::VALIDATION_ERROR, $e->getMessage(), [], errorArray($e));
        }
    }

    public function sdImage2ImageMultiPrompt(Text2ImageMultiPromptRequest $request, IntegrationService $integrationService)
    {
        set_time_limit(120);

        try{
            if(!hasBalance(appStatic()::PURPOSE_IMAGE)) {
                return $this->sendResponse(
                    $this->appStatic::BALANCE_ERROR,
                    localize("your subscription image balance empty"),
                );
            }

            DB::beginTransaction();

            $sdText2Image = $integrationService->imageGenerator($this->appStatic::ENGINE_STABLE_DIFFUSION, $request);
            (new BalanceService())->updateImageBalance(getUserObject(), $request->number_of_results);

            DB::commit();

            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                $this->appStatic::MESSAGE_IMAGE_GENERATED,
                $sdText2Image
            );
        }
        catch(\Throwable $e){
            DB::rollBack();

            return $this->sendResponse($this->appStatic::VALIDATION_ERROR, $e->getMessage(), [], errorArray($e));
        }
    }




    public function sdImage2ImagePrompt(Request $request, IntegrationService $integrationService)
    {
        try{
            if(!hasBalance(appStatic()::PURPOSE_IMAGE)) {
                return $this->sendResponse(
                    $this->appStatic::BALANCE_ERROR,
                    localize("your subscription image balance empty"),
                );
            }
            DB::beginTransaction();
            $request["content_purpose"] = appStatic()::SD_IMAGE_2_IMAGE_PROMPT;
            $sdText2Image               = $integrationService->imageGenerator($this->appStatic::ENGINE_STABLE_DIFFUSION, $request);

            (new BalanceService())->updateImageBalance(getUserObject(), $request->number_of_results);

           DB::commit();

            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                $this->appStatic::MESSAGE_IMAGE_GENERATED,
                $sdText2Image
            );
        }
        catch(\Throwable $e){
            DB::rollBack();

            return $this->sendResponse($this->appStatic::VALIDATION_ERROR, $e->getMessage(), [], errorArray($e));
        }

    }

    public function sdImage2ImageMasking(Request $request, IntegrationService $integrationService)
    {
        try{
            if(!hasBalance(appStatic()::PURPOSE_IMAGE)) {
                return $this->sendResponse(
                    $this->appStatic::BALANCE_ERROR,
                    localize("your subscription image balance empty"),
                );
            }
            DB::beginTransaction();

            $sdText2Image = $integrationService->imageGenerator($this->appStatic::ENGINE_STABLE_DIFFUSION, $request);
            (new BalanceService())->updateImageBalance(getUserObject(), $request->number_of_results);

            DB::commit();

            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                $this->appStatic::MESSAGE_IMAGE_GENERATED,
                $sdText2Image
            );
        }
        catch(\Throwable $e){
            DB::rollBack();

            return $this->sendResponse($this->appStatic::VALIDATION_ERROR, $e->getMessage(), [], errorArray($e));
        }

    }

    public function sdImage2ImageUpscale(Image2ImageUpScaleRequest $request, IntegrationService $integrationService)
    {
        try{
            if(!hasBalance(appStatic()::PURPOSE_IMAGE)) {
                return $this->sendResponse(
                    $this->appStatic::BALANCE_ERROR,
                    localize("your subscription image balance empty"),
                );
            }
            DB::beginTransaction();

            $sdText2Image = $integrationService->imageGenerator($this->appStatic::ENGINE_STABLE_DIFFUSION, $request);
            (new BalanceService())->updateImageBalance(getUserObject(), $request->number_of_results);

            DB::commit();

            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                $this->appStatic::MESSAGE_IMAGE_GENERATED,
                $sdText2Image
            );
        }
        catch(\Throwable $e){
            DB::rollBack();

            return $this->sendResponse($this->appStatic::VALIDATION_ERROR,
                $e->getMessage(), [], errorArray($e));
        }
    }

    public function destroy(Request $request)
    {
        try {
            
            if ($request->ajax()) {
                $this->generatedImageService->delete($request->id);
                return $this->sendResponse(
                    $this->appStatic::SUCCESS,
                    localize("Successfully deleted AI Content"),
                   
                );
            }
        } catch (\Throwable $e) {
            wLog("Failed to Delete Template", errorArray($e));
            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to Delete : ") . $e->getMessage(),
                [],
                errorArray($e)
            );
        }
    }

}
