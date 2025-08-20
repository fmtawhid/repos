<?php

namespace App\Http\Controllers\v1\Admin\Order;

use App\Http\Controllers\Controller;
use App\Traits\Api\ApiResponseTrait;
use Illuminate\Http\Request;
use Modules\BranchModule\App\Services\BranchService;
use Modules\PosManager\Services\Action\PosOrderActionService;

class OrderController extends Controller
{
    use ApiResponseTrait;
    public function index(Request $request, PosOrderActionService $posOrderActionService, BranchService $branchService)
    {
        if(isAjax()){
            try {
                // Pos Order Filters
                if($request->has("posOrdersFilter")){

                    $branchId = $request->branch_id ?? getUserBranchId();

                    $orders = $posOrderActionService->getFilteredPosOrdersByBranchId($branchId);

                    $ordersHtml = view("backend.admin.orders.render.render-orders", ["orders" => $orders])->render();

                    $paginateArr = [
                        "total"         => $orders->total(),
                        "count"         => $orders->count(),
                        "per_page"      => $orders->perPage(),
                        "next_page_url" => $orders->nextPageUrl(),
                        "has_next_page" => $orders->hasMorePages(),
                    ];

                    return $this->sendResponse(
                        requestResponse()::SUCCESS_WITH_DATA,
                        localize("Orders List"),
                        $ordersHtml,
                        [],
                        $paginateArr
                    );
                }
            } catch (\Exception $e) {
                return $this->sendResponse(
                    requestResponse()::VALIDATION_ERROR,
                    localize("Failed to get orders"),
                    [],
                    errorArray($e)
                );
            }
        }

        $data["branches"] = $branchService->getBranchesByVendorId(getUserParentId());
        $data["employees"] = (new BranchService())->getUsersByBranchId(getUserBranchId());



        return view("backend.admin.orders.index")->with($data);
    }


    public function updateOrderStatus(Request $request,  PosOrderActionService $posOrderActionService)
    {
        try {
            $order = $posOrderActionService->updateOrderStatus($request->all());
            if($order){
                return $this->sendResponse(
                    requestResponse()::SUCCESS_WITH_DATA,
                    localize("Successfully updated order status"),
                    $order
                );
            }else{
                return $this->sendResponse(
                    requestResponse()::VALIDATION_ERROR,
                    localize("Failed to update order status"),
                    $order
                );
            }
            
        } catch (\Exception $e) {
            return $this->sendResponse(
                requestResponse()::VALIDATION_ERROR,
                localize("Failed to update order status"),
                [],
                errorArray($e)
            );
        }
    } 

    public function updateOrderProductStatus(Request $request,  PosOrderActionService $posOrderActionService)
    {
        try {
            $orderProduct = $posOrderActionService->updateOrderProductStatus($request->all());

            if($orderProduct){
                return $this->sendResponse(
                    requestResponse()::SUCCESS_WITH_DATA,
                    localize("Successfully updated order product status"),
                    $orderProduct
                );
            }else{
                return $this->sendResponse(
                    requestResponse()::VALIDATION_ERROR,
                    localize("Failed to update order product status"),
                    $orderProduct
                );
            }
            
        } catch (\Exception $e) {
            return $this->sendResponse(
                requestResponse()::VALIDATION_ERROR,
                localize("Failed to update order product status"),
                [],
                errorArray($e)
            );
        }
    } 


    public function kitchenOrders(Request $request, PosOrderActionService $posOrderActionService)
    {
        if(isAjax()){
            try {
                // Pos Order Filters
                if($request->has("posOrdersFilter")){

                    $orders = $posOrderActionService->getFilteredPosKitchenOrdersByBranchId(getUserBranchId());

                    $ordersHtml = view("backend.admin.kitchen-orders.render.render-kitchen-orders", ["orders" => $orders])->render();

                    $paginateArr = [
                        "total"         => $orders->total(),
                        "count"         => $orders->count(),
                        "per_page"      => $orders->perPage(),
                        "next_page_url" => $orders->nextPageUrl(),
                        "has_next_page" => $orders->hasMorePages(),
                    ];

                    return $this->sendResponse(
                        requestResponse()::SUCCESS_WITH_DATA,
                        localize("Kitchen Orders List"),
                        $ordersHtml,
                        [],
                        $paginateArr
                    );
                }
            } catch (\Exception $e) {
                return $this->sendResponse(
                    requestResponse()::VALIDATION_ERROR,
                    localize("Failed to get Kitchen orders"),
                    [],
                    errorArray($e)
                );
            }
        }

        return view("backend.admin.kitchen-orders.index");
    }
}
