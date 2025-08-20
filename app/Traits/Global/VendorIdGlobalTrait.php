<?php

namespace App\Traits\Global;

use Illuminate\Database\Eloquent\Builder;

trait VendorIdGlobalTrait
{
    public static function bootVendorIdGlobalTrait()
    {
        static::addGlobalScope('vendor_id', function (Builder $builder) {
            $table = $builder->getModel()->getTable();

            //TODO:: Need to uncomment once it's ready to use.
//            if (isLoggedIn() && isVendorUserGroup()) {
//                $builder->where("{$table}.vendor_id", getUserParentId());
//            }

            $builder->where("{$table}.vendor_id", getUserParentId());

        });
    }
}
