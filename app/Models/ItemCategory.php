<?php

namespace App\Models;

use App\Traits\BootTrait\CreatedByUpdatedByIdTrait;
use App\Traits\BootTrait\CreatedUpdatedByRelationshipTrait;
use App\Traits\BootTrait\VendorTrait;
use App\Traits\Global\GlobalTrait;
use App\Traits\Global\VendorIdGlobalTrait;
use App\Traits\Models\Status\IsActiveTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemCategory extends Model
{
    use HasFactory;
    use CreatedByUpdatedByIdTrait;
    use CreatedUpdatedByRelationshipTrait;
    use VendorTrait;
    use IsActiveTrait;
    use VendorIdGlobalTrait;
    use SoftDeletes;

    protected $fillable = [
        "name",
        "vendor_id",
        "is_active",
        "created_by_id",
        "updated_by_id",
        "deleted_at",
    ];

    public function scopeFilters($query)
    {
        $request = request();

        // keyword
        if($request->has("keyword")){
            $keyword = $request->keyword;

            $query->where('name', 'like', '%'.$keyword.'%');
        }


        // is_active
        if($request->has("is_active") && !is_null($request->is_active)) {
            $query->isActive($request->is_active);
        }

        return $query;

    }
    public function products()
    {
        return $this->hasMany(Product::class, 'item_category_id', 'id');
    }
}
