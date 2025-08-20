<?php
namespace App\Traits\Models\Status;
use Illuminate\Database\Eloquent\Builder;

trait IsActiveTrait{

    public function scopeIsActive(Builder $builder, $isActive = true, $columnPrefix = "is_active") {
        $builder->where($columnPrefix, $isActive ? 1 : 0);
    }
}
