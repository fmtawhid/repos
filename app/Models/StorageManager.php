<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\Status\IsActiveTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BootTrait\CreatedByUpdatedByIdTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\BootTrait\CreatedUpdatedByRelationshipTrait;

class StorageManager extends Model
{
    use HasFactory;
    use IsActiveTrait;
    use CreatedByUpdatedByIdTrait;
    use CreatedUpdatedByRelationshipTrait;
    use SoftDeletes;
    protected $fillable = [
        'type',
        'access_key',
        'secret_key',
        'bucket',
        'region',
        'container',
        'storage_name',
        'storage_url',
        "is_active",
        "user_id",
        "created_by_id",
        "updated_by_id",
        'file_name',
        'path'
    ];
}
