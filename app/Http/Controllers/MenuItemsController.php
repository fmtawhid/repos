<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\MenuItem\MenuItemStoreRequest;
use App\Http\Requests\Admin\MenuItem\MenuItemUpdateRequest;
use App\Models\Product;
use App\Services\ItemCategory\ItemCategoryService;
use App\Services\Menu\MenuService;
use App\Services\MenuItem\MenuItemService;
use App\Traits\Api\ApiResponseTrait;
use App\Utils\AppStatic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuItemsController extends Controller
{
    use ApiResponseTrait;

    protected $appStatic;
    protected $service;
    protected $menuService;
    protected $itemCategoryService;

    public function __construct()
    {
        $this->appStatic            = new AppStatic();
        $this->service              = new MenuItemService();
        $this->menuService          = new MenuService();
        $this->itemCategoryService  = new ItemCategoryService();
    }

    // INDEX
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Fetch all menu items including soft-deleted ones
            $data["menuItems"] = Product::with(['category', 'productAttributes'])
                ->withTrashed()   // include soft-deleted products
                ->latest()
                ->paginate(10);

            return view('backend.admin.menuItems.list', $data)->render();
        }

        // Non-AJAX page load
        $data["menus"] = $this->menuService->getAll(true);
        $data["itemCategories"] = $this->itemCategoryService->getAll(true);

        return view("backend.admin.menuItems.index")->with($data);
    }


    // STORE
    public function store(MenuItemStoreRequest $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->getValidatedData();

            $menuItem = $this->service->store($data)->storeVariations($data);

            DB::commit();

            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("Menu Item Created Successfully"),
                $menuItem
            );
        } catch (\Throwable $e) {
            DB::rollBack();
            wLog("Failed to store Menu Items", errorArray($e));
            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to create Menu Item"),
                [],
                errorArray($e)
            );
        }
    }

    // EDIT
    public function edit(Request $request, $id)
    {
        $data["menuItems"] = $this->service->findbyid($id, ['productAttributes', 'category']);
        return $this->sendResponse(
            $this->appStatic::SUCCESS_WITH_DATA,
            localize("Edit Menu Item"),
            $data
        );
    }

    // UPDATE
    public function update(MenuItemUpdateRequest $request, Product $menuItem)
    {
        try {
            DB::beginTransaction();

            $data = $request->getValidatedData();

            $menuItem = $this->service
                ->updateMenuItem($menuItem, $data)
                ->updateOrCreateVariations($menuItem, $data);

            DB::commit();

            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("Menu Item Updated Successfully"),
                $menuItem
            );
        } catch (\Throwable $e) {
            DB::rollBack();
            wLog("Failed to update Menu Items", errorArray($e));
            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to Update Menu Item"),
                [],
                errorArray($e)
            );
        }
    }

    // SOFT DELETE
    public function destroy(Request $request, Product $menuItem)
    {
        if ($request->ajax()) {
            try {
                DB::beginTransaction();

                // Soft delete product
                $menuItem->delete();

                // Only soft delete attributes NOT linked to orders
                $menuItem->productAttributes()
                    ->doesntHave('orderProducts')
                    ->delete();

                DB::commit();

                return $this->sendResponse(
                    $this->appStatic::SUCCESS,
                    localize("Menu Item successfully deleted")
                );
            } catch (\Throwable $e) {
                DB::rollBack();
                wLog("Failed to Delete Menu Items", errorArray($e));
                return $this->sendResponse(
                    $this->appStatic::VALIDATION_ERROR,
                    localize("Failed to Delete Menu Item: ") . $e->getMessage(),
                    [],
                    errorArray($e)
                );
            }
        }
    }

    // RESTORE
    public function restore($id)
    {
        $menuItem = Product::onlyTrashed()->findOrFail($id);

        $menuItem->restore();

        // If ProductAttribute uses SoftDeletes, uncomment the next line
        // $menuItem->productAttributes()->withTrashed()->restore();

        return redirect()->back()->with('success', localize("Menu Item restored successfully"));
    }

    // FORCE DELETE
    public function forceDelete($id)
    {
        $menuItem = Product::onlyTrashed()->findOrFail($id);

        DB::beginTransaction();

        try {
            // 1️⃣ Remove order links for this product
            \DB::table('order_products')->where('product_id', $menuItem->id)->delete();

            // 2️⃣ Delete product attributes (if not linked to orders)
            $menuItem->productAttributes()->doesntHave('orderProducts')->forceDelete();

            // 3️⃣ Permanently delete product
            $menuItem->forceDelete();

            DB::commit();

            return $this->sendResponse(
                $this->appStatic::SUCCESS,
                localize("Menu Item permanently deleted")
            );

        } catch (\Throwable $e) {
            DB::rollBack();
            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to force delete Menu Item: ") . $e->getMessage(),
                [],
                errorArray($e)
            );
        }
    }


}
