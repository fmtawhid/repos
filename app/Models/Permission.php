<?php

namespace App\Models;

use App\Traits\BootTrait\CreatedByUpdatedByIdTrait;
use App\Traits\BootTrait\CreatedUpdatedByRelationshipTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use HasFactory;
    use CreatedUpdatedByRelationshipTrait;
    use CreatedByUpdatedByIdTrait;
    use SoftDeletes;
    
    protected $table = "permissions";
    protected $fillable = [
        "is_active",
        "is_allowed_in_demo",
        "display_title",
        "route",
        "url",
        "method_type",
        "is_sidebar_menu",
        "icon_file",
        "user_id",
        "created_by_id",
        "updated_by_id",
        "deleted_at"
    ];
}
