<?php

namespace App\Services\Action;

use App\Models\SubscriptionUser;
use App\Services\Business\SubscriptionService;

/**
 * Class SubscriptionActionService.
 */
class SubscriptionActionService
{
    private $subscriptionService;

    public function __construct()
    {
        $this->subscriptionService = new SubscriptionService();
    }

    public function assignSubscriptionPlan($payloads)
    {
        return $this->subscriptionService->assignSubscriptionPlan($payloads);
    }


    public function assignSubscriptionPlanUsage(object $subscriptionUser)
    {
        return $this->subscriptionService->assignSubscriptionPlanUsage($subscriptionUser);
    }

    public function getSubscriptionUserUsageByUserIdAndSubscriptionPlanId($userId, $subscriptionPlanId)
    {
        return $this->subscriptionService->getSubscriptionUserUsageByUserIdAndSubscriptionPlanId($userId, $subscriptionPlanId);
    }

    public function getSubscriptionUserByUserIdAndSubscriptionPlanId($userId, $subscriptionPlanId)
    {
        return $this->subscriptionService->getSubscriptionUserByUserIdAndSubscriptionId($userId, $subscriptionPlanId);
    }
}
