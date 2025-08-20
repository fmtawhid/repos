<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    public function index(Request $request)
    {
        $data = $this->languageData($request);
        return view('backend.admin.appearance.privacy.privacy-policy', $data);
    }
    private function languageData($request): array
    {
        $data = [];
        $data['lang_key'] =  $request->lang_key ?? env('DEFAULT_LANGUAGE');
        return $data;
    }
}
