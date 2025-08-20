<?php

namespace App\Traits\BootTrait;

trait HasBranchId
{

    public static function bootHasBranchId(): void
    {
        static::creating(function ($model) {
            if(isLoggedIn() && isColumnExists($model, "branch_id")){
                $model->branch_id = getUserBranchId();
            }
        });
    }

}
