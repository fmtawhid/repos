<?php

namespace Modules\BranchModule\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\Api\ApiResponseTrait;
use App\Utils\AppStatic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\BranchModule\App\Models\Branch;
use Modules\BranchModule\App\Services\BranchService;

class BranchController extends Controller
{
    use ApiResponseTrait;

    protected $appStatic;
    protected $service;

    public function __construct()
    {
        $this->appStatic = new AppStatic();
        $this->service   = new BranchService();
    }

    /**
     * Display list (with trash)
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data['branches'] = Branch::withTrashed()
                ->latest()
                ->paginate(10);

            return view('branchmodule::branches.list', $data)->render();
        }

        return view('branchmodule::branches.index');
    }

    /**
     * Store
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $branch = $this->service->store($request->all());

            DB::commit();
            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("Branch Created Successfully"),
                $branch
            );

        } catch (\Throwable $e) {
            DB::rollBack();
            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                $e->getMessage()
            );
        }
    }

    /**
     * Edit
     */
    public function edit($id)
    {
        return $this->sendResponse(
            $this->appStatic::SUCCESS_WITH_DATA,
            localize("Edit Branch"),
            Branch::withTrashed()->findOrFail($id)
        );
    }

    /**
     * Update
     */
    public function update(Request $request, Branch $branch)
    {
        DB::beginTransaction();
        try {

            $branch->update($request->all());

            DB::commit();
            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("Branch Updated Successfully"),
                $branch
            );

        } catch (\Throwable $e) {
            DB::rollBack();
            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                $e->getMessage()
            );
        }
    }

    /**
     * Soft delete
     */
    public function destroy(Request $request, $id)
    {
        $branch = Branch::findOrFail($id);

        if ($request->ajax()) {
            try {
                $branch->delete(); // SOFT DELETE

                return $this->sendResponse(
                    $this->appStatic::SUCCESS,
                    "Branch Soft Deleted Successfully"
                );
            } catch (\Throwable $e) {
                return $this->sendResponse(
                    $this->appStatic::VALIDATION_ERROR,
                    $e->getMessage()
                );
            }
        }
    }

    /**
     * Restore
     */
    public function restore($id)
    {
        $branch = Branch::onlyTrashed()->findOrFail($id);
        $branch->restore();

        return $this->sendResponse(
            $this->appStatic::SUCCESS,
            "Branch Restored Successfully",
            $branch
        );
    }

    /**
     * Force delete
     */
    public function forceDelete($id)
    {
        $branch = Branch::onlyTrashed()->findOrFail($id);

        DB::transaction(function () use ($branch) {
            // ⚠️ adjust relations if needed
            // $branch->areas()->forceDelete();
            // $branch->tables()->forceDelete();
            $branch->forceDelete();
        });

        return $this->sendResponse(
            $this->appStatic::SUCCESS,
            "Branch Permanently Deleted"
        );
    }
}
