<?php
namespace App\Scopes;

trait UserIdScopeTrait
{
    public function scopeForUser($query, $userId = null)
    {
        $userId = $userId ?? userID();

        return $query->where('user_id', $userId);
    }


    public function scopeForMerchant($query, $user_id = null)
    {

        $user_id = empty($user_id) ? merchantId() : $user_id;

        $query->where("user_id",$user_id);
    }

    public function scopeParentUserId($query, $user_id = null)
    {
        $user_id = is_null($user_id) ? getUserParentId() : $user_id;

        $query->where("parent_user_id",$user_id);
    }

    public function scopeUserId($query, $user_id = null)
    {
        $user_id = is_null($user_id) ? getAdminOrCustomerId() : $user_id;

        $query->where("user_id",$user_id);
    }
}
