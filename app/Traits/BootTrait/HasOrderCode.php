<?php

namespace App\Traits\BootTrait;

trait HasOrderCode
{
    public static function bootHasOrderCode()
    {
        static::creating(function ($model) {
            if(isColumnExists($model, "invoice_no")){

                $model->invoice_no = self::orderCode();
            }
        });
    }

    public static function orderCode()
    {
        $orderPrefix = getSetting("order_code_prefix","restors_");


        return  $orderPrefix."_".randomStringNumberGenerator(6,true);
    }
}
