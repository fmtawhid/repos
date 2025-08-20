<?php  
namespace App\Traits\Models\User;

use App\Models\User;

trait UserMenuPermissionTrait{

    # Menu Permission Update with + 1;
    public static function increaseUserMenuPermissions(User $user): User
    {
        if(isLoggedIn()){

            $user->update(["menu_permission_version" => $user->menu_permission_version+1]);

            return $user;
        }
        
        abort(404);
    }
}