<?php

namespace App\Traits\BootTrait;

use Illuminate\Database\Eloquent\Builder;

trait ActiveStatusScopeTrait
{
    /**
     * @incomingParams $isActive contains null as default
     * */
    public function scopeActiveStatus($query, $isActive = null, $columnIsActive = true, $columnPrefix = null)
    {
        if(!is_null($isActive)){
            $isActive = $isActive ? 1 : 0;

            $finalColumn = null;
            if(is_null($columnPrefix)){
                $finalColumn = $columnIsActive ? "is_active" : "account_status";
            }else{
                $finalColumn = $columnIsActive ? "$columnPrefix.is_active" : "$columnPrefix.account_status";
            }

            $query->where($finalColumn, $isActive);
        }
    }
}
