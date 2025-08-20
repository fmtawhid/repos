<?php

namespace App\Http\Controllers\Admin\TemplateCategory;

use Illuminate\Http\Request;
use App\Models\TemplateCategory;
use App\Http\Controllers\Controller;
use App\Traits\Api\ApiResponseTrait;
use App\Http\Resources\Admin\Template\TemplateCategoryResource;
use App\Services\Model\TemplateCategory\TemplateCategoryService;
use App\Http\Requests\Admin\Template\TemplateCategoryStoreRequestForm;
use App\Http\Requests\Admin\Template\TemplateCategoryUpdateRequestForm;

class TemplateCategoryController extends Controller
{
    use ApiResponseTrait;
    protected $templateService;
    protected $appStatic;
    public function __construct()
    {
        $this->templateService = new TemplateCategoryService();
        $this->appStatic = appStatic();
    }

    public function index(Request $request)
    {
        $data["templateCategories"] = $this->templateService->getAll(true, null);
     
        if ($request->ajax()) {
            return view('backend.admin.template-categories.template-category-lists', $data)->render();
        }

        return view("backend.admin.template-categories.index")->with($data);
    }

    public function store(TemplateCategoryStoreRequestForm $request)
    {
        try {
            $templateCategory = $this->templateService->store($request->getData());

            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("Successfully stored Template Category"),
                TemplateCategoryResource::make($templateCategory)
            );
        } catch (\Throwable $e) {

            wLog("Failed to Store Template Category", errorArray($e));

            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to store Template Category"),
                [],
                errorArray($e)
            );
        }
    }

    public function edit(TemplateCategory $templateCategory)
    {
        validateRecordOwnerCheck($templateCategory);
        return $this->sendResponse(
            $this->appStatic::SUCCESS_WITH_DATA,
            localize("Successfully retrieved Template Category"),
            $templateCategory
        );
    }

    public function update(TemplateCategoryUpdateRequestForm $request, TemplateCategory $templateCategory)
    {
        validateRecordOwnerCheck($templateCategory);
        $data = $this->templateService->update($templateCategory, $request->getData());
        return $this->sendResponse(
            $this->appStatic::SUCCESS_WITH_DATA,
            localize("Successfully Template Category Updated"),
            TemplateCategoryResource::make($data)
        );
    }

    public function destroy(Request $request, TemplateCategory $templateCategory)
    {
        try {
            validateRecordOwnerCheck($templateCategory);
            if ($request->ajax()) {
                return $this->sendResponse(
                    $this->appStatic::SUCCESS,
                    localize("Successfully deleted the Template Category"),
                    $templateCategory->delete()
                );
            }
        } catch (\Throwable $e) {
            wLog("Failed to Delete the Template Category", errorArray($e));
            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to Delete : ") . $e->getMessage(),
                [],
                errorArray($e)
            );
        }
    }
}
