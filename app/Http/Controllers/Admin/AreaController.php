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
        $this->appStatic       = new AppStatic();
        $this->service         = new AreaService();
        $this->branchesService = new BranchService();
    }

    // INDEX WITH AJAX + TRASHED
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data['areas'] = Area::with(['branches'])
                                ->withTrashed()
                                ->latest()
                                ->paginate(10);

            return view('backend.admin.areas.list', $data)->render();
        }

        $data['branches'] = $this->branchesService->getAll(false);

        return view("backend.admin.areas.index")->with($data);
    }

    // STORE
    public function store(AreaStoreRequest $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->getValidatedData();

            $area = $this->service->store($data);

            // Attach branches
            $area->branches()->attach($data['branch_ids']);

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
                localize("Failed to create Area"),
                [],
                errorArray($e)
            );
        }
    }

    // EDIT
    public function edit(Request $request, $id)
    {
        $area = $this->service->findById($id, ['branches']);
        vendorValidation($area);

        return $this->sendResponse(
            appStatic()::SUCCESS_WITH_DATA,
            localize("Edit Area"),
            $area
        );
    }

    // UPDATE
    public function update(AreaUpdateRequest $request, Area $area)
    {
        try {
            DB::beginTransaction();

            vendorValidation($area);

            $data = $request->getValidatedData();

            $area->update($data);
            $area->branches()->sync($data['branch_ids']);

            DB::commit();

            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("Area Updated Successfully"),
                $area
            );
        } catch (\Throwable $e) {
            DB::rollBack();
            wLog("Failed to update Area", errorArray($e));
            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to Update Area"),
                [],
                errorArray($e)
            );
        }
    }

    // SOFT DELETE
    public function destroy(Request $request, Area $area)
    {
        if ($request->ajax()) {
            try {
                vendorValidation($area);
                $area->delete();

                return $this->sendResponse(
                    $this->appStatic::SUCCESS,
                    localize("Area successfully deleted")
                );
            } catch (\Throwable $e) {
                wLog("Failed to Delete Area", errorArray($e));
                return $this->sendResponse(
                    $this->appStatic::VALIDATION_ERROR,
                    localize("Failed to Delete Area") . " | " . $e->getMessage(),
                    [],
                    errorArray($e)
                );
            }
        }
    }

    // RESTORE TRASHED
    public function restore($id)
    {
        $area = Area::onlyTrashed()->findOrFail($id);
        vendorValidation($area);
        $area->restore();

        return redirect()->back()->with('success', localize("Area restored successfully"));
    }

    // FORCE DELETE
    public function forceDelete(Request $request, $id)
    {
        if ($request->ajax()) {
            $area = Area::onlyTrashed()->findOrFail($id);
            vendorValidation($area);
            DB::beginTransaction();
            try {
                // detach branches
                $area->branches()->detach();

                // force delete area
                $area->forceDelete();

                DB::commit();

                return $this->sendResponse(
                    $this->appStatic::SUCCESS,
                    localize("Area permanently deleted")
                );
            } catch (\Throwable $e) {
                DB::rollBack();
                return $this->sendResponse(
                    $this->appStatic::VALIDATION_ERROR,
                    localize("Failed to force delete Area") . " | " . $e->getMessage(),
                    [],
                    errorArray($e)
                );
            }
        }

    }
}
