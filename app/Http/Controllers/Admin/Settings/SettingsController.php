<?php

namespace App\Http\Controllers\Admin\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Api\ApiResponseTrait;
use App\Services\Action\AiAvatarProActionService;
use App\Services\Model\SystemSetting\SystemSettingService;

class SettingsController extends Controller
{
    use ApiResponseTrait;
    protected $appStatic;
    protected $settingsService;

    public function __construct()
    {
        $this->appStatic = appStatic();
        $this->settingsService = new SystemSettingService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = $this->settingsService->index();

        return view('backend.admin.settings.index', $data);
    }

    public function credentials()
    {
        $data = $this->settingsService->credentials();
        return view('backend.admin.settings.credentials', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $this->settingsService->store($request);


            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("Successfully Updated"),
            );
        } catch (\Throwable $e) {

            wLog("Failed to Store Folder", errorArray($e));

            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to update"),
                [],
                errorArray($e)
            );
        }
    }

}
