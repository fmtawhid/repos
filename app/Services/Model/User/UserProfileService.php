<?php

namespace App\Services\Model\User;

use Illuminate\Support\Facades\Auth;

class UserProfileService
{
    public function profile($id = null)
    {
        $id = $id ?? user()->id;
        return self::userService()->findById($id);
    }
    private static function userService()
    {
        return new UserService();
    }
    public function passwordChange($payloads)
    {
        $data['user_id']  = isset($payloads['user_id']) ?  $payloads['user_id'] : user()->id;
        $data['password'] = bcrypt($payloads["password"]);
        $user = $this->updateInfo($data);
        if($user->id === user()->id){
            Auth::logout();
        }else{
            Auth::logoutOtherDevices($user->password);
        }
    }
    public function updateInfo($payloads)
    {
        $id = isset($payloads['user_id']) ? $payloads['user_id'] : user()->id;
        $model = self::userService()->findById($id);
        $model->update($payloads);
        return $model;
    }
}
