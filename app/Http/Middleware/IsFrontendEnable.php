<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsFrontendEnable
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (getSetting('enable_frontend') != 1) {
            if(!isLoggedIn()){
                return redirect()->route('login');
            }else{

                return redirect()->route('admin.dashboard');
            }
        }

        return $next($request);
    }
}
