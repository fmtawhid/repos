<?php

namespace App\Http\Controllers\Auth;

use App\Services\Action\SubscriptionActionService;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Traits\Api\ApiResponseTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Services\Model\Customer\CustomerService;
use App\Services\Model\SubscriptionPlan\SubscriptionPlanService;

class RegisterController extends Controller
{
    use ApiResponseTrait;

    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $validateFormData = [
            'first_name'    => ['required', 'string', 'max:255'],
            'last_name'     => ['nullable', 'string', 'max:255'],
            'i_agree'       => ['required'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'      => ['required', 'string', 'min:6'],
            'mobile_no'     => ['nullable'],
            "referral_code" => ['nullable'],
        ];

        if (getSetting('registration_with') == 'email_and_phone') {
            $validateFormData['mobile_no'] = ['required', 'string', 'max:15'];
        }
        return Validator::make($data, $validateFormData);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        try {
            DB::beginTransaction();

            $referred_user_id = null;

            # handle referral_code
            if (getSetting('enable_affiliate_system') == 1 && isset($_COOKIE['referral_code'])) {
                $referredByUser = User::query()->where('referral_code', $_COOKIE['referral_code'])->first();

                if (!empty($referredByUser)) {
                    $referred_user_id = $referredByUser->id;
                }
            }

            $user = [
                'first_name'        => $data['first_name'],
                'last_name'         => $data['last_name'],
                'email'             => $data['email'],
                'mobile_no'         => isset($data['mobile_no']) ? $data['mobile_no'] : null,
                'password'          => Hash::make($data['password']),
                'user_type'         => appStatic()::TYPE_VENDOR,
                "referred_user_id"  => $referred_user_id,
                'email_verified_at' => getSetting('registration_verification_with') == 'disable' || !getSetting('registration_verification_with') ?  Carbon::now() : null,
            ];

            

            $user = User::query()->create($user);
                        
            // Login
            // \Illuminate\Support\Facades\Auth::login($user);

            $customerService           = new CustomerService();
            $starterPlan               = (new SubscriptionPlanService)->starterPlan();

            $subscriptionActionService = new SubscriptionActionService();

            if (!empty($starterPlan)) {

                $payloads = (object)[
                    'payment_method'  => null,
                    'payment_details' => null,
                    'note'            => null,
                    'payment_amount'  => 0,
                    "subscription_plan_id" => $starterPlan->id,
                    "user_id" => $user->id
                ];

                session()->put('s_customer_id', $user->id);

                // Assign Plan
                $subscriptionUser = $subscriptionActionService->assignSubscriptionPlan($payloads);

                // Assign Plan Usages
                $subscriptionActionService->assignSubscriptionPlanUsage($subscriptionUser);

                // Update User subscription_plan_id
                $customerService->updateUserSubscriptionPlanId($user, $starterPlan->id);
            }

            DB::commit();

            return $user;
        } catch (\Throwable $th) {
            DB::rollBack();
            wLog("Failed to register", errorArray($th));

            return $this->sendResponse(
                appStatic()::VALIDATION_ERROR,
                "Failed to register :" .$th->getMessage(),
                [],                
                errorArray($th)
            );
        }
    }
}
