<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AffiliateReferral
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if (getSetting('enable_affiliate_system') == '1') {
            # check cookie || already logged in ---> do nothing
            if (!Auth::check() && !isset($_COOKIE['referral_code'])) {

                if ($request->referral_code) {
                    $theTime = time() + 86400 * 365; // 86400 = 1 day 
                    setcookie('referral_code', $request->referral_code, $theTime, '/');
                    $user = User::query()->where('referral_code', $request->referral_code)->first();

                    if (!is_null($user)) {
                        $user->num_of_clicks = (int) $user->num_of_clicks + 1;
                        $user->save();
                    }
                }

            }
        }
        return $next($request);
    }
}
