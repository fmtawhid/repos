<?php

namespace Modules\PosManager\Services\Action;

use App\Constants\NotificationActions;
use App\Events\OrderPlaced;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Modules\PosManager\Http\Requests\PosOrderRequest;
use Modules\PosManager\Services\Business\PosOrderService;

class PosOrderActionService
{
    private $orderService;

    public function __construct()
    {
        $this->orderService = new PosOrderService();
    }

    /**
     * Order Placing
     *
     * - Order Save
     * - Order Products Save
     * - Order Address Save
     * - Notification Send to the customer via Event.
     *
     * @param array $data
     * @return Builder|Model $order
     * @throws \Exception
     */

    public function placeOrder(array $data): Model|Builder
    {
        // Place Order
        $order = $this->orderService->store($data);

        // Order Payments
        if(isCardPay($data["payment_method"] ?? null)){
            $orderPayments = $this->orderService->saveOrderPayments($order, $data);
        }

        // Order Products
        $orderProducts = $this->orderService->saveOrderProducts($order, $data);

        foreach ($orderProducts as $orderProduct) {
            // Save Order Product Addons
            $this->orderService->saveOrderSalesCount($orderProduct);
        }
        return $order;
    }

    public function notificationShare(object $order)
    {
        // Prepare message data (this can be customized based on your application)
        $messageData = [
            'customer_name'     => $order->customer?->fullName ?? "",
            'order_code'        => $order->order_code,
            'orderObj'          => $order,
            'customer_user_type' => $order->customer->user_type ?? null,
        ];

        // Dispatch the event to trigger the listener
        event(new OrderPlaced(NotificationActions::ORDER_PLACED, $order, $messageData));

        return $order;
    }

    public function getFilteredPosOrdersByBranchId($branchId)
    {
        return $this->orderService->getFilteredPosOrdersByBranchId($branchId);
    }

    public function getFilteredPosKitchenOrdersByBranchId($branchId)
    {
        return $this->orderService->getFilteredPosKitchenOrdersByBranchId($branchId);
    }

    public function updateOrderStatus(array $data)
    {
        return $this->orderService->updateOrderStatus($data);
    }


    public function updateOrderProductStatus($data)
    {
        return $this->orderService->updateOrderProductStatus($data);
    }
    
    public function getOrderById($orderId)
    {
        return $this->orderService->getOrderById($orderId);
    }
    
    public function receiveBill()
    {
        return $this->orderService->receiveBill();
    }

}
