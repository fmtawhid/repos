<?php

namespace App\Models;

use App\Traits\BootTrait\CreatedByUpdatedByIdTrait;
use App\Traits\BootTrait\CreatedUpdatedByRelationshipTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    use HasFactory;
    use CreatedByUpdatedByIdTrait;
    use CreatedUpdatedByRelationshipTrait;
    
    protected $table    = 'avatars';
    protected $fillable = [
        "photo_type",
        "avatar_id",
        "avatar_name",
        "gender",
        "preview_image_url",
        "preview_video_url",
        "is_active",
        "created_by_id",
        "updated_by_id",
        "created_at",
        "updated_at",
        "deleted_at",
    ];
}
