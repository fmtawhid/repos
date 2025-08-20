<?php

namespace App\Http\Controllers\Admin\Appearance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index(Request $request)
    {
        $data = $this->languageData($request);
        return view('backend.admin.appearance.aboutUs.about-us', $data);
    }
    private function languageData($request): array
    {
        $data = [];
        $data['lang_key'] =  $request->lang_key ?? env('DEFAULT_LANGUAGE');
        return $data;
    }
}
