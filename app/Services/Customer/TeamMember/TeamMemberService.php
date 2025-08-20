<?php

namespace App\Services\Customer\Subscriptions;

use App\Models\SubscriptionPlan;
use App\Models\SubscriptionUser;
use App\Services\Model\SubscriptionPlan\SubscriptionPlanService;
use App\Services\Model\User\UserService;

class TeamMemberService {

    public function index() :array
    {
        $data = [];
        $data["team_members"]  = (new UserService())->getAll(true, null,null,true);
        return $data;
    }

    public function allPlanHistory()
    {
        return SubscriptionUser::with('customer', 'plan')->paginate(maxPaginateNo());
    }
}
