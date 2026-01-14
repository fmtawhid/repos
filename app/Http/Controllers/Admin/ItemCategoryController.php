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
        $this->appStatic = new AppStatic();
        $this->service   = new ItemCategoryService();
    }

    public function index(Request $request)
    {
        $query = ItemCategory::withTrashed()->latest();
        $data['itemCategories'] = $query->paginate(10);

        if ($request->ajax()) {
            return view('backend.admin.item-categories.list', $data)->render();
        }

        return view("backend.admin.item-categories.index", $data);
    }

    public function store(ItemCategoryStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->getValidatedData();
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

    public function edit($id)
    {
        $itemCategory = $this->service->findbyid($id);
        return $this->sendResponse(
            $this->appStatic::SUCCESS_WITH_DATA,
            localize("Edit Item Category"),
            $itemCategory
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
            wLog("Failed to Update Item Category", errorArray($e));

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
                $itemCategory->delete();
                return $this->sendResponse(
                    $this->appStatic::SUCCESS,
                    localize("Item Category successfully deleted")
                );
            } catch (\Throwable $e) {
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

    public function restore($id)
    {
        $itemCategory = ItemCategory::onlyTrashed()->findOrFail($id);
        $itemCategory->restore();

        return redirect()->back()->with('success', localize("Item Category restored successfully"));
    }

    public function forceDelete($id)
    {
        $itemCategory = ItemCategory::onlyTrashed()->findOrFail($id);

        // Set item_category_id to null for all linked products
        $itemCategory->products()->update(['item_category_id' => null]);

        // Permanently delete the category
        $itemCategory->forceDelete();

        return $this->sendResponse(
            $this->appStatic::SUCCESS,
            localize("Item Category permanently deleted")
        );
    }

}
