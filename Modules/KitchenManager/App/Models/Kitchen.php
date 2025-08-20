<?php

namespace Modules\KitchenManager\App\Models;

use App\Traits\BootTrait\CreatedByUpdatedByIdTrait;
use App\Traits\BootTrait\VendorTrait;
use App\Traits\Global\VendorIdGlobalTrait;
use App\Traits\Models\Status\IsActiveTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\BranchModule\App\Models\Branch;

class Kitchen extends Model
{
    use HasFactory, IsActiveTrait, CreatedByUpdatedByIdTrait, VendorTrait, SoftDeletes, VendorIdGlobalTrait;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        "is_active",
        "vendor_id",
        "branch_id",
        "name",
        "created_by_id",
        "updated_by_id",
        "deleted_by_id",
        "created_at",
        "updated_at",
        "deleted_at"
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    
    public function scopeFilters($query){
        $request = request();

        if($request->has("keyword")){
            $keyword = $request->keyword;

            $query->where(function($q) use ($keyword){
                $q->where('name', 'like', '%'.$keyword.'%')
                  ->orWhereHas('branch', function($q) use ($keyword) {
                      $q->where('name', 'like', '%'.$keyword.'%')
                        ->orWhere('branch_code', 'like', '%'.$keyword.'%');
                  });
            });
        }

        // is_active
        if($request->has("is_active")) {
            $query->isActive($request->is_active);
        }
    }

    protected static function newFactory()
    {
        //return KitchenFactory::new();
        return null;
    }
}
