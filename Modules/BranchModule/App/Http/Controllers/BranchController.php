<?php

namespace Modules\BranchModule\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Balance\BalanceService;
use App\Traits\Api\ApiResponseTrait;
use App\Utils\AppStatic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\BranchModule\App\Http\Requests\Branch\BranchStoreRequest;
use Modules\BranchModule\App\Http\Requests\Branch\BranchUpdateRequest;
use Modules\BranchModule\App\Services\BranchService;
use Modules\BranchModule\App\Models\Branch;

class BranchController extends Controller
{
    use ApiResponseTrait;
    protected $appStatic;
    protected $service;

    public function __construct()
    {
        $this->appStatic   = new AppStatic();
        $this->service     = new BranchService();
    }

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data["branches"] = $this->service->getAll(true);

            return view('branchmodule::branches.list', $data)->render();
        }

        return view("branchmodule::branches.index");
    }


    // public function store(BranchStoreRequest $request)
    // {
    //     try {
    //         DB::beginTransaction();

    //         // Check is branch creation limit already reached
    //         $activePlan = userActivePlan();

    //         if(!$activePlan->allow_unlimited_branches && $activePlan->branch_balance_remaining <= 0){
    //             return $this->sendResponse(
    //                 $this->appStatic::VALIDATION_ERROR,
    //                 localize("You have reached the limit of branches"),
    //             );
    //         }


    //         $data = $request->getValidatedData();

    //         // Branch Data Storing
    //         $branch = $this->service->store($data);

    //         // Update Branch Balance
    //         (new BalanceService())->updateBranchBalance(getUserObject(), 1);

    //         DB::commit();

    //         return $this->sendResponse(
    //             $this->appStatic::SUCCESS_WITH_DATA,
    //             localize("Branch Created Successfully"),
    //             $branch
    //         );
    //     } catch (\Throwable $e) {

    //         DB::rollBack();

    //         wLog("Failed to store Branch", errorArray($e));
    //         return $this->sendResponse(
    //             $this->appStatic::VALIDATION_ERROR,
    //             localize("Failed to create Branch")." | ".$e->getMessage(),
    //             [],
    //             errorArray($e)
    //         );
    //     }
    // }
    public function store(BranchStoreRequest $request)
{
    try {
        DB::beginTransaction();

        // Check is branch creation limit already reached
        $activePlan = userActivePlan();

        // handle array/object both
        $allowUnlimitedBranches = is_array($activePlan)
            ? ($activePlan['allow_unlimited_branches'] ?? false)
            : ($activePlan->allow_unlimited_branches ?? false);

        $branchBalanceRemaining = is_array($activePlan)
            ? ($activePlan['branch_balance_remaining'] ?? 0)
            : ($activePlan->branch_balance_remaining ?? 0);

        if (!$allowUnlimitedBranches && $branchBalanceRemaining <= 0) {
            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("You have reached the limit of branches"),
            );
        }

        $data = $request->getValidatedData();

        // Branch Data Storing
        $branch = $this->service->store($data);

        // Update Branch Balance
        (new BalanceService())->updateBranchBalance(getUserObject(), 1);

        DB::commit();

        return $this->sendResponse(
            $this->appStatic::SUCCESS_WITH_DATA,
            localize("Branch Created Successfully"),
            $branch
        );
    } catch (\Throwable $e) {

        DB::rollBack();

        wLog("Failed to store Branch", errorArray($e));
        return $this->sendResponse(
            $this->appStatic::VALIDATION_ERROR,
            localize("Failed to create Branch") . " | " . $e->getMessage(),
            [],
            errorArray($e)
        );
    }
}


    public function edit(Request $request, $id)
    {

        return $this->sendResponse(
            appStatic()::SUCCESS_WITH_DATA,
            localize("Edit Branch"),
            $this->service->findbyid($id)
        );
    }


    public function update(BranchUpdateRequest $request, Branch $branch)
    {
        try {
            DB::beginTransaction();

            $data = $request->getValidatedData();
            $branch->update($data);

            DB::commit();

            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("Branch Updated Successfully"),
                $branch
            );
        } catch (\Throwable $e) {

            DB::rollBack();

            wLog("Failed to store Branch", errorArray($e));

            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to Update Branch"),
                [],
                errorArray($e)
            );
        }
    }

    public function destroy(Request $request, Branch $branch)
    {
        if ($request->ajax()) {
            try {

                return $this->sendResponse(
                    $this->appStatic::SUCCESS,
                    localize("Branch successfully deleted"),
                    $branch->delete()
                );
            }
            catch (\Throwable $e) {

                wLog("Failed to Delete Branch", errorArray($e));

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
