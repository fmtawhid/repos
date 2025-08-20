<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Area\AreaStoreRequest;
use App\Http\Requests\Admin\Area\AreaUpdateRequest;
use App\Models\Area;
use App\Services\Area\AreaService;
use App\Traits\Api\ApiResponseTrait;
use App\Utils\AppStatic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\BranchModule\App\Services\BranchService;

class AreaController extends Controller
{

    use ApiResponseTrait;
    protected $appStatic;
    protected $service;
    protected $branchesService;

    public function __construct()
    {
        $this->appStatic   = new AppStatic();
        $this->service     = new AreaService();
        $this->branchesService = new BranchService();
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data["areas"]      = $this->service->getAll(true);

            return view('backend.admin.areas.list', $data)->render();
        }

        $data["branches"] = $this->branchesService->getAll(false);

        return view("backend.admin.areas.index")->with($data);
    }


    public function store(AreaStoreRequest $request) {
        try {
            DB::beginTransaction();

            $data = $request->getValidatedData();

            // dd($data);

            // Area Data Storing
            $area = $this->service->store($data);

            //store branch
            $area->branches()->attach($data["branch_ids"]);

            DB::commit();

            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("Area Created Successfully"),
                $area
            );
        } catch (\Throwable $e) {

            DB::rollBack();

            wLog("Failed to store Area", errorArray($e));

            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to create area"),
                [],
                errorArray($e)
            );
        }
    }

    public function edit(Request $request, $id)
    {
        $area = $this->service->findById($id,['branches']);

        // Vendor Validation
        vendorValidation($area);

        return $this->sendResponse(
            appStatic()::SUCCESS_WITH_DATA,
            localize("Edit Area"),
            $area
        );
    }


    public function update(AreaUpdateRequest $request, Area $area)
    {
        try {
            DB::beginTransaction();

            // Vendor Validation
            vendorValidation($area);

            $data = $request->getValidatedData();

            $area->update($data);

            $area->branches()->sync($data["branch_ids"]);

            DB::commit();

            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("Area Updated Successfully"),
                $area
            );
        }
        catch (\Throwable $e) {

            DB::rollBack();

            wLog("Failed to store Area", errorArray($e));

            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to Update Area")." | ".$e->getMessage(),
                [],
                errorArray($e)
            );
        }
    }

    public function destroy(Request $request, Area $area)
    {
        if ($request->ajax()) {
            try {

                // Vendor Validation
                vendorValidation($area);

                $area->branches()->detach();
                $area->delete();

                return $this->sendResponse(
                    $this->appStatic::SUCCESS,
                    localize("Area successfully deleted")
                );
            }
            catch (\Throwable $e) {

                wLog("Failed to Delete Area", errorArray($e));

                return $this->sendResponse(
                    $this->appStatic::VALIDATION_ERROR,
                    localize("Failed to Delete Area")." | ".$e->getMessage(),
                    [],
                    errorArray($e)
                );
            }
        }
    }
}
