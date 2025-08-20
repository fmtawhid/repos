<?php

namespace Modules\BranchModule\App\Models;

use App\Models\Menu;
use App\Traits\BootTrait\CreatedByUpdatedByIdTrait;
use App\Traits\BootTrait\VendorTrait;
use App\Traits\Global\VendorIdGlobalTrait;
use App\Traits\Models\Status\IsActiveTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use HasFactory,IsActiveTrait, SoftDeletes;

    use CreatedByUpdatedByIdTrait;
    use VendorTrait;
    use VendorIdGlobalTrait;

    protected $table = 'branches';

    protected $fillable = [
        "is_active",
        "vendor_id",
        "name",
        "branch_code",
        "mobile_no",
        "email",
        "address",
        "latitude",
        "longitude",
        "map_link",
        "open_time",
        "close_time",
        "business_days",
        "created_by_id",
        "updated_by_id",
        "deleted_by_id",
        "created_at",
        "updated_at",
        "deleted_at"
    ];

    public function menus()
    {
        return $this->belongsToMany(Menu::class,
            'branch_menu');
    }

    protected static function newFactory()
    {
        //return BranchFactory::new();
    }

    public function scopeFilters($query){
        $request = request();

        if($request->has("keyword")){
            $keyword = $request->keyword;

            $query->where(function($q) use ($keyword){
                $q->where('name', 'like', '%'.$keyword.'%')
                    ->orWhere('branch_code', 'like', '%'.$keyword.'%')
                    ->orWhere('mobile_no', 'like', '%'.$keyword.'%')
                    ->orWhere('email', 'like', '%'.$keyword.'%')
                    ->orWhere('address', 'like', '%'.$keyword.'%');
            });
        }

        // is_active
        if($request->has("is_active")) {
            $query->isActive($request->is_active);
        }
    }
}
