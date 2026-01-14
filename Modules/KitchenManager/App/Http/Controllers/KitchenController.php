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
        $this->appStatic = new AppStatic();
        $this->service = new KitchenService();
        $this->branchService = new BranchService();
    }

    // List kitchens (with trashed)
    public function index(Request $request)
    {
        $data['branches'] = $this->branchService->getAll(null, true);

        if ($request->ajax()) {
            $data['kitchens'] = Kitchen::with('branch')
                ->withTrashed()
                ->latest()
                ->paginate(10);

            return view('kitchenmanager::kitchens.list', $data)->render();
        }

        return view('kitchenmanager::kitchens.index')->with($data);
    }

    // Store new kitchen
    public function store(KitchenStoreRequest $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->getValidatedData();
            $kitchen = $this->service->store($data);

            DB::commit();
            return $this->sendResponse($this->appStatic::SUCCESS_WITH_DATA, "Kitchen Created Successfully", $kitchen);

        } catch (\Throwable $e) {
            DB::rollBack();
            wLog("Failed to store Kitchen", errorArray($e));
            return $this->sendResponse($this->appStatic::VALIDATION_ERROR, "Failed to create Kitchen", [], errorArray($e));
        }
    }

    // Edit kitchen
    public function edit($id)
    {
        return $this->sendResponse($this->appStatic::SUCCESS_WITH_DATA, "Edit Kitchen", $this->service->findById($id));
    }

    // Update kitchen
    public function update(KitchenUpdateRequest $request, Kitchen $kitchen)
    {
        try {
            DB::beginTransaction();
            $data = $request->getValidatedData();
            $kitchen->update($data);
            DB::commit();

            return $this->sendResponse($this->appStatic::SUCCESS_WITH_DATA, "Kitchen Updated Successfully", $kitchen);

        } catch (\Throwable $e) {
            DB::rollBack();
            wLog("Failed to update Kitchen", errorArray($e));
            return $this->sendResponse($this->appStatic::VALIDATION_ERROR, "Failed to Update Kitchen", [], errorArray($e));
        }
    }

    // Soft delete
    public function destroy(Request $request, Kitchen $kitchen)
    {
        if ($request->ajax()) {
            try {
                $kitchen->delete();
                return $this->sendResponse($this->appStatic::SUCCESS, "Kitchen Soft Deleted Successfully");
            } catch (\Throwable $e) {
                wLog("Failed to Delete Kitchen", errorArray($e));
                return $this->sendResponse($this->appStatic::VALIDATION_ERROR, "Failed to Delete Kitchen", [], errorArray($e));
            }
        }
    }


    // Restore
    public function restore($id)
    {
        $kitchen = Kitchen::onlyTrashed()->findOrFail($id);
        $kitchen->restore();

        return $this->sendResponse($this->appStatic::SUCCESS, "Kitchen Restored Successfully", $kitchen);
    }

    // Force Delete
    public function forceDelete($id)
    {
        $kitchen = Kitchen::onlyTrashed()->findOrFail($id);
        $kitchen->forceDelete();

        return $this->sendResponse($this->appStatic::SUCCESS, "Kitchen Permanently Deleted");
    }

}
