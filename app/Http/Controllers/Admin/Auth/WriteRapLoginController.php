<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\WriteRapLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WriteRapLoginController extends Controller
{
    public function writeRapLogin(WriteRapLoginRequest $request)
    {
        try {
            $credentials                   = $request->validated();
            $credentials["account_status"] = 1;

            $loginAttempt = Auth::attempt($credentials,true);
            if($loginAttempt){

                $request->session()->regenerateToken();

                if ($request->hasSession()) {
                    $request->session()->put('auth.password_confirmed_at', time());
                }

                $auth = Auth::user();

                return redirect()->route("home");
            }



            session()->flash("error", "Sorry! Failed to login. Credentials mismatch.");
            return redirect()->back()->withInput();
        }
        catch (\Throwable $e){

            wLog("Failed to login", $request->all(), logService()::LOGIN_FAILED_LOGIN);
            session()->flash("error", "Sorry! Failed to login. Credentials mismatch");

            return redirect()->back()->withInput();
        }
    }
}
