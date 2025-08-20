<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ItemCategory\ItemCategoryStoreRequest;
use App\Http\Requests\Admin\ItemCategory\ItemCategoryUpdateRequest;
use App\Models\ItemCategory;
use App\Services\ItemCategory\ItemCategoryService;
use Illuminate\Http\Request;
use App\Traits\Api\ApiResponseTrait;
use App\Utils\AppStatic;
use Illuminate\Support\Facades\DB;


class ItemCategoryController extends Controller
{
    use ApiResponseTrait;
    protected $appStatic;
    protected $service;

    public function __construct()
    {
        $this->appStatic   = new AppStatic();
        $this->service     = new ItemCategoryService();
    }

    public function index(Request $request)
    {
        $data["itemCategories"] = $this->service->getAll(true);

        if ($request->ajax()) {
            $data["itemCategories"] = $this->service->getAll(true);

            return view('backend.admin.item-categories.list', $data)->render();
        }

        return view("backend.admin.item-categories.index");
    }


    public function store(ItemCategoryStoreRequest $request) {
        try {
            DB::beginTransaction();
            $data = $request->getValidatedData();
            // Item Category Data Storing
            $itemCategory = $this->service->store($data);
            DB::commit();
            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("Item Category Created Successfully"),
                $itemCategory
            );
        } catch (\Throwable $e) {
            DB::rollBack();
            wLog("Failed to store Item Category", errorArray($e));
            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to create Item Category"),
                [],
                errorArray($e)
            );
        }
    }

    public function edit(Request $request, $id)
    {
        return $this->sendResponse(
            appStatic()::SUCCESS_WITH_DATA,
            localize("Edit Item Category"),
            $this->service->findbyid($id)
        );
    }


    public function update(ItemCategoryUpdateRequest $request, ItemCategory $itemCategory)
    {
        try {
            DB::beginTransaction();
            $data = $request->getValidatedData();
            $itemCategory->update($data);
            DB::commit();
            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("Item Category Updated Successfully"),
                $itemCategory
            );
        } catch (\Throwable $e) {
            DB::rollBack();
            wLog("Failed to store Item Category", errorArray($e));
            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to Update Item Category"),
                [],
                errorArray($e)
            );
        }
    }

    public function destroy(Request $request, ItemCategory $itemCategory)
    {
        if ($request->ajax()) {
            try {
                return $this->sendResponse(
                    $this->appStatic::SUCCESS,
                    localize("Item Category successfully deleted"),
                    $itemCategory->delete()
                );
            }
            catch (\Throwable $e) {
                wLog("Failed to Delete Item Category", errorArray($e));
                return $this->sendResponse(
                    $this->appStatic::VALIDATION_ERROR,
                    localize("Failed to Delete : ") . $e->getMessage(),
                    [],
                    errorArray($e)
                );
            }
        }
    }
}
