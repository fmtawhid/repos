<?php

namespace App\Support\Facade\Product;

use Illuminate\Support\Facades\Facade;

class ProductFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return "productCloneFacade";
    }
}