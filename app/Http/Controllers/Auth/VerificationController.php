<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Services\SmsServices;
use App\Jobs\EmailConfirmationJob;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
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
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
    # Show the verification form.
    public function show(Request $request)
    {
        if (session('login_with') == "phone") {
            return $request->user()->hasVerifiedEmail() ? redirect($this->redirectPath()) : redirect()->route('verification.phone');
        }
        return $request->user()->hasVerifiedEmail() ? redirect($this->redirectPath()) : view('auth.verify');
    }

    # resend verification email
    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        wLog("Email Confirmation Resend for UserID : {$request->user()->id}", ["user" => $request->user()]);

        EmailConfirmationJob::dispatchSync($request->user());

        return back()->with('resent', true);
    }

    # set as verified
    public function verification_confirmation($code, $otp_verification_check = false)
    {
        try {
            $verificationCode = $otp_verification_check ? $code : decrypt($code);

            $user = User::query()->where("verification_code", $verificationCode)->first();

            if (!empty($user)) {
                $user->email_or_otp_verified = 1;
                $user->email_verified_at = Carbon::now();
                $user->save();

                auth()->login($user, true);
                flash(localize('Your account has been verified successfully'))->success();
            } else {
                flash(localize('Sorry, we could not verify you. Please try again'))->error();
            }

            return redirect()->route('writebot.dashboard');
        } catch (\Throwable $e) {
            flash($e->getMessage())->error();

            return back();
        }
    }

    # show phone verification form
    public function verifyPhone()
    {
        $user = auth()->user();
        $user->verification_code = rand(100000, 999999);
        $user->save();

        $this->sendOtp($user->phone, $user->verification_code);
        return view('auth.phoneVerify', compact('user'));
    }

    # send otp
    public function sendOtp($phone, $otp): void
    {
        (new SmsServices)->phoneVerificationSms($phone, $otp);
        flash(localize('A verification code has been sent to your phone.'))->info();
    }

    # set as verified
    public function phone_verification_confirmation(Request $request)
    {
        return $this->verification_confirmation($request->verification_code, true);
    }
}
