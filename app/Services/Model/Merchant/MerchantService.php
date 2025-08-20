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
        $user->account_status       = $payloads->account_status;
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
        $userUsage->subscription_user_id           = $subscription_user_id;
        $userUsage->subscription_plan_id           = $plan->id;
        $userUsage->start_at                       = date('Y-m-d');
        $userUsage->expire_at                      = planEndDate($plan->id);
        $userUsage->platform                       = 1;
        $userUsage->has_monthly_limit              = 1;
        $userUsage->word_balance                   = $plan->total_words_per_month ?? 0;
        $userUsage->word_balance_used              = 0;
        $userUsage->word_balance_remaining         = $plan->total_words_per_month ?? 0;
        $userUsage->word_balance_t2s               = $plan->total_text_to_speech_per_month ?? 0;
        $userUsage->word_balance_used_t2s          = 0;
        $userUsage->word_balance_remaining_t2s     = $plan->total_text_to_speech_per_month ?? 0;
        $userUsage->image_balance                  = $plan->total_images_per_month ?? 0;
        $userUsage->image_balance_used             = 0;
        $userUsage->image_balance_remaining        = $plan->total_images_per_month ?? 0;
        $userUsage->video_balance                  = $plan->total_ai_video_per_month ?? 0;
        $userUsage->video_balance_used             = 0;
        $userUsage->video_balance_remaining        = $plan->total_ai_video_per_month ?? 0;
        $userUsage->speech_balance                 = $plan->total_speech_to_text_per_month ?? 0;
        $userUsage->speech_balance_used            = 0;
        $userUsage->speech_balance_remaining       = $plan->total_speech_to_text_per_month ?? 0;
        $userUsage->allow_unlimited_word           = $plan->allow_unlimited_word ?? 0;
        $userUsage->allow_unlimited_text_to_speech = $plan->allow_unlimited_text_to_speech ?? 0;
        $userUsage->allow_unlimited_image          = $plan->allow_unlimited_image ?? 0;
        $userUsage->allow_unlimited_speech_to_text = $plan->allow_unlimited_speech_to_text ?? 0;
        $userUsage->speech_to_text_filesize_limit  = $plan->speech_to_text_filesize_limit ?? 0;
        $userUsage->allow_words                    = $plan->allow_words ?? 0;
        $userUsage->allow_text_to_speech           = $plan->allow_text_to_speech ?? 0;
        $userUsage->allow_ai_code                  = $plan->allow_ai_code ?? 0;
        $userUsage->allow_google_cloud             = $plan->allow_google_cloud ?? 0;
        $userUsage->allow_azure                    = $plan->allow_azure ?? 0;
        $userUsage->allow_ai_video                 = $plan->allow_ai_video ?? 0;
        $userUsage->allow_ai_chat                  = $plan->allow_ai_chat ?? 0;
        $userUsage->allow_templates                = $plan->allow_templates ?? 0;
        $userUsage->allow_ai_rewriter              = $plan->allow_ai_rewriter ?? 0;
        $userUsage->allow_ai_detector              = $plan->allow_ai_detector ?? 0;
        $userUsage->allow_ai_plagiarism            = $plan->allow_ai_plagiarism ?? 0;
        $userUsage->allow_ai_image_chat            = $plan->allow_ai_image_chat ?? 0;
        $userUsage->allow_speech_to_text           = $plan->allow_speech_to_text ?? 0;
        $userUsage->allow_images                   = $plan->allow_images ?? 0;
        $userUsage->allow_sd_images                = $plan->allow_sd_images ?? 0;
        $userUsage->allow_dall_e_2_image           = $plan->allow_dall_e_2_image ?? 0;
        $userUsage->allow_dall_e_3_image           = $plan->allow_dall_e_3_image ?? 0;
        $userUsage->allow_ai_pdf_chat              = $plan->allow_ai_pdf_chat ?? 0;
        $userUsage->allow_eleven_labs              = $plan->allow_eleven_labs ?? 0;
        $userUsage->allow_real_time_data           = $plan->allow_real_time_data ?? 0;
        $userUsage->allow_blog_wizard              = $plan->allow_blog_wizard ?? 0;
        $userUsage->allow_ai_vision                = $plan->allow_ai_vision ?? 0;
        $userUsage->allow_team                     = $plan->allow_team ?? 0;
        $userUsage->has_free_support               = $plan->has_free_support ?? 0;
        $userUsage->is_active                      = \appStatic()::ACTIVE;
        $userUsage->user_id                        = session()->get('s_merchant_id');
        $userUsage->created_by_id                  = userID();
        $userUsage->subscription_status            = appStatic()::PLAN_STATUS_ACTIVE;
        $userUsage->save();
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
