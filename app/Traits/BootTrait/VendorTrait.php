<?php

namespace App\Traits\BootTrait;

use App\Models\User;
use Illuminate\Support\Facades\Schema;

trait VendorTrait
{
    protected static function bootVendorTrait(): void
    {
        // Creating
        static::creating(function ($model) {
            // Check if vendor_id column exists in the table
            if (isLoggedIn() && isColumnExists($model,"vendor_id")) {
                $model->vendor_id = getUserParentId();
            }

            if (isLoggedIn() && isColumnExists($model,"branch_id")) {
                $model->branch_id = getUserBranchId();
            }


        });
    }

    public function vendor()
    {
        return $this->belongsTo(User::class,"vendor_id")->withTrashed();
    }
}
