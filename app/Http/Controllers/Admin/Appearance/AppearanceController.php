<?php

namespace App\Http\Controllers\Admin\Appearance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Api\ApiResponseTrait;
use App\Services\Appearance\AppearanceService;

class AppearanceController extends Controller
{
    use ApiResponseTrait;
    protected $appStatic;
    protected $appearanceService;
    public function __construct()
    {
        $this->appStatic = appStatic();
        $this->appearanceService = new AppearanceService();
    }
    public function index(Request $request)
    {
        $data = $this->languageData($request);
        $data += $this->appearanceService->index();

        return view('backend.admin.appearance.index', $data);
    }
    public function update(Request $request)
    {

        try {
            $data = $this->appearanceService->storeOrUpdate($request);

            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("Successfully Updated"),
            );
        } catch (\Throwable $e) {

            wLog("Failed to Store data", errorArray($e));

            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to update"),
                [],
                errorArray($e)
            );
        }
    }
    private function languageData($request): array
    {
        $data = [];
        $data['lang_key'] =  $request->lang_key ?? env('DEFAULT_LANGUAGE');
        return $data;
    }
}
