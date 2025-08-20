<?php

namespace App\Models;

use App\Traits\BootTrait\VendorTrait;
use App\Traits\Global\VendorIdGlobalTrait;
use App\Traits\Models\Status\IsActiveTrait;
use App\Traits\Relationship\BranchRelationshipTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{

    use HasFactory,
        BranchRelationshipTrait,
        IsActiveTrait,
        SoftDeletes,
        VendorIdGlobalTrait,
        VendorTrait;

    protected $fillable = [
        "name",
        "is_active",
        "created_by_id",
        "updated_by_id",
        "deleted_at",
    ];


    public function scopeFilters($query)
    {
        $request = request();


        // Menu Name
        if($request->has("keyword")) {
            $keyword = $request->keyword;
            $query->where(function($q) use ($keyword){
                $q->where('name', 'like', '%'.$keyword.'%');
            });
        }

        // Status
        if($request->has("is_active") && !is_null($request->is_active)) {

            $is_active = $request->is_active;
            $query->where('is_active', $is_active);
        }
    }

}
