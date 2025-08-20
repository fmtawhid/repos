<?php

namespace App\Http\Controllers\Admin\Support;

use Illuminate\Http\Request;
use App\Models\SupportCategory;
use App\Http\Controllers\Controller;
use App\Traits\Api\ApiResponseTrait;
use App\Services\Model\Support\CategoryService;
use App\Http\Resources\Admin\Support\CategoryResource;
use App\Http\Requests\Admin\Support\CategoryRequestForm;

class CategoryController extends Controller
{
    use ApiResponseTrait;
    protected $appStatic;
    protected $categoryService;
    public function __construct()
    {
        $this->appStatic = appStatic();
        $this->categoryService = new CategoryService();
    }
    public function index(Request $request)
    {
        $data["categories"] = $this->categoryService->getAll(true, null);
       
        if ($request->ajax()) {
            return view('backend.admin.support.categories.category-list', $data)->render();
        }
        return view("backend.admin.support.categories.index")->with($data);
    }
    public function store(CategoryRequestForm $request)
    {
        try {
            $category = $this->categoryService->store($request->getData());
            return $this->sendResponse( 
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("Successfully stored category"),
                CategoryResource::make($category)
            );
        } catch (\Throwable $e) {

            wLog("Failed to Store category", errorArray($e));

            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to store category"),
                [],
                errorArray($e)
            );
        }
    }
    public function edit(SupportCategory $supportCategory)
    {
        return $this->sendResponse(
            $this->appStatic::SUCCESS_WITH_DATA,
            localize("Successfully retrieved category"),
            $supportCategory
        );
    }

    public function update(CategoryRequestForm $request, SupportCategory $supportCategory)
    {
        $data = $this->categoryService->update($supportCategory, $request->getData());
        return $this->sendResponse(
            $this->appStatic::SUCCESS_WITH_DATA,
            localize("Successfully category Updated"),
            CategoryResource::make($data)
        );
    }
    public function destroy(Request $request, SupportCategory $supportCategory)
    {
        try {
        
            if ($request->ajax()) {
                return $this->sendResponse(
                    $this->appStatic::SUCCESS,
                    localize("Successfully deleted category"),
                    $supportCategory->delete()
                );
            }
        } catch (\Throwable $e) {
            wLog("Failed to Delete category", errorArray($e));
            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to Delete : ") . $e->getMessage(),
                [],
                errorArray($e)
            );
        }
    }
}

