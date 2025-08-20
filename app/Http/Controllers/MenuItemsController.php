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

    // show all menu list
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data["menuItems"]       = $this->service->getAll(true);

            return view('backend.admin.menuItems.list', $data)->render();
        }

        $data["menus"]           = $this->menuService->getAll(true);
        $data["itemCategories"]  = $this->itemCategoryService->getAll(true);

        return view("backend.admin.menuItems.index")->with($data);
    }

    // add new menu
    public function store(MenuItemStoreRequest $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->getValidatedData();

            // Menu Items Data Storing
            $menuItem = $this->service->store($data)->storeVariations($data);

            DB::commit();

            return $this->sendResponse(
                $this->appStatic::SUCCESS_WITH_DATA,
                localize("Menu Items Created Successfully"),
                $menuItem
            );
        } catch (\Throwable $e) {

            DB::rollBack();

            wLog("Failed to store Menu Items", errorArray($e));

            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to create Menu Items"),
                [],
                errorArray($e)
            );
        }
    }

    public function show(Request $request, $id)
    {
        if ($request->ajax()) {

            $product = $this->service->findById($id);

             // POS Product
            $product = $product->load([
                "attributes"
            ]);

            $data["product"] = $product;

            $renderedHtml = view("posmanager::render.render-product-modal")->with($data)->render();

            return $renderedHtml;
        }
    }


    // edit the menu
    public function edit(Request $request, $id)
    {
        $data["menuItems"] = $this->service->findbyid($id, ['productAttributes', 'category']);
        return $this->sendResponse(
            appStatic()::SUCCESS_WITH_DATA,
            localize("Edit Menu Items"),
            $data
        );
    }

    // update the menu
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
                localize("Menu Item updated successfully"),
                $menuItem
            );
        } catch (\Throwable $e) {
            DB::rollBack();
            wLog("Failed to store Menu Items", errorArray($e));
            return $this->sendResponse(
                $this->appStatic::VALIDATION_ERROR,
                localize("Failed to Update Menu Item"),
                [],
                errorArray($e)
            );
        }
    }

    // delete the menu
    public function destroy(Request $request, Product $menuItem)
    {
        if ($request->ajax()) {
            try {
                $menuItem->productAttributes()->delete();
                $menuItemDeleted = $menuItem->delete();
                return $this->sendResponse(
                    $this->appStatic::SUCCESS,
                    localize("Menu Item successfully deleted"),
                    $menuItemDeleted
                );
            }
            catch (\Throwable $e) {
                wLog("Failed to Delete Menu Items", errorArray($e));
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

