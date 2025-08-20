<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\Status\IsActiveTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BootTrait\CreatedByUpdatedByIdTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\BootTrait\CreatedUpdatedByRelationshipTrait;

class Page extends Model
{
    use HasFactory;
    use IsActiveTrait;
    use CreatedByUpdatedByIdTrait;
    use CreatedUpdatedByRelationshipTrait;
    use SoftDeletes;
    
    protected $fillable = [
        'title',
        'slug', 
        'content',
        'meta_title',
        'meta_image', 
        'meta_description',  
        "user_id",
        "created_by_id",
        "updated_by_id",
        "is_active",
        "deleted_at"
    ];
    public function scopeFilters($query)
    {
        $request = request();

        // Search
        if ($request->has("search")) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        return $query;
    }
}
