<?php

namespace App\Traits\BootTrait;

use App\Models\User;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait CreatedByUpdatedByIdTrait
{
    protected static function bootCreatedByUpdatedByIdTrait()
    {
        $registerRoute = Route::has('register') ? route('register') : '';

        #Creating
        static::creating(function ($model) use($registerRoute){

            $model->created_by_id = userID();

            if(in_array(URL::current(), [$registerRoute]) && isAdmin()) {
                if($model->getTable() != 'users'){
                    $model->user_id = session('s_customer_id');
                    session()->forget('s_customer_id');
                }
            }
            else if($model->getTable() != 'users' && isColumnExists($model,"user_id")) {
                $model->user_id = getUserParentId() ?? 1; // userID(); 
            }
        });

        # Updating
        static::updating(function ($model){
            $model->updated_by_id = isLoggedIn() ? userID() : null;

            if($model->getTable() != 'users' &&  isColumnExists($model,"user_id")) {
                $model->user_id = getUserParentId() ?? 1; // userID();
            }
        });
    }
}
