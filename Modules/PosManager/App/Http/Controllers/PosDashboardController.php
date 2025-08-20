<?php

namespace Modules\PosManager\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\MenuItem\MenuItemService;
use App\Services\Model\User\UserService;
use App\Services\QrCode\QrCodeService;
use App\Traits\Api\ApiResponseTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\BranchModule\App\Services\BranchService;
use Modules\CartManager\Services\Action\CartActionService;
use Modules\PosManager\App\Http\Requests\CustomerStoreRequest;
use Modules\PosManager\Services\Action\PosDashboardActionService;
use DB;

class PosDashboardController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, PosDashboardActionService $posDashboardActionService)
    {
        $productOwnerId = getUserParentId();

        //get table id from qr code
        $qrcode = request()->has('qrcode') ? request()->query('qrcode') : null;
        if($qrcode){
            $data["table_id"] = (new QrCodeService())->getTableByQrCode($qrcode);
        }else{
            $data["table_id"] = null;
        }

        // Ajax
        if ($request->ajax()) {

            try{
                // Vendor CUSTOMERS
                if ($request->has("loadVendorCustomers")) {

                    $data["customers"] = (new UserService())->getVendorCustomers();

                    return view("posmanager::render.render-customers")->with($data)->render();
                }
               
                // Branch Employees
                if ($request->has("loadBranchEmployees")) {

                    $data["employees"] = (new BranchService())->getUsersByBranchId(getUserBranchId());

                    return view("posmanager::render.render-employees")->with($data)->render();
                }

                // Categories
                if ($request->has("loadCategories")) {

                    $data["categories"] = $posDashboardActionService->getCategoriesByProductProductOwnerId($productOwnerId);

                    return view("posmanager::render.render-categories")->with($data)->render();
                }

                // Products
                if ($request->has("loadProducts")) {

                    $branchId = $request->branch_id ?? getUserBranchId();

                    $data["products"] = $posDashboardActionService->getProductsByBranchIdAndVendorId(getUserParentId(), $branchId);

                    return view("posmanager::modals.render-modal-item")->with($data)->render();
                }

                // Load Carts
                if ($request->has("loadCarts")) {

                    return $this->sendResponse(
                        appStatic()::SUCCESS_WITH_DATA,
                        localize("Carts Loaded Successfully"),
                        (new CartActionService())->init() // Will get cart_items, sub_total, tax, grand_total of the cart
                    );
                }


                // Load Tables
                if ($request->has("loadTables")) {

                    $areas = $posDashboardActionService->getAreasByBranchId(getUserBranchId(), true);

                    $data["areas"] = $areas;

                    return view("posmanager::render.render-tables")->with($data)->render();
                }
            }
            catch(\Throwable $e){
                ddError($e);
            }
        }

        return view('posmanager::dashboard.dashboard')->with($data);
    }


     public function shops(Request $request, UserService $userService, MenuItemService $productService, PosDashboardActionService $posDashboardActionService)
    {
        if ($request->ajax()) {
            $products = $productService->getAll(
                true
            );
 
            $query            = $products;

            $nextPageUrl = $request->fullUrlWithQuery([
                'page' => $products->currentPage() + 1,
            ]);

            
            $branchId = $request->branch_id ?? getUserBranchId();
            $data["products"] = $posDashboardActionService->getProductsByBranchIdAndVendorId(getUserParentId(), $branchId);
            $renderedView =  view("posmanager::modals.render-modal-item")->with($data)->render();

            return $this->sendResponse(
                appStatic()::SUCCESS_WITH_DATA,
                "Products Fetched Successfully",
                $renderedView,
                [],
                [
                    "total_products"         => $query->total(),
                    "next_page_url"          => $query->hasMorePages() ? $nextPageUrl : null,
                    "has_more_page"          => $query->hasMorePages(),
                    "current_page"           => $query->currentPage(),
                    "per_page"               => $query->perPage(),
                    "total_showing_products" => showingRangeText($query)
                ]
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posmanager::create');
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('posmanager::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('posmanager::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
    
    public function register(CustomerStoreRequest $request, PosDashboardActionService $posDashboardActionService)
    {
        if(isCustomer()){
            flashMessage("error", localize("Sorry, you do not have permission to access this page"));

            return redirect()->route("home");
        }

        try {
            DB::beginTransaction();

            $registerCustomer = $posDashboardActionService->registerNewCustomer($request->getData());

            DB::commit();

            return $this->sendResponse(
                requestResponse()::SUCCESS_WITH_DATA,
                localize("Customer Registered Successfully"),
                $registerCustomer["customer"],
                [],
                ["user_address" => null]
            );
        } catch (\Throwable $e) {

            DB::rollBack();
            // wLog("Failed to register customer", errorArray($e), logService()::LOG_POS);

            dd(errorArray($e));
        }
    }
}
