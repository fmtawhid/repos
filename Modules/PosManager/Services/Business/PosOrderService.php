<?php

namespace Modules\PosManager\Services\Business;

use App\Models\Order;
use App\Models\OrderPayment;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Log;
use Modules\TransactionManager\App\Models\Transaction;
use Modules\CartManager\Services\Business\CartService;
use App\Traits\Global\GlobalTrait;
use Modules\CartManager\Services\Action\CartActionService;

class PosOrderService
{

    use GlobalTrait;
    public function store(array $data)
    {

        $cartInfo = getCartInfo();

        $orderDiscountTotal = 0;
        $orderTotal         = getCartSubTotal($cartInfo);

        $discountType  = request()->discount_type ?? 0;
        $discountValue = request()->discount_value ?? 0;


        if(request()->has("discount_type")){
            $orderDiscountTotal = (double) discountCalculations($orderTotal,$discountValue, $discountType);
        }

        $payableAfterDiscount = getCartGrandTotal($cartInfo) - $orderDiscountTotal;

        $orderPayload =$data+[
            "status_id"              => constantFlags()::ORDER_PENDING,
            "is_paid"                => constantFlags()::PAYMENT_UNPAID,
            "total_qty"              => getCartTotalQty($cartInfo),
            "total_shipping_cost"    => getCartShippingCost($cartInfo),
            "total"                  => $orderTotal,
            "discount_type"          => $discountType,
            "discount_value"         => $discountValue,
            "discounted_amount"      => $orderDiscountTotal,
            "payable_after_discount" => $payableAfterDiscount,
            "order_type"             => isCOD($data["payment_method"]) ? 0 : 1 // 0=>cod, 1=>online
        ];

        if($data['is_take_way_order'] == 2){
            unset($orderPayload['table_id']);
        }

        // Check Customer id already exists or not
        if(!isset($orderPayload["customer_id"])){
            $orderPayload["customer_id"] = request()->customer_id ?? userID(); // set customer_id from request either logged in user as customer_id
        }

        commonLog("Before Order Place Payloads",["orderPayloads"=> $orderPayload], logService()::LOG_ORDER);

        // Order Create
        $order = $this->placeOrder($orderPayload); // $order will use for dd


        return $order;
    }

    public function placeOrder(array $payloads)
    {
        return Order::query()->create($payloads);
    }


    public function saveOrderProducts(object $order, $getReturnOrderProduct = true)
    {

        $cartService = new CartActionService();

        $carts = $cartService->getCartsByUserId(userId());

        $cartInfo = getCartInfo();

        // Throw exceptions if the carts count is 0
        if(empty($cartInfo["cart_items"])){
            throw new \Exception(localize("Sorry You don't have any items in your cart."));
        }


        $totalTaxAmount      = 0;
        $subTotalAmount      = 0;
        $shippingTotalAmount = request()->has("total_shipping_cost") ? (request()->total_shipping_cost ?? 0) : $cartService->calculateShippingCosts(true, $carts);
        $discountTotalAmount = 0;

        $orderProductQty = 0;

        //TODO::Will Refactor Later.
        $orderProducts = $this->processCartOrderProducts(
            $order,
            $cartInfo["cart_items"],
        );


        if($getReturnOrderProduct){
            return $orderProducts;
        }


        $payload = [
            "total_qty"             => getCartTotalQty($cartInfo),
            "total_shipping_cost"   => getCartShippingCost($cartInfo),
            "sub_total_amount"      => getCartSubTotal($cartInfo),
            "total_tax_amount"      => getCartTotalTax($cartInfo),
            "discount_total_amount" => $cartInfo["cart_total_discount"],
            "grand_total_amount"    => getCartGrandTotal($cartInfo),
        ];

        return $payload;
    }


    public function processCartOrderProducts(object $order,array $cartItems)
    {
        // Order Product Arr
        $orderProducts = [];

        foreach ($cartItems as $cart) {
            // Getting Product variation combinations data if exists for safety purpose.
            // Here safety purpose means, if the product edited by somebody and variation is not available in the database. then our combination data from json column will help us.

            $productJson           = $cart["product"];
            $productAttributeJson  = $cart["productVariation"];
            $productAddonJson      = $cart["product_addons"];

            $orderProductPayloads = [
                'order_id'             => $order->id,
                'product_owner_id'     => $productJson->vendor_id,
                'product_id'           => $cart["product_id"],
                "product_attribute_id" => $cart["product_attribute_id"],
                'qty'                  => $cart["qty"],
                'price'                => $cart["unit_price"],
                'addons_price'         => $cart["addons_price"],
                'total_tax'            => $cart["tax_amount"],
                'discount_type'        => $cart["discount_type"],
                'discount_value'       => $cart["discount_value"],
                'discount_amount'      => $cart["discount_sub_total"],
                'sub_total'            => $cart["sub_total"],
                'shipping_cost'        => 0,
                'total_price'          => $cart["grand_total"], // sub_total + total_tax
                "product_json"         => $productJson,
                "product_attribute_json" => $productAttributeJson,
                "product_addons"  => $productAddonJson
            ];

            // Order Product Save
            $orderProducts[] =$this->storeOrderProduct($orderProductPayloads);

            // Cart Delete
            $cart["cart"]->delete();
        }

        return $orderProducts;
    }

    public function storeOrderProduct(array $payloads)
    {
        if( array_key_exists("note", $payloads)){
            unset($payloads["note"]);
        }

        return OrderProduct::query()->create($payloads);
    }

    public function generateOrderProductTrackingNo($order_id): string
    {
        return $order_id.randomStringNumberGenerator(4);
    }


    public function saveOrderAddress(object $order, array $payloads)
    {
        $user = $order->customer; // Customer Load Here


        $userAddress = UserAddress::query()->findOrFail($payloads["user_address_id"]);

        $data = [
            'order_id'   => $order->id,
            'first_name' => $user->first_name,
            'last_name'  => $user->last_name,
            'email'      => $user->email,
            'mobile'     => $user->mobile_no,
        ];

        $shippingType =  $payloads["order_type"] ?? null;

        $data["country"] = $userAddress->country?->name ?? null;
        $data["state"]   = $userAddress->state?->name ?? null;
        $data["city"]    = $userAddress->city?->name ?? null;

        $data["country_id"] = $userAddress->country_id ?? null;
        $data["state_id"]   = $userAddress->state_id ?? null;
        $data["city_id"]    = $userAddress->city_id ?? null;
        $data["zone_id"]    = $userAddress->zone_id ?? null;
        $data["area_id"]    = $userAddress->area_id ?? null;

        $data["address"] = $userAddress->full_address;


        return OrderAddress::query()->create($data);
    }

    public function saveOrderPayments(object $order, array $payloads)
    {

        // Make a Success transaction when it's payment_method is card

        $paymentType = $payloads["payment_method"] ?? "cod";
        $transactionId = null;
        $transaction = null;
        $paymentStatus = constantFlags()::PAYMENT_PROCESSING;
        $isCardPay     = isCardPay($paymentType);

        if($isCardPay || $payloads["create_transaction"]){
            // Transaction
            $transaction = $this->saveOrderTransaction($order,$payloads);
            $transactionId = $transaction->id;
            $paymentStatus = constantFlags()::PAYMENT_PAID;
        }

        $dataArr = [
            "order_id"                   => $order->id,
            "transaction_id"             => $transactionId,
            "paid_amount"                => $order->payable_after_discount,
            "is_manual_payment"          => $isCardPay,
            "payment_status"             => $paymentStatus,
        ];

        return OrderPayment::query()->create($dataArr);
    }
    public function saveOrderSalesCount($orderProduct)
    {
        $product = $orderProduct->product;
        if($product){
            $product->increment("total_sales_count", $orderProduct->qty);
            $product->increment("total_sales_amount", $orderProduct->total_price);
            $product->save();

            $itemCategory = $product->itemCategory;
            if($itemCategory){
                $itemCategory->increment("total_sales_count", $orderProduct->qty);
                $itemCategory->increment("total_sales_amount", $orderProduct->total_price);
                $itemCategory->save();
            }
        }
    }

    public function saveOrderTransaction(object $order,array $payloads)
    {

        $transactionArr = [
            "order_id"       => $order->id,
            "user_id"        => $order->customer_id,
            "vendor_id"      => $order->vendor_id,
            "customer_id"    => $order->customer_id,
            "type"           => $payloads["payment_method"] == "card" ? 1 : 0,
            "status_id"      => appStatic()::STATUS_ID['COMPLETED'],
            "paid_amount"    => $payloads["paid_amount"] ?? $order->payable_after_discount,
            "payment_method" => $payloads["payment_method"] ?? 'cod',
        ];

        $transaction = Transaction::query()->create($transactionArr);

        return $transaction;
    }

    public function getFilteredPosOrdersByBranchId($branchId)
    {

        $request = request();

        $status_id = $request->status_id ?? null;
        $employeeId = $request->employee_id ?? null;

        $startDateTime = $endDateTime = null;

        if($request->has("date_range") && !empty($request->date_range)){
            $dateRange = $request->date_range;
            $explodeDateRange = explode(" to ", $dateRange);
            $startDateTime = carbonParse($explodeDateRange[0])->startOfDay();
            $endDateTime   = carbonParse($explodeDateRange[1])->endOfDay();
        }else{
            $startDateTime = now()->subDays(7)->startOfDay();
            $endDateTime   = now()->endOfDay();
        }

        $query = Order::query()->with([
                "branch:id,name","table:id,table_code","status:id,title","orderProducts"
            ])

            // Status ID
            ->when(!empty($status_id), function ($query) use ($status_id) {
                $query->statusId($status_id);
            })

            // Employee id
            ->when(!empty($employeeId), function ($query) use ($employeeId) {
                $query->employeeId($employeeId);
            })

            // date-range
            ->when(!empty($startDateTime && $endDateTime), function ($query) use ($startDateTime, $endDateTime) {
                $query->whereBetween("created_at", [$startDateTime, $endDateTime]);
            })

            // Branch id
            ->branchId($branchId)

            // Order By id desc
            ->latest();

        return $query->paginate(maxPaginateNo());
    }

     public function getFilteredPosKitchenOrdersByBranchId($branchId)
    {
        $request = request();

        $status_id = $request->status_id ?? null;

        $startDateTime = $endDateTime = null;

        if($request->has("date_range") && !empty($request->date_range)){
            $dateRange = $request->date_range;
            $explodeDateRange = explode(" to ", $dateRange);
            $startDateTime = carbonParse($explodeDateRange[0])->startOfDay();
            $endDateTime   = carbonParse($explodeDateRange[1])->endOfDay();
        }

        $query = Order::query()
            ->whereIn('status_id', [2,5,6,7])//pending, cooking pending,cooking on going,cooking completed
            ->with([
                "branch:id,name","table:id,name","status:id,title","orderProducts"
            ])

            // Status ID
            ->when(!empty($status_id), function ($query) use ($status_id) {
                $query->statusId($status_id);
            })

            // date-range
            ->when(!empty($startDateTime && $endDateTime), function ($query) use ($startDateTime, $endDateTime) {
                $query->whereBetween("created_at", [$startDateTime, $endDateTime]);
            })

            // Branch id
            ->branchId($branchId)

            // Order By id desc
            ->latest();

        return $query->paginate(maxPaginateNo());
    }


    public function updateOrderStatus(array $data)
    {
        if(empty($data["order_id"]) || empty($data["status_id"])){
            return false;
        }else{
            return Order::query()
                ->where("id", $data["order_id"])
                ->update([
                    "status_id" => $data["status_id"],
                ]);
        }   
    }


    public function updateOrderProductStatus(array $data)
    {
        if(empty($data["order_product_id"]) || empty($data["status_id"])){
            return false;
        }else{
            return OrderProduct::query()
                ->where("id", $data["order_product_id"])
                ->update([
                    "status_id" => $data["status_id"],
                ]);
        }   
    }   
    public function getOrderById($id)
    {
        return Order::query()->with(["orderProducts"])->findOrFail($id);
    }

    public function getOrderByCode($code)
    {
        return Order::where('invoice_no', $code)->first();
    }

    public function receiveBill()
    {
        $request = request();
        $order   = $this->getOrderByCode($request->order_code);
        
        if(is_null($order)){
            return null;
        }
        $order->update([
            'is_paid'     => appStatic()::PAYMENT_STATUS_PAID,
            'paid_amount' => $order->payable_after_discount,
        ]); 
        $this->saveOrderPayments($order, ['payment_method' =>$order->payment_method, 'paid_amount' => $request->amount, 'create_transaction' => true]);
        return $order;
    }

}
