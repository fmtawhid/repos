<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemSettingLocalization extends Model
{
    use HasFactory;
    protected $fillable = [
        'system_setting_id',
        'entity',
        'value',
        'lang_key',
        'user_id'
    ];
}
