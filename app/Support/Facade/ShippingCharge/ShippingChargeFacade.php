<?php

namespace App\Support\Facade\ShippingCharge;

use Illuminate\Support\Facades\Facade;

class ShippingChargeFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return "shippingChargeFacade";
    }
}