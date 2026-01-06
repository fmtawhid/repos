<?php

namespace App\Services\Business;

use App\Models\Subscription;
use App\Models\SubscriptionCategory;
use App\Models\SubscriptionUser;
use App\Models\SubscriptionUserUsage;
use App\Models\UserSubscription;
use App\Models\UserUsage;

class SubscriptionService
{

    public function getSubscriptions()
    {

        return Subscription::query()->filters()->paginate(maxPaginateNo());
    }

    public function getActiveSubscriptions()
    {

        return Subscription::query()->where("is_active", 1)->paginate(maxPaginateNo());
    }

    public function getSubscriptionCategories()
    {

        return SubscriptionCategory::query()->get();
    }

    public function storeSubscription($payloads)
    {

        return Subscription::query()->create($payloads);
    }

    public function getSubscriptionById($subscriptionId)
    {

        return Subscription::query()->findOrFail($subscriptionId);
    }

    public function purchaseSubscription(object $subscription)
    {

        // User Subscription
        $payloads = [
            "subscription_id"      => $subscription->id,
            "subscription_title"   => $subscription->title,
            "subscription_type"    => $subscription->subscription_type,
            "total_products_limit" => $subscription->total_products_limit ?? 0,
            "total_teams_limit"    => $subscription->total_team_limit ?? 0,
            "is_ai_included"       => $subscription->is_ai_included ?? 0,
            "is_pos_included"      => $subscription->is_pos_included ?? 0,
            "price"                => $subscription->price ?? 0,
            "discount_value"       => $subscription->discount_value ?? 0,
            "discount_type"        =>  $subscription->discount_type ?? 0,
            "discounted_price"     => $subscription->discounted_price ?? 0,
            "duration"             => $subscription->duration,
            "rank"                 => $subscription->rank  ?? 0,
            "start_datetime"       => now(),
            "end_datetime"         => now()->addDays($subscription->duration),
            "is_activated"         => 2,
        ];

        $userSubscription = UserSubscription::query()->create($payloads);

        return $userSubscription;
    }

    /**
     * After Successful Payment Activate Subscription
     * */
    public function activateSubscriptionAfterSuccessfulPayment()
    {
        if (!isLoggedIn()) {

            flashMessage("error", "Session expired. Please try again");

            return redirect("/login");
        }


        $subscription_id = session('subscription_id');
        $amount          = session('amount');
        $gateway         = session("gateway");
        $active_now      = session("active_now");


        if (empty($subscription_id && $amount && $gateway && $active_now)) {

            flashMessage("error", "Session expired. Please try again");

            return redirect("/");
        }

        $subscription   = $this->getSubscriptionById($subscription_id);
        $paymentGateway = paymentGateway($gateway);

        $userSubscription = UserSubscription::query()
            ->where("user_id", getUserParentId())
            ->where("subscription_id", $subscription->id)
            ->latest()
            ->firstOrFail();

        // Update  is_activated
        $userSubscription->update([
            "is_activated" => 1,
            "paid_amount" => $userSubscription->discounted_price
        ]);

        // Create User Usage
        $payloads = [
            "user_id"              => $userSubscription->user_id,
            "subscription_id"      => $subscription->id,
            "user_subscription_id" => $userSubscription->id,
            "total_products_limit" => $userSubscription->total_products_limit,
            "total_teams_limit"    => $userSubscription->total_teams_limit,
        ];

        $userUsage = $this->storeUserUsage($payloads);

        // Update User Current subscription_plan
        $userSubscription->user?->update([
            "user_subscription_id" => $userSubscription->id
        ]);

        return $userUsage;
    }

    public function storeUserSubscription(array $payloads)
    {
        return UserSubscription::query()->create($payloads);
    }

    public function storeUserUsage(array $payloads)
    {
        return UserUsage::query()->create($payloads);
    }

    public function getPurchasedSubscriptions()
    {

        if (isAdmin()) {
            $subscriptions = UserSubscription::query()
                ->with(["subscription", "paymentGateway", "user"])
                ->latest()
                ->paginate(maxPaginateNo());
        } else {
            $subscriptions = user()->subscriptions()->paginate(maxPaginateNo());
        }

        return $subscriptions;
    }


    public function getUserSubscriptionsByUserId($userId)
    {

        return UserSubscription::query()
            ->with(["subscription", "usage"])
            ->where("user_id", $userId)
            ->paginate(maxPaginateNo());
    }


    public function getUserSubscriptions() {

        return UserSubscription::query()
            ->with(["subscription", "usage"])
            ->paginate(maxPaginateNo());
    }

    
    public function getSubscriptionUserUsageByUserIdAndSubscriptionPlanId($userId, $subscriptionPlanId)
    {

        return SubscriptionUserUsage::query()
            ->where('user_id', $userId)
            ->where('subscription_plan_id', $subscriptionPlanId)
            ->latest()
            ->first();
    }

    public function getSubscriptionUserByUserIdAndSubscriptionId($userId, $subscriptionPlanId)
    {
        return SubscriptionUser::query()
            ->where('user_id', $userId)
            ->where('subscription_plan_id', $subscriptionPlanId)
            ->where('subscription_status', appStatic()::PLAN_STATUS_ACTIVE)
            ->first() ?? [];
    }

    /**
     * Assign a subscription plan to a user (used for starter/free plans at registration)
     *
     * @param object $payloads
     * @return SubscriptionUser
     */
    public function assignSubscriptionPlan($payloads)
    {
        $subscription_plan_id = $payloads->subscription_plan_id;

        $subscriptionUser = new SubscriptionUser();
        $subscriptionUser->start_at             = date('Y-m-d');
        $subscriptionUser->expire_at            = planEndDate($subscription_plan_id);
        $subscriptionUser->subscription_plan_id = $subscription_plan_id;
        $subscriptionUser->subscription_status  = appStatic()::PLAN_STATUS_ACTIVE;
        $subscriptionUser->payment_status       = appStatic()::PAYMENT_STATUS_PAID;
        $subscriptionUser->price                = $payloads->payment_amount ?? 0;
        $subscriptionUser->payment_gateway_id   = $payloads->payment_method ?? null;
        $subscriptionUser->payment_details      = $payloads->payment_details ?? null;
        $subscriptionUser->note                 = $payloads->note ?? null;
        $subscriptionUser->forcefully_active    = 1;
        $subscriptionUser->is_active            = 1;
        $subscriptionUser->created_by_id        = userID() ?? null;
        $subscriptionUser->user_id              = $payloads->user_id ?? session()->get('s_customer_id');
        $subscriptionUser->save();

        return $subscriptionUser;
    }

    /**
     * Create usage record for a given subscription user
     *
     * @param object|SubscriptionUser $subscriptionUser
     * @return SubscriptionUserUsage
     */
    public function assignSubscriptionPlanUsage(object $subscriptionUser)
    {
        $plan = \App\Models\SubscriptionPlan::find($subscriptionUser->subscription_plan_id);

        $userUsage = new SubscriptionUserUsage();
        $userUsage->subscription_user_id      = $subscriptionUser->id;
        $userUsage->subscription_plan_id      = $plan->id ?? $subscriptionUser->subscription_plan_id;
        $userUsage->start_at                  = date('Y-m-d');
        $userUsage->expire_at                 = planEndDate($userUsage->subscription_plan_id);
        $userUsage->platform                  = 1;
        $userUsage->has_monthly_limit         = 1;

        // branches
        $userUsage->allow_unlimited_branches = $plan->allow_unlimited_branches ?? 0;
        $userUsage->branch_balance           = $plan->total_branches ?? 0;
        $userUsage->branch_balance_used      = 0;
        $userUsage->branch_balance_remaining = $plan->total_branches ?? 0;

        $userUsage->allow_kitchen_panel      = $plan->allow_kitchen_panel ?? 0;
        $userUsage->allow_reservations       = $plan->allow_reservations ?? 0;
        $userUsage->allow_support            = $plan->allow_support ?? 0;
        $userUsage->allow_team               = $plan->allow_team ?? 0;

        $userUsage->is_active                = \appStatic()::ACTIVE;
        $userUsage->user_id                  = $subscriptionUser->user_id;
        $userUsage->created_by_id            = userID() ?? null;
        $userUsage->subscription_status      = appStatic()::PLAN_STATUS_ACTIVE;
        $userUsage->save();

        return $userUsage;
    }
}
