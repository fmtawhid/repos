<?php

namespace App\Traits\BootTrait;

trait HasTransactionNoTrait
{

    public static function bootHasTransactionNoTrait() {

        static::creating(function ($model) {
            if(isLoggedIn() && isColumnExists($model, "transaction_no")) {
                $model->transaction_no = $model->generateTransactionNo();
            }
        });
    }

    public function generateTransactionNo()
    {
        return randomStringNumberGenerator(6,true, true);
    }
}
