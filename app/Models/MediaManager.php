<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\Status\IsActiveTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BootTrait\CreatedByUpdatedByIdTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\BootTrait\CreatedUpdatedByRelationshipTrait;

class MediaManager extends Model
{
    use HasFactory;
    use SoftDeletes;
    use IsActiveTrait;
    use CreatedByUpdatedByIdTrait;
    use CreatedUpdatedByRelationshipTrait;

    protected $table = "media_managers";

    protected $fillable = [
        'media_file',
        'media_size',
        'media_type',
        'media_name',
        'media_extension',
        'is_active',
        'user_id',
        'created_by_id',
        'updated_by_id'
    ];
}
