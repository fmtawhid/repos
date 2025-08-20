<?php

namespace App\Traits;

use App\Models\User;
use App\Models\AffiliateEarning;
use App\Models\SubscriptionPlan;
use App\Models\SubscriptionUser;
use App\Services\Model\Affiliate\AffiliateService;
use App\Traits\File\FileUploadTrait;
use App\Models\SubscriptionUserUsage;

trait SubscribePlanTrait {
    use FileUploadTrait;
    public function storeSubscriptionUser($request)
    {
        try {
            $plan_id             = $request->package_id ?? $request->plan_id;
            $user_id             = (int)$request->user_id;
            $user                = $user_id ? User::query()->findOrFail($user_id) : user();
            $plan_id             = $plan_id ?? session('plan_id');
            $is_offline_payment  = $request->is_offline;                 
            $payment_status      = $is_offline_payment ? appStatic()::PAYMENT_STATUS_PENDING : appStatic()::PAYMENT_STATUS_PAID;
            $subscription_status = $is_offline_payment ? appStatic()::PLAN_STATUS_PENDING : appStatic()::PLAN_STATUS_ACTIVE;
            $forcefully_active   = $is_offline_payment ? 0 : 1;

            //TODO:: Service file call require
            $plan                = SubscriptionPlan::query()->findOrFail($plan_id);
            $file                = $request->file
                                    ? $this->fileProcess($request->file, fileService()::DIR_MEDIA, false, $height = 800, $width  = 800,$fileOriginalName = true) : null;

            return SubscriptionUser::query()->create([
                'start_at'             => date('Y-m-d'),
                'expire_at'            => $is_offline_payment ? null : planEndDate($plan_id),
                'subscription_plan_id' => $plan_id,
                'subscription_status'  => $subscription_status,
                'payment_status'       => $payment_status,
                'price'                => $plan->price,
                'payment_gateway_id'   => $request->payment_method,
                'offline_payment_id'   => $request->offline_payment_method,
                'payment_details'      => $request->payment_details,
                'note'                 => $request->note,
                'forcefully_active'    => $forcefully_active,
                'is_active'            => 1,
                'file'                 => $file,
                'created_by_id'        => $user->id,
                'user_id'              => $user->id,
            ]);
        } catch (\Throwable $th) {
            //throw $th;            
            throw new \RuntimeException($th->getMessage(), $th->getCode());
        }
    }
    public function paymentStatus($subscription_user_id, $payment_status = null, $data =[])
    {
        $subscription_user = SubscriptionUser::query()->findOrFail($subscription_user_id);

        if(isPaid($payment_status)) {

            // Assign the subscription plan usages balances
           $subscriptionUsage = $this->storeSubscriptionPlanUserUsage($subscription_user);  // SubscriptionUserUsage.php

           //[TODO::expire previous plan]
            $userSubscriptionExpire = $this->makeExistingUserPlanExpire($subscription_user->user); // SubscriptionUser.php

            // Update Subscription
            $updateSubscriptionUser = $this->updateSubscriptionUserExpirationStatusAndPaymentStatus($subscription_user); // SubscriptionUser.php

            // Update Purchasing user referred user affiliate balance as per settings
            $earning = $this->updatePurchasingUserReferredUserBalance($subscription_user);

            // Update User current subscription
            $userPlan = $this->updateUserCurrentSubscriptionPlanId($subscription_user); // User.php
        }
        else if(isPaymentRejected($payment_status)){
            $subscription_user->update([
                'subscription_status' => appStatic()::PLAN_STATUS_REJECTED,
                'payment_status'      => appStatic()::PAYMENT_STATUS_REJECTED
            ]);
        }
        else if(isPaymentResubmit($payment_status)){
            $feedback_note = array_key_exists('feedback_note', $data) ? $data['feedback_note'] : null;
            $subscription_user->update([
                'feedback_note'  => $feedback_note,
                'payment_status' => appStatic()::PAYMENT_STATUS_RESUBMIT
            ]);
        }


        return $subscription_user;
    }

    public function updatePurchasingUserReferredUserBalance(object $subscriptionUser): object
    {
        // Check Affiliate earning settings is enabled
        $isAffiliateEnable = (int) getSetting('enable_affiliate_system');

        // When $isAffiliateEnable == 0 means affiliate earning is disabled.
        if($isAffiliateEnable === 0) {
            return $subscriptionUser;
        }

        // Who is purchasing the plan or subscription
        $purchasingUser = $subscriptionUser->user;

        $storeAffiliateEarning = false;

        // If referred user exist
        if(!empty($purchasingUser->referred_user_id))  {

            // Referrer of the purchasing user
            $referrer = $purchasingUser->referrer;


            // Get the Referral earning settings. Will get 0 either 1. 0 means one time earning policy, 1 means continuous earning policy
            $referralEarningSettings = getSetting("enable_affiliate_continuous_commission");


            if(isOneTimeAffiliateEarning($referralEarningSettings)) {


                // Check if the referrer already earned referral commission
                $isReferredUserAlreadyEarnedCommission = (new AffiliateService())->getAffiliateEarningsByUserIdAndReferredUserId(
                    $purchasingUser->id,
                    $referrer->id
                );

                // Referrer never earned commission
                if($isReferredUserAlreadyEarnedCommission->count() <= 0) {
                    $storeAffiliateEarning = true;
                }
            }else{
                // Add New Earning from subscription purchase as referral commission
                $storeAffiliateEarning = true;
            }
        }

        if($storeAffiliateEarning){

            $affiliateEarning = (new AffiliateService())->storeAffiliateEarningAndUserBalanceUpdate($subscriptionUser);
        }

        return $subscriptionUser;
    }

    /**
     * Will update,
     *
     * start_at as today's date
     * expire_at based on subscription plan id monthly/yearly
     * subscription_status as Active
     * payment_status as paid.
     * */
    public function updateSubscriptionUserExpirationStatusAndPaymentStatus(object $subscriptionUser)
    {
        $subscriptionUser->update([
            'start_at'            => date('Y-m-d'),
            'expire_at'           => planEndDate($subscriptionUser->subscription_plan_id),
            'subscription_status' => appStatic()::PLAN_STATUS_ACTIVE,
            'payment_status'      => appStatic()::PAYMENT_STATUS_PAID
        ]);

        return $subscriptionUser;
    }

    /**
     * Will update User.php
     *
     * subscription_plan_id
     * */
    public function updateUserCurrentSubscriptionPlanId(object $subscriptionUser): object
    {
        $subscriptionUser->user?->update([
            'subscription_plan_id'=>$subscriptionUser->subscription_plan_id
        ]);

        return $subscriptionUser->user;
    }
    
    
    public function storeSubscriptionPlanUserUsage(object $subscriptionUser): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder
    {
        $plan = $subscriptionUser->plan;

        $payloadArr = [
            'subscription_user_id' => $subscriptionUser->id,
            'subscription_plan_id' => $plan->id,
            'start_at'             => date('Y-m-d'),
            'expire_at'            => planEndDate($plan->id),
            'platform'             => 1,
            'has_monthly_limit'    => 1,
            
            'allow_unlimited_branches' => $plan->allow_unlimited_branches ?? 0,
            'branch_balance'           => $plan->total_branches ?? 0,
            'branch_balance_used'      => 0,
            'branch_balance_remaining' => $plan->total_branches ?? 0,
            'allow_kitchen_panel'      => $plan->allow_kitchen_panel ?? 0,
            'allow_reservations'       => $plan->allow_reservations ?? 0,
            'allow_support'            => $plan->allow_support ?? 0,
            'allow_team'               => $plan->allow_team ?? 0,

            'is_active'           => 1,
            'user_id'             => $subscriptionUser->user_id,        // Customer ID
            'created_by_id'       => userID(),
            'subscription_status' => appStatic()::PLAN_STATUS_ACTIVE,
        ];

        return SubscriptionUserUsage::query()->create($payloadArr);
    }

    public function makeExistingUserPlanExpire(object $user)
    {
        //TODO::We may need to check user current subscription balance is carried over or not . if yes we must add the remaining balance with new subscription balance.
        $subscriptionUser = (new \App\Services\Action\SubscriptionActionService())->getSubscriptionUserByUserIdAndSubscriptionPlanId(
            $user->id, $user->subscription_plan_id
        );

        if(empty($subscriptionUser)){
            return [];
        }

        // Making Subscription as expired
        $payloadsArr = [
            "subscription_status" => appStatic()::SUBSCRIPTION_STATUS_EXPIRED,
        ];

        if(isAdmin()){
            $payloadsArr["expire_by_admin_date"] = now()->format("Y-m-d H:i:s");
        }

        $subscriptionUser->update($payloadsArr);

        // Expire User SubscriptionUserUsage too.
        $user->usage?->update($payloadsArr);



        return $subscriptionUser;
    }

    public function affiliate_system($subscription_user_id, $user_id, $price)
    {
        $user = $user_id ? User::findOrFail($user_id) : auth()->user();
        if (getSetting('enable_affiliate_system') == '1') {
            if (!is_null($user->referred_by)) {

                $giveCommission = false;
                if (getSetting('enable_affiliate_continuous_commission') == "1") {
                    $giveCommission = true;
                    $user->is_commission_calculated = 0;
                } else if ($user->is_commission_calculated == 0) {
                    $giveCommission = true;
                }

                if ($giveCommission) {
                    $referredBy = User::where('id', $user->referred_by)->first();
                    if (!is_null($referredBy)) {
                        $earning = new AffiliateEarning;
                        $earning->user_id = $user->id;
                        $earning->referred_by = $referredBy->id;
                        $earning->subscription_user_id = $subscription_user_id;
                        $earning->amount = ((float) $price * (float) getSetting('affiliate_commission')) / 100;
                        $earning->commission_rate = getSetting('affiliate_commission');
                        $earning->save();

                        $referredBy->user_balance += (float) $earning->amount;
                        $referredBy->save();
                    }
                }
            }
        }
    }
    private function limitPackagePurchase($userId = null)
    {
        $user = $userId ? User::find((int)$userId) : auth()->user();
        if (isCustomer() || $userId) {
            $package_count = SubscriptionUser::where('user_id', $user->id)->whereIn('subscription_status', [1, 3])->count();
            if ($package_count >= 2) {
                return false;
            } else {
                return true;
            }
        }
        return false;
    }

    public function tempSubscriptionUserStore(
        $planId,
        $amount,
        $paymentGatewayId,
        $paymentDetails,
        $userId
    ): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder
    {

        return SubscriptionUser::query()->create([
            'start_at'             => date('Y-m-d'),
            'expire_at'            => planEndDate($planId),
            'subscription_plan_id' => $planId,
            'subscription_status'  => appStatic()::PLAN_STATUS_ACTIVE,
            'payment_status'       => appStatic()::PAYMENT_STATUS_PAID,
            'price'                => $amount,
            'payment_gateway_id'   => $paymentGatewayId,
            'payment_details'      => $paymentDetails,
            'note'                 => '',
            'forcefully_active'    => 1,
            'is_active'            => 1,
            'created_by_id'        => $userId,
            'user_id'              => $userId,
        ]);
    }


}