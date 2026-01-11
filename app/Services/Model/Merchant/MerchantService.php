<?php

namespace App\Services\Model\Merchant;

use App\Models\Tag;
use App\Models\User;
use App\Services\Model\User\UserService;
use App\Utils\AppStatic;
use App\Models\PaymentGateway;
use App\Models\SubscriptionPlan;
use App\Models\SubscriptionUser;
use App\Models\SubscriptionUserUsage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Services\Model\SubscriptionPlan\SubscriptionPlanService;
use Carbon\Carbon;
use Throwable;

class MerchantService
{

    public function index(): array
    {
        $data = [];
        $data["merchants"] = (new UserService())->getAll(
            true,
            null,
            appStatic()::TYPE_VENDOR, false, ['plan']
        );

        $data["payment_gateways"] = PaymentGateway::where('is_active', 1)->get();
        $data["plans"]            = (new SubscriptionPlanService())->getAll(null, true);
        return $data;
    }
    public function getAll(
        $isPaginateGetOrPluck = null,
        $onlyActives = null,
        $withRelationships = ["updatedBy", "createdBy"]
    ) {

        $query = User::query()->orderBy('id', 'DESC')->filters()->where('user_type', appStatic()::TYPE_VENDOR);

        // Bind Relationships
        (!empty($withRelationships) ? $query->with($withRelationships) : false);

        // if (!is_null($onlyActives)) {
        //     $query->isActive($onlyActives,"account_status");
        // }
        // if (!is_null($onlyActives)) {
        //     $query->isActive($onlyActives,"account_status");
        // }

        if (is_null($isPaginateGetOrPluck)) {
            return $query->pluck("name", "id");
        }

        return $isPaginateGetOrPluck ? $query->paginate(maxPaginateNo()) : $query->get();
    }
    public function findUserById($id, $withRelationships = [], $conditions = [])
    {
        $query = User::query();

        // Bind Relationships
        !empty($withRelationships) ? $query->with($withRelationships) : false;

        if(!empty($conditions)){
            $query->where($conditions);
        }

        return $query->findOrFail($id);
    }

    public function store(object $payloads)
    {
        $subscription_plan_id       = $payloads->assign_plan ? $payloads->subscription_plan_id : null;
        $user                       = new User();
        // $user->name                 = $payloads->name;
        $user->first_name           = $payloads->first_name;
        $user->last_name            = $payloads->last_name;
        $user->email                = $payloads->email;
        $user->mobile_no            = $payloads->mobile_no;
        $user->user_type            = appStatic()::TYPE_VENDOR;
        $user->avatar               = $payloads->avatar;
        $user->subscription_plan_id = $subscription_plan_id;
        // Default to active when not provided
        $user->account_status       = $payloads->account_status ?? appStatic()::ACCOUNT_STATUS_ACTIVE;
        $user->email_verified_at    = Carbon::now();
        $user->password             = Hash::make($payloads->password);
        $user->save();
        if($subscription_plan_id){
            $plan = SubscriptionPlan::findOrFail($payloads->subscription_plan_id);
            if ($plan) {
                session()->put('s_merchant_id', $user->id);
                $subscriptionUser = $this->storeSubscriptionPlanUser($payloads, $payloads->subscription_plan_id);
                $this->storeSubscriptionPlanUserUsage($subscriptionUser->id, $plan);

                $package = $plan->package_type == 'starter'
                ? localize('Monthly') : localize($plan->package_type);
                $data['package']    = html_entity_decode($plan->title) .'/'.$package;
                $data['price']      = $subscriptionUser->price;
                $data['start_date'] = $subscriptionUser->start_at;
                $data['end_date']   = $subscriptionUser->expire_at;
                $data['method']     = $subscriptionUser->payment_gateway_id ? $subscriptionUser->paymentMethod->name : '';
                if($user->email) {
                    sendMail($user->email,  $user->first_name, 'add-new-merchant-welcome-email', $data);
                }
            }
        }

        return $user;
    }
    public function storeSubscriptionPlanUser($payloads, $subscription_plan_id)
    {
        $subscriptionUser = new SubscriptionUser();
        $subscriptionUser->start_at             = date('Y-m-d');
        $subscriptionUser->expire_at            = planEndDate($subscription_plan_id);
        $subscriptionUser->subscription_plan_id = $subscription_plan_id;
        $subscriptionUser->subscription_status  = appStatic()::PLAN_STATUS_ACTIVE;
        $subscriptionUser->payment_status       = appStatic()::PAYMENT_STATUS_PAID;
        $subscriptionUser->price                = $payloads->payment_amount;
        $subscriptionUser->payment_gateway_id   = $payloads->payment_method;
        $subscriptionUser->payment_details      = $payloads->payment_details;
        $subscriptionUser->note                 = $payloads->note;
        $subscriptionUser->forcefully_active    = 1;
        $subscriptionUser->is_active            = 1;
        $subscriptionUser->created_by_id        = userID();
        $subscriptionUser->user_id              = session()->get('s_merchant_id');
        $subscriptionUser->save();
        return $subscriptionUser;
    }
    public function storeSubscriptionPlanUserUsage($subscription_user_id, $plan)
    {
        $userUsage = new SubscriptionUserUsage();
        $userUsage->subscription_user_id = $subscription_user_id;
        $userUsage->subscription_plan_id = $plan->id;
        $userUsage->start_at = date('Y-m-d');
        $userUsage->expire_at = planEndDate($plan->id);
        $userUsage->platform = 1;
        $userUsage->has_monthly_limit = 1;

        // Map only the fields that exist in the `subscription_user_usages` table
        $userUsage->allow_unlimited_branches = $plan->allow_unlimited_branches ?? 0;
        $userUsage->branch_balance = $plan->branch_balance ?? 0;
        $userUsage->branch_balance_used = 0;
        $userUsage->branch_balance_remaining = $userUsage->branch_balance;

        $userUsage->allow_kitchen_panel = $plan->allow_kitchen_panel ?? 0;
        $userUsage->allow_reservations = $plan->allow_reservations ?? 0;
        $userUsage->allow_support = $plan->allow_support ?? 0;
        $userUsage->allow_team = $plan->allow_team ?? 0;

        $userUsage->is_active = \appStatic()::ACTIVE;
        $userUsage->user_id = session()->get('s_merchant_id');
        $userUsage->created_by_id = userID();
        $userUsage->subscription_status = appStatic()::PLAN_STATUS_ACTIVE;
        $userUsage->save();
        return $userUsage;
    }
    public function update($id, object $request)
    {
        $user = User::where('id', $id)->first();
        $user->email     = $request->email;
        $user->first_name      = $request->first_name;
        $user->last_name      = $request->last_name;
        $user->mobile_no = $request->mobile_no;
        $user->avatar    = $request->avatar;
        $user->save();
        return $user;
    }
    public function existUser($id, $email, $mobile_no = null)
    {
        if($email) {
           return  User::where('id', '!=', $id)->where('email', $email)->first();
        }
        if($mobile_no) {
           return  User::where('id', '!=', $id)->where('mobile_no', $mobile_no);
        }
        return false;
    }

    public function updateUserSubscriptionPlanId(object $user, $subscription_plan_id)
    {
        $user->update([
            "subscription_plan_id" => $subscription_plan_id
        ]);

        return $user;
    }
}
