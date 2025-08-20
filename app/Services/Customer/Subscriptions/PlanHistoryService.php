<?php

namespace App\Services\Customer\Subscriptions;

use App\Models\Language;
use App\Models\SubscriptionPlan;
use App\Models\SubscriptionUser;
use Illuminate\Support\Facades\Config;
use App\Services\Model\SubscriptionPlan\SubscriptionPlanService;

class PlanHistoryService {

    public function index() :array
    {
        $data = [];
        $data["plans"]     = (new SubscriptionPlanService())->getAll(null, true);
        $data['histories'] = $this->allPlanHistory();
        return $data;
    }

    public function allPlanHistory()
    {
        return SubscriptionUser::query()->with('customer', 'plan')->when(!isAdmin(), function($q){
            $q->where('user_id', userID());
        })->latest()->paginate(maxPaginateNo());
    }
    public function findById($id)
    {
        return SubscriptionUser::with('customer', 'plan')->where('id', $id)->first();
    }
    public function downloadData($id)
    {
        if (session()->has('locale')) {
            $data['language_code'] = session()->get('locale', Config::get('app.locale'));
        } else {
            $data['language_code'] = env('DEFAULT_LANGUAGE');
        }

        if (session()->has('currency_code')) {
            $data['currency_code'] = session()->get('currency_code', Config::get('app.currency_code'));
        } else {
            $data['currency_code'] = env('DEFAULT_CURRENCY');
        }

        if (Language::where('code', $data['language_code'])->first()->is_rtl == 1) {
            $data['direction'] = 'rtl';
            $data['default_text_align'] = 'right';
            $data['reverse_text_align'] = 'left';
        } else {
            $data['direction'] = 'ltr';
            $data['default_text_align'] = 'left';
            $data['reverse_text_align'] = 'right';
        }

        $currency_code = env('INVOICE_LANG');

        $font_family = env('INVOICE_FONT');

        if ($currency_code == 'BDT' || $currency_code == 'bdt' || $data['language_code'] == 'bd' || $data['language_code'] == 'bn') {
            # bengali font
            $data['font_family'] = "'Hind Siliguri','sans-serif'";
        } elseif ($currency_code == 'KHR' || $data['language_code'] == 'kh') {
            # khmer font
            $data['font_family'] = "'Khmeros','sans-serif'";
        } elseif ($currency_code == 'AMD') {
            # Armenia font
            $data['font_family'] = "'arnamu','sans-serif'";
        } elseif ($currency_code == 'AED' || $currency_code == 'EGP' || $data['language_code'] == 'sa' || $currency_code == 'IQD' || $data['language_code'] == 'ir') {
            # middle east/arabic font
            $data['font_family'] = "'XBRiyaz','sans-serif'";
        } else {
            # general for all
            $data['font_family'] = "'Roboto','sans-serif'";
        }

        $data['history'] = $this->findById($id);

        return $data;
    }
}
