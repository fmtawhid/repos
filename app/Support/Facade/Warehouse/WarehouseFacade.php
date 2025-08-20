<?php

namespace App\Support\Facade\Warehouse;

use App\Services\Models\Warehouse\WarehouseService;
use Illuminate\Support\Facades\Facade;

class WarehouseFacade extends  Facade
{

    public static function getFacadeAccessor()
    {
        return "warehouseFacade";
    }
}