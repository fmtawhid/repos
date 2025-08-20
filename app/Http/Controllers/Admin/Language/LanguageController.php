<?php

namespace App\Http\Controllers\Admin\Language;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Api\ApiResponseTrait;
use App\Services\Model\Language\LanguageService;
use App\Http\Requests\Language\LanguageRequestForm;
use App\Http\Resources\LanguageResource;
use App\Models\Language;

class LanguageController extends Controller
{
    use ApiResponseTrait;
    protected $appStatic;
    protected $languageService;
    public function  __construct()
    {
        $this->appStatic = appStatic();
        $this->languageService = new LanguageService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data["languages"] = $this->languageService->getAll(true, null);
        if ($request->ajax()) {
            return view('backend.admin.languages.language-list', $data)->render();
        }
        return view("backend.admin.languages.index")->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LanguageRequestForm $request)
    {
        try {
           
            $language = $this->languageService->store($request->getData());
        
            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("Successfully stored language"),
                LanguageResource::make($language)
            );
        } catch (\Throwable $e) {

            wLog("Failed to Store language", errorArray($e));

            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to store language"),
                [],
                errorArray($e)
            );
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Language $language)
    {
        return $this->sendResponse(
            $this->appStatic::SUCCESS_WITH_DATA,
            localize("Successfully retrieved language"),
            $language
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LanguageRequestForm $request, Language $language)
    {
        $data = $this->languageService->update($language, $request->getData());
        return $this->sendResponse(
            $this->appStatic::SUCCESS_WITH_DATA,
            localize("Successfully language Updated"),
            LanguageResource::make($data)
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Language $language)
    {
        try {
            if ($request->ajax()) {
                return $this->sendResponse(
                    $this->appStatic::SUCCESS,
                    localize("Successfully deleted language"),
                    $language->delete()
                );
            }
        } catch (\Throwable $e) {
            wLog("Failed to Delete Folder", errorArray($e));
            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to Delete : ") . $e->getMessage(),
                [],
                errorArray($e)
            );
        }
    }
    # change the language
    public function changeLanguage(Request $request)
    {
        $request->session()->put('locale', $request->locale);
        return true;
    }
}
