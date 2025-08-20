<?php

namespace App\Services\Appearance;

use App\Models\SystemSetting;
use App\Models\SystemSettingLocalization;
use App\Services\Feature\FeatureService;
use Illuminate\Support\Facades\App;

class AppearanceService
{
    public function index():array
    {
        $data = [];
        $data['featureTabs'] = (new FeatureService())->appearanceFeatureTab();

        return $data;
    }
    public function storeOrUpdate($request): void
    {
        if ($request->types) {
            foreach ($request->types as $key => $value) {
               $model = SystemSetting::query()->updateOrCreate([
                    'entity' => $key
                ], [
                    "entity"    => $key,
                    'value'     => $value,
                    'is_active' => 1,
                ]);

                $this->storeLocalizationData($request);
            }
        }

        if(!empty($request->settings)) {
            foreach($request->settings as $key=>$value) {
               $this->settingStoreOrUpdate($key, $value);
            }
        }

        cacheClear();

    }
    private function settingStoreOrUpdate($key, $value = null)
    {
        $value = gettype($value) == 'array' ? json_encode($value) : $value;

        SystemSetting::query()->updateOrCreate([
            'entity' => $key
        ], [
            'value'     => $value,
            'is_active' => 1,               
        ]);
    }
    private function storeLocalizationData($request): void
    {
        $lang_key = $request->language_key ?? App::getLocale();
        foreach ($request->types as $key => $value) {

            $settings = SystemSetting::query()->where('entity', $key)->latest()->first();

            $system_setting_id = $settings ? $settings->id : null;
            $value = $request[$key];
            if (gettype($value) == 'array') {
                $value = json_encode($value);
            }
            if (!is_null($system_setting_id)) {

                SystemSettingLocalization::query()->updateOrCreate([
                    'lang_key' => $lang_key,
                    'entity' => $key
                ], [
                    'value' => $value,
                    'system_setting_id' => $system_setting_id
                ]);
            }
        }
    }

}
