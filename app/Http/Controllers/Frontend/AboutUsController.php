<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Model\FAQ\FAQService;

class AboutUsController extends Controller
{
    public function index()
    {
        $data['brands']              = getSetting('brand_is_active') == 1 ? explode(',', getSetting('brand_background_images')) : null;
        $data['faqs']                = (new FAQService())->getAll(true, true);
        return view('frontend.default.pages.quickLinks.about-us', $data);
    }
}
