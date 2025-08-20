<?php

namespace App\Traits\BootTrait;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait CreatedUpdatedByRelationshipTrait
{
    public function createdBy() : BelongsTo{
        return  $this->belongsTo(User::class, "created_by_id")->withDefault();
    }

    public function updatedBy() : BelongsTo{
        return  $this->belongsTo(User::class, "updated_by_id")->withDefault();
    }

}
