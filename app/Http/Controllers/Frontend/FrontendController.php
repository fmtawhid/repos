<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Page;
use App\Services\Model\FAQ\FAQService;
use App\Services\Model\OfflinePaymentMethod\OfflinePaymentMethodService;
use App\Services\Model\SubscriptionPlan\SubscriptionPlanService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function privacyPolicy()
    {
        return view('frontend.default.pages.quickLinks.privacy-policy');
    }
    public function termsConditions()
    {
        return view('frontend.default.pages.quickLinks.terms-conditions');
    }
    public function page($slug)
    {
        $data['page'] = Page::where('slug', $slug)->first();
        return view('frontend.default.pages.quickLinks.pages', $data);
    }

    public function pricing(Request $request)
    {
        $data['plans']  = (new SubscriptionPlanService())->plans('monthly', true);
        $data['faqs']   = (new FAQService())->getAll(true, true);
        $data["payments"]  = (new SubscriptionPlanService())->payments();
        $data["offlinePaymentMethods"]  = (new OfflinePaymentMethodService())->getAll(false, 1);


        return view("frontend.default.pages.quickLinks.pricing")->with($data);
    }
}
