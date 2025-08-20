<?php

namespace App\Http\Middleware;

use App\Traits\Api\ApiResponseTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsVendorMiddleware
{
    use ApiResponseTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(isLoggedIn() && isVendorUserGroup()){
            return $next($request);
        }

        if(isAjax()){
            return $this->sendResponse(
                appStatic()::UNAUTHORIZED,
                localize(appStatic()::MESSAGE_UNAUTHORIZED)
            );
        }

        abort(401);
    }
}
