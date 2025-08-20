<?php

namespace App\Services\Model\SubscriptionPlan;

use App\Models\Template;
use App\Models\PaymentGateway;
use App\Models\SubscriptionPlan;
use App\Services\Model\PaymentGateway\PaymentGatewayService;
use App\Services\Model\TemplateCategory\TemplateCategoryService;
use App\Services\Model\OfflinePaymentMethod\OfflinePaymentMethodService;

class SubscriptionPlanService
{
    public function index():array
    {
        $data = [];
        $data["packages"] = $this->getAll(true, null);
        $data["payments"]  = $this->payments();
        $data["offlinePaymentMethods"]  = (new OfflinePaymentMethodService())->getAll(false, 1);
        return $data;
    }

    public function getAll(
        $isPaginateGetOrPluck = null,
        $onlyActives = null,
        $withRelationships = ["updatedBy", "createdBy"])
    {

        $query = SubscriptionPlan::query()->filters()->whereNull('deleted_at');

        // Bind Relationships
        (!empty($withRelationships) ? $query->with($withRelationships) : false);

        if(!is_null($onlyActives)){
            $query->isActive($onlyActives);
        }

        if (is_null($isPaginateGetOrPluck)) {
            return $query->pluck("title", "id");
        }

        return $isPaginateGetOrPluck ? $query->paginate(maxPaginateNo()) : $query->get();
    }

    public function findSubscriptionPlanById($id, $withRelationships = [], $conditions = [])
    {
        $query = SubscriptionPlan::query();

        // Bind Relationships
        !empty($withRelationships) ? $query->with($withRelationships) : false;

        return $query->findOrFail($id);
    }

    public function store(array $payloads)
    {
        return SubscriptionPlan::query()->create($payloads);
    }

    public function update(object $package, array $payloads)
    {
        $package->update($payloads);

        return $package;
    }

    public function storeNewSubscriptionPlan($request)
    {
        if($request->has('package_id') && !empty($request->package_id)) {
            $plan                   = $this->findSubscriptionPlanById($request->package_id);
            $copyPlan               = $plan->replicate();
            $copyPlan->package_type = $request->package_type ?? 'monthly';
            $copyPlan->save();

            return $copyPlan;
        }

        $payloads = [
            "title"                          => "New Plan",
            "slug"                           => slugMaker("New Plan"),
            "description"                    => "Get started with our new package",
            "is_active"                      => appStatic()::ACTIVE,
            "package_type"                   => $request->package_type ?? 'monthly',
        ];

        return SubscriptionPlan::query()->create($payloads);
    }

    public function updatePlan($request)
    {
        if($request->package_id) {
           $column            = str_replace('package-', '', $request->name);
            $subscriptionPlan = $this->findSubscriptionPlanById($request->package_id);

            $subscriptionPlan->update([
                $column => $request->value
            ]);

           return $subscriptionPlan;
        }
    }

    public function starterPlan():object|null
    {
        return SubscriptionPlan::query()
            ->where('package_type', appStatic()::PACKAGE_TYPE_STARTER)
            ->where('is_active', appStatic()::ACTIVE)
            ->first();
    }

    public function plans($type = null)
    {
        $type = $type ?? 'monthly';

        return SubscriptionPlan::query()
            ->where('package_type', $type)
            ->where('is_active', 1)
            ->get();
    }

    public function payments()
    {
        return (new PaymentGatewayService())->paymentGateways([],false, true);
    }

    public function templates($id):array
    {
        $data                        = [];
        $subscription_plan           = $this->findSubscriptionPlanById($id);
        $data['subscription_plan']   = $subscription_plan;
        return $data;
    }
}