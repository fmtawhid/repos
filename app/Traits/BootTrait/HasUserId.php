<?php

namespace App\Traits\BootTrait;

use Illuminate\Support\Str;

trait HasUserId
{
    public static function bootHasUserId(): void
    {
        static::creating(function ($model) {
            if(isLoggedIn() && isColumnExists($model, "user_id")){
                $model->user_id = getUserParentId();
            }
        });
    }
}
