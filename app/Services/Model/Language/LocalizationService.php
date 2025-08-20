<?php

namespace App\Services\Model\Language;

use App\Models\Language;
use App\Models\Localization;
use Illuminate\Support\Facades\Cache;

class LocalizationService
{

    public function defaultLocalizations()
    {
        $request           = request();
        $searchKey         = null;
        $localizations     = Localization::where('lang_key', 'en');
        if ($request->has('search')) {
            $searchKey     = $request->search;
            $localizations = $localizations->where('t_value', 'like', '%' . $searchKey . '%');
        }
        $localizations         = $localizations->paginate(100);
        $data                  = [];
        $data['searchKey']     = $searchKey;
        $data['localizations'] = $localizations;
        
        return $data;

    }
    public function store($request)
    {
        $language = Language::findOrFail($request->id);
        foreach ($request->values as $key => $value) {
            $localization = Localization::where('t_key', $key)->where('lang_key', $language->code)->latest()->first();
            if ($localization == null) {
                $localization = new Localization;
                $localization->lang_key = $language->code;
                $localization->t_key = $key;
                $localization->t_value = $value ? $value : '';
                $localization->save();
            } else {
                $localization->t_value = $value ? $value : '';
                $localization->save();
            }
        }
        Cache::forget('localizations-' . $language->code);
    }

    public function show(int $id):array
    {
        $data = [];
        $data['language'] = $this->languageService()->findById($id);
        $data += $this->defaultLocalizations();
        return $data;
    }
    private function languageService()
    {
        return new LanguageService();
    }

    
}
