<?php

namespace Modules\KitchenManager\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\Api\ApiResponseTrait;
use App\Utils\AppStatic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\BranchModule\App\Services\BranchService;
use Modules\KitchenManager\App\Http\Requests\Kitchen\KitchenStoreRequest;
use Modules\KitchenManager\App\Http\Requests\Kitchen\KitchenUpdateRequest;
use Modules\KitchenManager\App\Models\Kitchen;
use Modules\KitchenManager\App\Services\KitchenService;

class KitchenController extends Controller
{
    use ApiResponseTrait;
    protected $appStatic;
    protected $service;
    protected $branchService;

    public function __construct()
    {
        $this->appStatic     = new AppStatic();
        $this->service       = new KitchenService();
        $this->branchService = new BranchService();
    }

    # get all kitchens
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data["branches"] = $this->branchService->getAll(null, true);

        // If the request is an AJAX request, return the kitchens list view
        if ($request->ajax()) {
            $data["kitchens"] = $this->service->getAll(true);

            return view('kitchenmanager::kitchens.list', $data)->render();
        }

        return view("kitchenmanager::kitchens.index")->with($data);
    }

    /**
     * store a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(KitchenStoreRequest $request)
    {
        try {
            DB::beginTransaction();

            // is kitchen allowed to current subscription
            if( userActivePlan()["allow_kitchen_panel"] == 0){
                return $this->sendResponse(
                    $this->appStatic::VALIDATION_ERROR,
                    localize("You are not allowed to create a Kitchen"),
                );
            }

            $data = $request->getValidatedData();

            // Kitchen Data Storing
            $kitchen = $this->service->store($data);

            DB::commit();

            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("Kitchen Created Successfully"),
                $kitchen
            );
        } catch (\Throwable $e) {

            DB::rollBack();

            wLog("Failed to store Kitchen", errorArray($e));
            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to create Kitchen")." | ".$e->getMessage(),
                [],
                errorArray($e)
            );
        }
    }

    // edit a resource
    public function edit(Request $request, $id)
    {

        return $this->sendResponse(
            appStatic()::SUCCESS_WITH_DATA,
            localize("Edit Kitchen"),
            $this->service->findbyid($id)
        );
    }


    // update a resource
    public function update(KitchenUpdateRequest $request, Kitchen $kitchen)
    {
        try {
            DB::beginTransaction();

            $data = $request->getValidatedData();
            $kitchen->update($data);

            DB::commit();

            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("Kitchen Updated Successfully"),
                $kitchen
            );
        } catch (\Throwable $e) {

            DB::rollBack();

            wLog("Failed to store Kitchen", errorArray($e));

            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to Update Kitchen"),
                [],
                errorArray($e)
            );
        }
    }

    // delete a resource
    public function destroy(Request $request, Kitchen $kitchen)
    {
        if ($request->ajax()) {
            try {

                return $this->sendResponse(
                    $this->appStatic::SUCCESS,
                    localize("Kitchen successfully deleted"),
                    $kitchen->delete()
                );
            }
            catch (\Throwable $e) {

                wLog("Failed to Delete Kitchen", errorArray($e));

                return $this->sendResponse(
                    $this->appStatic::VALIDATION_ERROR,
                    localize("Failed to Delete : ") . $e->getMessage(),
                    [],
                    errorArray($e)
                );
            }
        }
    }
}
