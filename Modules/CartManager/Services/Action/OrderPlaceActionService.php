<?php

namespace Modules\CartManager\Services\Action;

use App\Constants\NotificationActions;
use App\Events\OrderPlaced;
use App\Services\Models\Order\OrderService;
use App\Services\Models\OrderProduct\OrderProductService;
use Modules\CartManager\Services\Business\OrderPlaceService;

class OrderPlaceActionService
{
    private $orderPlaceService;

    public function __construct()
    {
        $this->orderPlaceService = new OrderPlaceService();
    }


    /**
     * @throws \Exception
     */
    public function placeOrder(array $data)
    {
        // Place Order
        $order = $this->orderPlaceService->store($data);

        if (!empty($order->applied_coupon_code)) {
            // Order Coupon Track
            $this->orderPlaceService->saveOrderCouponTrack($order);
        }

        // Order Products
        $orderProducts = $this->orderPlaceService->saveOrderProducts($order, $data);

        // Order Address
        $orderAddress = $this->orderPlaceService->saveOrderAddress($order, $data);

        // Notification Send to the customer
        $this->notificationShare($order);

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

    public function updateOrderProductsStockQty(object $orderProducts)
    {
        $stockArr = [];
        // Update the product stock qty
        foreach ($orderProducts as $orderProduct) {
            $this->updateOrderProductVariationStockByOrderProduct($orderProduct);
        }

        return $stockArr;
    }

    public function updateOrderProductVariationStockByOrderProduct($orderProduct){

        $stockArr = $orderProduct->variation?->stock?->update([
            'stock_qty' => $orderProduct->variation->stock->stock_qty - $orderProduct->qty,
        ]);

        return $stockArr;
    }
}
