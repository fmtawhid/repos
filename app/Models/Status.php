<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'statuses';
    protected $fillable = [
        "title",
        "context",
        "is_active",
        "icon",
        "kitchen_access",
        "branch_access",
        "order_access",
        "reservation_access",
        "created_by_id",
        "updated_by_id",
        "deleted_by_id",
        "created_at",
        "updated_at",
        "deleted_at"
    ];
}
