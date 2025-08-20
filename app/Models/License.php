<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasFactory;

    protected $table = "licenses";

    protected $fillable = [
        'purchase_code',
        'client_token',
        'app_env',
        "is_active"
    ];
}
