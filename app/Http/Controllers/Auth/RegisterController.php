<?php

namespace App\Http\Controllers\Auth;

use App\Services\Action\SubscriptionActionService;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Traits\Api\ApiResponseTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Services\Model\Customer\CustomerService;
use App\Services\Model\SubscriptionPlan\SubscriptionPlanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Jobs\EmailConfirmationJob;
use App\Services\SmsServices;

class RegisterController extends Controller
{
    use ApiResponseTrait;
    use RegistersUsers;

    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Validator for registration request
     */
    protected function validator(array $data)
    {
        $rules = [
            'first_name'    => ['required', 'string', 'max:255'],
            'last_name'     => ['nullable', 'string', 'max:255'],
            'i_agree'       => ['required'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'      => ['required', 'string', 'min:6'],
            'mobile_no'     => ['nullable'],
            "referral_code" => ['nullable'],
        ];

        if (getSetting('registration_with') == 'email_and_phone') {
            $rules['mobile_no'] = ['required', 'string', 'max:15'];
        }

        return Validator::make($data, $rules);
    }

    /**
     * Custom register method
     */
    public function register(Request $request)
    {
        // Validate input
        $this->validator($request->all())->validate();

        try {
            DB::beginTransaction();

            // Create user
            $user = $this->createUser($request->all());

            // If registration requires verification, do NOT auto-login; send verification and return a message
            $verificationType = getSetting('registration_verification_with');

            if ($verificationType == 'email' || $verificationType == 'email_and_phone') {
                // send verification email
                EmailConfirmationJob::dispatchSync($user);

                DB::commit();

                return $this->sendResponse(
                    appStatic()::SUCCESS,
                    localize('A verification code has been sent to your email. Please verify your account before logging in.'),
                    ['email' => $user->email, 'verification_sent' => true]
                );
            }

            if ($verificationType == 'phone') {
                // generate and send OTP via SMS
                $otp = rand(100000, 999999);
                $user->verification_code = $otp;
                $user->save();
                (new SmsServices())->phoneVerificationSms($user->mobile_no, $otp);

                DB::commit();

                return $this->sendResponse(
                    appStatic()::SUCCESS,
                    localize('A verification code has been sent to your phone. Please verify your account before logging in.'),
                    ['phone' => $user->mobile_no, 'verification_sent' => true]
                );
            }

            // Default: no verification required -> login
            Auth::login($user);

            DB::commit();

            return $this->sendResponse(
                appStatic()::SUCCESS,
                "User registered successfully",
                $user
            );

        } catch (\Throwable $th) {
            DB::rollBack();

            wLog("Failed to register", errorArray($th));

            return $this->sendResponse(
                appStatic()::VALIDATION_ERROR,
                "Failed to register: " . $th->getMessage(),
                [],
                errorArray($th)
            );
        }
    }

    /**
     * Actual user creation + subscription assignment
     */
    protected function createUser(array $data)
    {
        $referred_user_id = null;

        // Handle referral code
        if (getSetting('enable_affiliate_system') == 1 && isset($_COOKIE['referral_code'])) {
            $referredByUser = User::query()->where('referral_code', $_COOKIE['referral_code'])->first();
            if ($referredByUser) {
                $referred_user_id = $referredByUser->id;
            }
        }

        // Create User
        $user = User::create([
            'first_name'        => $data['first_name'],
            'last_name'         => $data['last_name'] ?? null,
            'email'             => $data['email'],
            'mobile_no'         => $data['mobile_no'] ?? null,
            'password'          => Hash::make($data['password']),
            'user_type'         => appStatic()::TYPE_VENDOR,
            'referred_user_id'  => $referred_user_id,
            'email_verified_at' => (getSetting('registration_verification_with') == 'disable' || !getSetting('registration_verification_with')) ? Carbon::now() : null,
        ]);

        // Assign starter subscription plan
        $starterPlan = (new SubscriptionPlanService)->starterPlan();

        if ($starterPlan) {
            $customerService = new CustomerService();
            $subscriptionActionService = new SubscriptionActionService();

            $payloads = (object)[
                'payment_method' => null,
                'payment_details' => null,
                'note' => null,
                'payment_amount' => 0,
                'subscription_plan_id' => $starterPlan->id,
                'user_id' => $user->id
            ];

            // Save user_id in session if needed
            session()->put('s_customer_id', $user->id);

            // Assign plan and usage
            $subscriptionUser = $subscriptionActionService->assignSubscriptionPlan($payloads);
            $subscriptionActionService->assignSubscriptionPlanUsage($subscriptionUser);

            // Update user subscription_plan_id
            $customerService->updateUserSubscriptionPlanId($user, $starterPlan->id);
        }

        return $user;
    }
}
