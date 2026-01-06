<?php

namespace App\Services\Model\SystemSetting;

use App\Models\SystemSetting;
use App\Models\StorageManager;
use App\Models\Currency;
use Illuminate\Support\Facades\App;
use App\Traits\File\FileUploadTrait;
use App\Services\Feature\FeatureService;
use App\Models\SystemSettingLocalization;
use App\Services\Model\PaymentGateway\PaymentGatewayService; 

class SystemSettingService
{
    use FileUploadTrait;

    public function index():array
    {
        $data = [];
        $data['storages']                = StorageManager::query()->where('is_active', 1)->get();
        $data['currencies']              = Currency::query()->where('is_active', 1)->get();
        $data['paymentGateways']         = (new PaymentGatewayService())->paymentGateways([['is_active', 1]]);
        $data['affiliatePaymentMethods'] = getSetting('affiliate_payout_payment_methods') != null ? json_decode(getSetting('affiliate_payout_payment_methods')) : [];
        $data                            += $this->featureList();

        return $data;

    }
    public function featureList():array
    {
       $data = [];
       $featureService = new FeatureService();

       $data['settingsTabs']         = $featureService->settingsTabs();
       $data['aiFeatureList']        = $featureService->aiFeatureList();
       $data['subscriptionFeatures'] = $featureService->subscriptionFeatures();
       $data['lang_key'] =  $request->lang_key ?? env('DEFAULT_LANGUAGE');
       return $data;
    }
    public function store($request)
    {
        $lang_key = $request->language_key;
        $is_scripts = $request->is_scripts;

        if(!empty($request->settings)) {
            foreach($request->settings as $key=>$value) {
               $this->storeOrUpdate($key, $value, $lang_key, $is_scripts);
            }
        }

        if(!empty($request->env)) {

            foreach($request->env as $key=>$value) {
               $this->storeOrUpdate($key, $value);
               writeToEnvFile($key, $value);
            }
        }

        if($request->type == 'checkbox') {
            $this->storeOrUpdate($request->entity, $request->value);
        }

        // google tts
        if ($request->hasFile('file')) {
            $file     = $request->file;
            $path     = fileService()::DIR_FILE;
            $fileName = $file->getClientOriginalName();
            unlinkFile($path.'/'.$fileName);
            $filePath = $this->fileProcess($file, $path, false, null, null, true);
            $this->storeOrUpdate('google_tts_file_path', $filePath);
            $this->storeOrUpdate('google_tts_file_name', $fileName);
        }

        cacheClear();
    }

    private function storeOrUpdate($key, $value = null, $lang_key = null, $is_scripts = null)
    {

        $value = is_array($value) ? json_encode($value) : $value;

       $settings =  SystemSetting::query()->updateOrCreate([
            "entity" => $key,
           "user_id" => getUserParentId()
       ], [
            "value"     => $is_scripts ? html_entity_decode($value) : $value,
            "is_active" => 1,
            "user_id" => getUserParentId()
       ]);

        if($lang_key) {
            $this->storeLocalizationData($lang_key, $settings->id, $key, $value);
        }

        return $settings;
    }
    public function credentials()
    {
        $featureService = new FeatureService();
        $data = [];
        $data['credentialTabs'] = $featureService->credentialTabs();
        return $data;
    }

    private function storeLocalizationData($lang_key, $system_setting_id, $type, $value)
    {
        if (!is_null($system_setting_id)) {

            return SystemSettingLocalization::query()->updateOrCreate([
                'lang_key' => $lang_key,
                'entity'   => $type,
                "user_id" => getUserParentId()
            ], [
                'value'             => $value,
                'system_setting_id' => $system_setting_id,
                "user_id" => getUserParentId()
            ]);
        }

    }
}
