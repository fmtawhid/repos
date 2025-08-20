<?php

namespace App\Http\Controllers\Admin\Subscription;

use Illuminate\Http\Request;
use App\Models\SubscriptionPlan;
use App\Http\Controllers\Controller;
use App\Traits\Api\ApiResponseTrait;
use App\Services\Model\SubscriptionPlan\SubscriptionPlanService;
use Illuminate\Support\Facades\DB;

class SubscriptionPlanController extends Controller
{
    use ApiResponseTrait;
    protected $appStatic;
    protected $packageService;
    public function __construct()
    {
        $this->appStatic = appStatic();
        $this->packageService = new SubscriptionPlanService();
    }
    public function index(Request $request)
    {
        $data = $this->packageService->index();
        if ($request->ajax()) {
            return view('backend.admin.subscription-plan.plan-list', $data)->render();
        }
        return view("backend.admin.subscription-plan.index")->with($data);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $subscription = $this->packageService->storeNewSubscriptionPlan($request);

            DB::commit();

            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("Successfully stored Subscription Plan"),
                $subscription
            );
        } catch (\Throwable $e) {
            DB::rollBack();

            wLog("Failed to Store Subscription Plan", errorArray($e));

            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to store Subscription Plan"),
                [],
                errorArray($e)
            );
        }
    }
    public function edit(SubscriptionPlan $subscriptionPlan)
    {
        $view = view('backend.admin.subscription-plan.inc.edit-plan', compact('subscriptionPlan'))->render();
        return $this->sendResponse(
            $this->appStatic::SUCCESS_WITH_DATA,
            localize("Successfully retrieved Subscription Plan"),
            $view
        );
    }



    public function update(Request $request, SubscriptionPlan $SubscriptionPlan)
    {
        $data = $this->packageService->update($SubscriptionPlan, $request->getData());
        return $this->sendResponse(
            $this->appStatic::SUCCESS_WITH_DATA,
            localize("Successfully Subscription Plan Updated"),
           
        );
    }
    public function updatePlan(Request $request)
    {
        try{
            $data = $this->packageService->updatePlan($request);

            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("Successfully Subscription Plan Updated"),
            );
        }
        catch(\Throwable $e){

            wLog("Failed to update subscription Plan", errorArray($e));

            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to update Subscription Plan."),
                [],
                errorArray($e)
            );
        }
    }

    public function destroy(Request $request, SubscriptionPlan $SubscriptionPlan)
    {
        try {
            if ($request->ajax()) {
                return $this->sendResponse(
                    $this->appStatic::SUCCESS,
                    localize("Successfully deleted Subscription Plan"),
                    $SubscriptionPlan->delete()
                );
            }
        } catch (\Throwable $e) {
            wLog("Failed to Delete Subscription Plan", errorArray($e));
            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to delete the folder"),
                [],
                errorArray($e)
            );
        }
    }
    public function getPrice($id)
    {
        $plan = $this->packageService->findSubscriptionPlanById($id);
        return $this->sendResponse(
            $this->appStatic::SUCCESS_WITH_DATA,
            localize("Successfully Subscription Plan retrieved"),['price'=>$plan->price]
           
        );
    }

}