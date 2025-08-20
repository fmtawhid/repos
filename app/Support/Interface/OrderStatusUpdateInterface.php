<?php

namespace App\Support\Interface;

interface OrderStatusUpdateInterface
{
    /**
     * Business Logic to update order delivery status
     *
     * NB: Currently Order status is updating from Delivery Boy & Admin Account.
     * Common Checks for both should be done here
     * 1. Is already delivered or cancelled
     * 2. When updating from Delivery Boy Account.  is the request delivery_status_id for canceled, delivered, Picked Up, On the way
     * 3. If the new order delivery status is completed/delivered status ?
     *      3.1 If the order is paid? Continue the process.
     *      3.2 If the order is not paid? throw exception as "Order is not paid yet."
     * 4. When updating from Admin account as order delivered/completed.
     *      4.1 Check the Order OTP is verified or not
     *      4.2 If the order otp is not verified, throw exception as "Order OTP is not verified."
     * 5. After update the order status. check the order is delivered?
     *     5.1 If the order is delivered?
     *          5.1.1 If the order has delivery boy engagement?
     *              4.1.1.1 Update delivery boy's wallet balance with order commission through a new Transaction Record
     *          5.1.2 Is the order from merchant account?
     *              4.1.2.1 If yes, Call the ProductFacade to clone the products for the merchant account product.
     *          5.1.3 Create a transaction record for the order and update seller wallet
     *     5.2 If the order is declined?
     *          5.2.1 If the order has delivery boy engagement?
     *              5.2.1.1 Update delivery boy's wallet balance with order commission through a new Transaction Record
     *     5.3 If the order is canceled?
     *          5.3.1 If the order has delivery boy engagement?
     *              5.3.1.1 Update delivery boy's wallet balance with order commission through a new Transaction Record
     *              5.3.1.2 Revert the product sold + stock and update the order_products
     *              5.3.1.3 Create a refund request for the customer if the order is paid.
     * */
    public function updateOrderDeliveryStatus(object $order, $deliveryStatusId);

}