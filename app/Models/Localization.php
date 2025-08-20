<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localization extends Model
{
    use HasFactory;
    protected $fillable = [
        'lang_key',
        't_key',
        't_value'
    ];
}
