<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\Status\IsActiveTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BootTrait\CreatedByUpdatedByIdTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\BootTrait\CreatedUpdatedByRelationshipTrait;

class Language extends Model
{
    use HasFactory;
    use IsActiveTrait;
    use CreatedByUpdatedByIdTrait;
    use CreatedUpdatedByRelationshipTrait;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'code',
        'flag',
        'is_rtl',
        'is_active_for_templates',
        'is_active',
        'user_id',
        'created_by_id',
        'updated_by_id'
    ];
    public function scopeFilters($query)
    {
        $request = request();

        // Is Active
        if ($request->has("is_active")) {
            $query->isActive($request->is_active);
        }

        // Search
        if ($request->has("search")) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        return $query;
    }    
    public function scopeIsActiveForTemplate($query)
    {
        return $query->where('is_active_for_templates', 1);
    } 
}
