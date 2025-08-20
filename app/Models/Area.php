<?php

namespace App\Models;

use App\Traits\BootTrait\CreatedByUpdatedByIdTrait;
use App\Traits\BootTrait\CreatedUpdatedByRelationshipTrait;
use App\Traits\BootTrait\VendorTrait;
use App\Traits\Global\VendorIdGlobalTrait;
use App\Traits\Models\Status\IsActiveTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\BranchModule\App\Models\Branch;

class Area extends Model
{
    use HasFactory,
        IsActiveTrait;
    use CreatedByUpdatedByIdTrait;
    use CreatedUpdatedByRelationshipTrait;
    use VendorTrait;
    use SoftDeletes, VendorIdGlobalTrait;

    protected $fillable = [
        "name",
        "vendor_id",
        "number_of_tables",
        "is_active",
        "created_by_id",
        "updated_by_id",
        "deleted_at",
    ];

    public function scopeFilters($query){

        $request = request();

        $keyword = $request->keyword;

        // keyword
        if($request->has("keyword") && !empty($keyword)){

            $query->where('name', 'like', '%'.$keyword.'%');
        }

        // branch_id
        if($request->has("branch_id") && !empty($request->branch_id)) {
            $query->whereHas('branches', function ($q) use ($request) {
                $q->where('branch_id', $request->branch_id);
            });
        }

        // is_active
        if($request->has("is_active")) {
            $query->isActive($request->is_active);
        }
    }

    public function tables()
    {
        return $this->hasMany(Table::class)
            ->whereNull("tables.deleted_at")
            ->where("tables.is_active", appStatic()::ACTIVE);
    }

    public function branches()
    {
        return $this->belongsToMany(Branch::class, 'area_branch');
    }
}
