<?php

namespace App\Models;

use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\Status\IsActiveTrait;
use App\Traits\BootTrait\CreatedByUpdatedByIdTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\BootTrait\CreatedUpdatedByRelationshipTrait;

class SystemSetting extends Model
{
    use HasFactory;
    use IsActiveTrait;
    use CreatedByUpdatedByIdTrait;
    use CreatedUpdatedByRelationshipTrait;

    protected $table = "system_settings";
    protected $fillable = [
        'is_active',
        'entity',
        'value',
        'user_id',
        'created_by_id',
        'updated_by_id'
    ];
    protected $with = ['systemSettingsLocalization'];

    public function collectLocalization($entity = '', $lang_key = '')
    {
        $lang_key = $lang_key ==  '' ? App::getLocale() : $lang_key;
        $systemSettingsLocalization = $this->systemSettingsLocalization->where('lang_key', $lang_key)->first();

        return $systemSettingsLocalization != null && $systemSettingsLocalization->entity != null ? $systemSettingsLocalization->value : null;
    }

    public function systemSettingsLocalization()
    {
        return $this->hasMany(SystemSettingLocalization::class, 'system_setting_id', 'id');
    }

    public function scopeEntity($query, $type)
    {
        $query->where("entity", $type);
    }
}
