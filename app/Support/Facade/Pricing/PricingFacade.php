<?php

namespace App\Support\Facade\Pricing;

use Illuminate\Support\Facades\Facade;

class PricingFacade extends Facade
{

    public static function getFacadeAccessor()
    {
        return "pricingFacade";
    }
}