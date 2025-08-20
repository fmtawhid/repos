<?php

namespace App\Models;

use App\Traits\BootTrait\CreatedByUpdatedByIdTrait;
use App\Traits\BootTrait\CreatedUpdatedByRelationshipTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TalkingPhoto extends Model
{
    use HasFactory;
    use CreatedByUpdatedByIdTrait;
    use CreatedUpdatedByRelationshipTrait;
    
    protected $table    = 'talking_photos';
    protected $fillable = [
        "talking_photo_id",
        "talking_photo_name",
        "preview_image_url",
        "is_active",
        "created_by_id",
        "updated_by_id",
        "created_at",
        "updated_at",
        "deleted_at",
    ];
}
