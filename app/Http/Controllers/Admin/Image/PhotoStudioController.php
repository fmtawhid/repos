<?php

namespace App\Http\Controllers\Admin\Image;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Image\PhotoStudioRequest;
use App\Services\Action\PhotoStudioActionService;
use App\Services\Business\PhotoStudioService;
use App\Traits\Api\ApiResponseTrait;
use Illuminate\Http\Request;

class PhotoStudioController extends Controller
{
    use ApiResponseTrait;

    public $photoStudioActionService;

    public function __construct()
    {
        $this->photoStudioActionService = new PhotoStudioActionService();
    }

    public function index(Request $request)
    {
        $data["images"] = $this->photoStudioActionService->getPhotoStudioByUserId(getUserParentId());

        $data["photoStudioArr"] = appStatic()::PHOTO_STUDIO_ACTION_ARR;

        return view("backend.admin.images.photo-studio.index")->with($data);
    }

    public function generatePhotoStudioImage(PhotoStudioRequest $request)
    {
        set_time_limit(-1);

        try{
            if(!hasBalance(appStatic()::PURPOSE_IMAGE)) {
                return $this->sendResponse(
                    appStatic()::BALANCE_ERROR,
                    localize("your subscription image balance empty"),
                );
            }

            // Check Valid Feature.
            checkValidCustomerFeature(allowAiPhotoStudio());


            \DB::beginTransaction();

            $photoStudio = $this->photoStudioActionService->generatePhotoStudioImage(
                (int) $request->action,
                $request->validated(),
                getUserObject()
            );

            \DB::commit();

            flashMessage(localize("Successfully Photo Studio Generated"));

            return to_route("admin.images.index");
        }
        catch(\Throwable $e){
            \DB::rollBack();
            wLog("Failed to Generate Photo Studio", errorArray($e));

            flashMessage($e->getMessage(), "error");

            return back();
        }

    }


}
