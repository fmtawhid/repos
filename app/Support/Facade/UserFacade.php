<?php

namespace App\Support\Facade;

use Illuminate\Support\Facades\Facade;

class UserFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'user';
    }
}