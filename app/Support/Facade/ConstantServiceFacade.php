<?php

namespace App\Support\Facade;

use App\Constants\UserType;
use App\Constants\RequestResponse;
use Illuminate\Support\Facades\Facade;

class ConstantServiceFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'constantService';
    }
}