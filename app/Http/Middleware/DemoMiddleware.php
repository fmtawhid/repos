<?php

namespace App\Http\Middleware;

use App\Traits\Api\ApiResponseTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DemoMiddleware
{
    use ApiResponseTrait;

    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     * @throws \JsonException
     */
    public function handle(Request $request, Closure $next): Response
    {
        //1. Check Is Demo Mode is On
        if(isDemoOn()){

            //2. When it's on check the current route is index or create
            if(isDemoAllowedRoutes()){

                //3. If it's index ,create or common routes continue the action.
                return $next($request);
            }

            //4. If it's not index or create then return error
            if($request->ajax()){
                return $this->sendResponse(
                    appStatic()::UNAUTHORIZED,
                    localize("Sorry! This feature is disabled in demo mode.")
                );
            }

            flashMessage(localize("Sorry! This feature is disabled in demo mode."),"error");

            return redirect()->back();
        }

        return $next($request);
    }
}
