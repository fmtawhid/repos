<?php

namespace App\Http\Controllers\Auth;

use Socialite;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Model\Customer\CustomerService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Services\Model\SubscriptionPlan\SubscriptionPlanService;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }
    # social login redirection
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    # obtain the user information from social media.
    public function handleProviderCallback(Request $request, $provider)
    {
        try {
            if ($provider == 'twitter') {
                $user = Socialite::driver('twitter')->user();
            } else {
                $user = Socialite::driver($provider)->stateless()->user();
            }
        } catch (\Exception $e) {
            wLog("Failed to update ", errorArray($e));
            flash("Something Went wrong. Please try again.")->error();
            return redirect()->route('layout');
        }

        //check if provider_id exist
        $existingUserByProviderId = User::where('provider_id', $user->id)->first();

        if ($existingUserByProviderId) {
            //proceed to login
            auth()->login($existingUserByProviderId, true);
        } else {
            //check if email exist
            $existingUser = User::where('email', $user->email)->whereNull('deleted_at')->first();

            if ($existingUser) {
                //update provider_id
                $existing_User = $existingUser;
                $existing_User->provider_id = $user->id;
                $existing_User->email_verified_at = date('Y-m-d Hms');
                $existing_User->save();

                //proceed to login
                auth()->login($existing_User, true);
            } else {
                //create a new user
                $newUser = new User;
                $newUser->name = $user->name;
                $newUser->email = $user->email;
                $newUser->email_verified_at = date('Y-m-d Hms');
                $newUser->provider_id = $user->id;
                $newUser->save();

                # handle referral_code
                if (getSetting('enable_affiliate_system') == '1') {
                    $referral_code = isset($_COOKIE['referral_code']) ? $_COOKIE['referral_code'] : null;
                    if (!is_null($referral_code)) {
                        $referredByUser = User::where('referral_code', $referral_code)->first();
                        if (!is_null($referredByUser)) {
                            $newUser->referred_by = $referredByUser->id;
                            $newUser->save();
                        }
                    }
                }
                # save to subscribe list
                $customerService = new CustomerService();
                $starterPlan     = (new SubscriptionPlanService)->starterPlan();
                if ($starterPlan) {
                    $payloads = (object)[
                        'payment_amount'  => null,
                        'payment_method'  => null,
                        'payment_details' => null,
                        'note'            => null,
                        'payment_amount'  => 0,
                    ];
                    session()->put('s_customer_id', $user->id);
                    $subscriptionUser = $customerService->storeSubscriptionPlanUser($payloads, $starterPlan->id);
                    $customerService->storeSubscriptionPlanUserUsage($subscriptionUser->id, $starterPlan);

                    $user->subscription_plan_id = $starterPlan->id;
                    $user->save();
                }
                //proceed to login
                auth()->login($newUser, true);
            }
        }

        return $this->redirectCustomer();
    }

    # validate login
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email'    => 'required_without:phone',
            'phone'    => 'required_without:email',
            'password' => 'required|string',
        ]);
        if ($request->email) {
            $user = User::where('email', $request->email)->whereNull('deleted_at')->first();
        } else if ($request->phone) {
            $user = User::where('phone', $request->phone)->whereNull('deleted_at')->first();
        }
        if (!is_null($user) && $user->user_type == appStatic()::TYPE_CUSTOMER) {
            $score = recaptchaValidation($request);
            $request->request->add([
                'score' => $score
            ]);
            $data['score'] = 'required|numeric|min:0.9';
        } else {
            $request->request->add([
                'score' => 1
            ]);
            $data['score'] = 'nullable|numeric|min:0.9';
        }

        $request->validate($data, [
            'score.min' => localize('Google recaptcha validation error, seems like you are not a human.')
        ]);
    }

    # set credentials for phone/email login
    protected function credentials(Request $request)
    {
        if ($request->get('login_with') == "phone" && $request->get('phone') != null) {
            session(['login_with' => "phone"]);
            $phone =  validatePhone($request->get('phone'));
            return ['phone' => $phone, 'password' => $request->get('password')];
        } elseif ($request->get('email') != null) {
            session(['login_with' => "email"]);
            return $request->only($this->username(), 'password');
        }
    }

    # redirect customer
    protected function redirectCustomer()
    {
        if (session('link') != null) {
            $link = session('link');
            session()->forget('link');
            return redirect($link);
        } else {
            return redirect()->route('dashboard');
        }
    }

    # Get the failed login response instance.  
    protected function sendFailedLoginResponse(Request $request)
    {
        flash(localize('Invalid login credentials.'))->error();
        return back()->withInput();
    }

    # logged out
    protected function loggedOut(Request $request)
    {
        session()->forget('link');
    }

}
