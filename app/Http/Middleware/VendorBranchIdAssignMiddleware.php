<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\BranchModule\App\Services\BranchService;
use Symfony\Component\HttpFoundation\Response;

class VendorBranchIdAssignMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(isLoggedIn() && isVendor()){

            if(empty(getUserBranchId())){

                $branches = (new BranchService())->getBranchesByVendorId(getUserParentId());

                if($branches->count() > 0){
                    user()->update(["branch_id" => $branches->first()->id]);
                }
            }
        }

        return $next($request);
    }
}
