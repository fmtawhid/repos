<?php

namespace App\Support\Interface;

interface OrderInterface
{
    public function getAll(
        $paginatePluckOrGet = null,
        $myOrders = false,
        $filter = false,
        $limit = null,
        $optionalParams = []
    );


    public function totalSales();


    public function getDeliveryStatusCounts();


    public function pendingOrders();


    public function completeOrders();

    public function canceledOrders();

    public function declinedOrders();
    public function totalOrderAmount();
    public function topSellingProducts();
    public function removeQtyFromStock(object $order);
    public function findByColumnName(array $payloads);
    public function getOrderById(int $id, array | string $withRelationships = []);

    /**
     * -------------------------------------------------------
     * Update Order Status
     * -------------------------------------------------------
     * Aim is to update order status, store order status history into order tracking table, SEND otp for the customer via delivery Boy
     *
     * Case 1 : If the new order delivery is ON THE WAY TO DELIVERY ?
     *         Add delivery amount to the delivery boy wallet
     * Case 2 : If the new order delivery status is SENT_OTP means
     *         Generate a New OTP and store it in otps table and update warehouse_orders table otp_id
     *
     * Execution :
     *  1. Add delivery fee to delivery boy's wallet if the new order delivery status is ON THE WAY TO DELIVERY
     *  2. Generate otp and update warehouse order table if the new order delivery status is SENT_OTP
     *  3. Update order delivery status
     *  4. Update order delivery status history
     *
     * Note: Store OrderTracking in order_tracking table for each delivery_status changes
     * */
    public function updateOrderStatus(object $order, $status);

}