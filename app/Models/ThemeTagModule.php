<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThemeTagModule extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'is_default',
        'is_paid',
        'is_verified',
        'is_active',
        'description',
        'purchase_code',
        'domain'
    ];
}
