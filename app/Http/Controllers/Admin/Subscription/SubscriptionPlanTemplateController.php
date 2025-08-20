<?php

namespace App\Http\Controllers\Admin\Subscription;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SubscriptionPlan;
use App\Traits\Api\ApiResponseTrait;
use App\Services\Model\SubscriptionPlan\SubscriptionPlanService;

class SubscriptionPlanTemplateController extends Controller
{
    use ApiResponseTrait;
    protected $appStatic;
    protected $packageService;
    public function __construct()
    {
        $this->appStatic = appStatic();
        $this->packageService = new SubscriptionPlanService();
    }

    public function getPackageTemplates(Request $request)
    {
        $id = $request->plan_id;
        $data = $this->packageService->templates($id);
        $data['type'] = $request->type ?? 'from-list';
        return view('backend.admin.subscription-plan.inc.templates-content', $data);
    }
    public function updateTemplates(Request $request)
    {
        try {
            $plan =  $this->packageService->findSubscriptionPlanById($request->plan_id);
            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("Successfully add template to Subscription Plan"),
            );
        } catch (\Throwable $e) {

            wLog("Failed to add template Subscription Plan", errorArray($e));

            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to add template Subscription Plan"),
                [],
                errorArray($e)
            );
        }
    }
}
