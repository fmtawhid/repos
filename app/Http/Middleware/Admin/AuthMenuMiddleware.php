<?php

namespace App\Http\Middleware\Admin;

use App\Services\Business\CustomerPlanRouteService;
use Closure;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Traits\Api\ApiResponseTrait;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\Models\User\UserMenuPermissionTrait;

class AuthMenuMiddleware
{
    use ApiResponseTrait;
    use UserMenuPermissionTrait;

    /**
     * @throws \JsonException
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()){

            if(isAdmin() || in_array(currentRoute(), (new CustomerPlanRouteService())->getCommonRoutes())){
                return $next($request);
            }

            // TODO::Subscription will be check here.
            // Initial Menus at Session.
            $route = self::setMenuAtSession();

            // Checking browsing URL access has or not for the current logged-in user.
            if (!isRouteExists()){

                if(isAjax()){
                    return $this->sendResponse(
                        appStatic()::UNAUTHORIZED,
                        localize(appStatic()::MESSAGE_UNAUTHORIZED),
                    );
                }

                 abort(401);
            }

            if (!isAllowedInDemo() && env('DEMO_MODE') ==='On'){
                // TODO::Check if user is allowed in demo mode.
                return $this->sendResponse(
                    appStatic()::UNAUTHORIZED,
                    localize("This feature not available for the Demo Mode."),
                );
                abort(401);

            }

            return $next($request);
        }

        // When it's ajax Request
        if(isAjax()){
            return $this->sendResponse(
                appStatic()::UNAUTHORIZED,
                localize(appStatic()::MESSAGE_UNAUTHORIZED),
            );
        }

        abort(401);
    }

    public function defaultRoutes()
    {
        return [
            "admin.balance-render",
            "admin.users.updateBalance",
            "admin.documents.index",
            "admin.generated-content.show",
            "admin.generated-content.update",
            "admin.generated-content.destroy",
        ];
    }



    public static function setMenuAtSession(){
        $user   = user();
        $powers = userPermissions();

        if (empty($powers)){
            try {
                DB::beginTransaction();
                if(env('DEMO_MODE') == 'On') {
                    $userPermissions = Permission::all();
                }else{
                    $userPermissions = User::query()
                        ->join("user_roles","users.id","=","user_roles.user_id")
                        ->join("role_permissions","user_roles.role_id","=","role_permissions.role_id")
                        ->join("permissions","role_permissions.permission_id","=","permissions.id")
                        ->select(
                            "permissions.*",
                            "role_permissions.id as role_permission_id",
                            "role_permissions.permission_id as role_permission_id",
                            "role_permissions.role_id as role_p_role_id",
                        )
                        ->where("users.id",userID())
                        ->get();
                }


                $data               = [];
                $routes_array       = [];
                $demo_permissions   = [];

                if($userPermissions->count()>0){
                    foreach ($userPermissions as $key=>$permission){
                        $temp = [];

                        $temp["permission_id"]        = $permission->id;
                        $temp["route"]                = $permission->route;
                        $temp["display_name"]         = $permission->display_title;
                        $temp["method_type"]          = $permission->method_type;
                        $temp["isVisible"]            = $permission->is_sidebar_menu;
                        $temp["is_sidebar_menu"]      = $permission->is_sidebar_menu;
                        $temp["url"]                  = $permission->url;
                        $temp["icon_file"]            = $permission->icon_file;
                        $temp["is_allowed_in_demo"]   = $permission->is_allowed_in_demo;

                        $data[$permission->route] = $temp;

                        $route = $permission->route;

                        /* Route Pushing */
                        if(!in_array($route,$routes_array)){
                            $routes_array[] = $route;
                        }

                        $demo_permissions[$route] = $temp;
                    }
                }

                /* User Powers start */
                session()->put("user_powers",$demo_permissions);
                session()->save();

                # Menu Permission Update with + 1;
                $user = self::increaseUserMenuPermissions($user);

                session()->put("menu_permission_version",$user->menu_permission_version);
                session()->save();

                /* User Routes */
                session()->put("user_routes", $routes_array);
                session()->save();

                /* User Demo Permission */
                session()->put("demo_permissions", $demo_permissions);
                session()->save();

                DB::commit();

                return true;
            }
            catch (\Throwable $e){
                DB::rollBack();
                wLog("Logged IN User ID : ".userID()." Role Permission Middleware Error.",$e, logService()::LOGIN_FAILED_LOGIN);

                ddError($e);
            }
        }
        else{
            self::checkUserPowerMenuPermissionVersion($user);
        }
    }


    public static function checkUserPowerMenuPermissionVersion($user)
    {
        if($user->menu_permission_version != session('menu_permission_version')){
            // Logged In Session Destroy / Delete;
            loggedInSessionDestroy();

            // Set the menu newly
            self::setMenuAtSession();
        }

        return $user;
    }
}
