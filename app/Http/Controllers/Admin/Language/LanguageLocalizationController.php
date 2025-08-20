<?php

namespace App\Http\Controllers\Admin\Language;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Api\ApiResponseTrait;
use App\Services\Model\Language\LocalizationService;

class LanguageLocalizationController extends Controller
{
    use ApiResponseTrait;
    protected $appStatic;
    protected $localizationService;
    public function  __construct()
    {
        $this->appStatic = appStatic();
        $this->localizationService = new LocalizationService();
    }
    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $data = $this->localizationService->show($id);
        if ($request->ajax()) {
            return view('backend.admin.localizations.list', $data)->render();
        }
        return view('backend.admin.localizations.index', $data);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $this->localizationService->store($request);

            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("Successfully Translated"),
            );
        } catch (\Throwable $e) {

            wLog("Failed to Translate", errorArray($e));

            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to Translate"),
                [],
                errorArray($e)
            );
        }
       
        return redirect()->back();
     
    }
}
