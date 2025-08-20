<?php

namespace Modules\CartManager\Services\Business;

use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderCoupon;
use App\Models\OrderProduct;
use App\Models\UserAddress;
use App\Services\Models\MediaManager\MediaManagerService;
use App\Services\Models\Product\ProductService;
use App\Services\Models\User\UserService;
use App\Traits\Global\GlobalTrait;
use Modules\CartManager\Services\Action\CartActionService;
use Modules\CartManager\Services\Action\OrderPlaceActionService;

class OrderPlaceService
{

    use GlobalTrait;
    public function store(array $data)
    {
        $cartInfo = getCartInfo();
        $coupon   = getCookieCoupon();

        $couponType       = 0;
        $couponTypeAmount = 0;

        $couponDiscount = getCouponDiscount();

        if (!empty($coupon)) {
            $couponType       = $coupon->discount_type;
            $couponTypeAmount = $coupon->discount_value;
        }

        $payloadArr = [
            "delivery_status_id"    => constantFlags()::ORDER_PENDING,
            "payment_status"        => constantFlags()::PAYMENT_UNPAID,
            "total_qty"             => getCartTotalQty($cartInfo),
            "total_shipping_cost"   => getCartShippingCost($cartInfo),
            "sub_total_amount"      => getCartSubTotal($cartInfo),
            "total_tax_amount"      => getCartTotalTax($cartInfo),
            "discount_total_amount" => $cartInfo["cart_total_discount"],
            "grand_total_amount"    => getCartGrandTotal($cartInfo) - $couponDiscount,
            "order_type"            => isCOD($data["payment_method"]) ? 0 : 1, // 0=>cod, 1=>online
            "customer_id"           => getUserParentId(),
            "applied_coupon_code"   => getCoupon(),
            "coupon_discount_amount" => getCouponDiscount(),
            "coupon_type"            => $couponType,
            "coupon_type_amount"     => $couponTypeAmount
        ];

        $orderPayload = $data + $payloadArr;

        commonLog("Before Order Place Payloads", ["orderPayloads" => $orderPayload], logService()::LOG_ORDER);

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

        $carts = $cartService->getCartsByUserId(getUserParentId());

        $cartInfo = getCartInfo();

        // Throw exceptions if the carts count is 0
        if (empty($cartInfo["cart_items"])) {
            throw new \Exception(localize("Sorry You don't have any items in your cart."));
        }

        //TODO::Will Refactor Later.
        $orderProducts = $this->processCartOrderProducts(
            $order,
            $cartInfo["cart_items"],
        );

        if ($getReturnOrderProduct) {
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

    public function processCartOrderProducts(object $order, array $cartItems)
    {
        // Init Product Service
        $productService = new ProductService();

        // Order Product Arr
        $orderProducts = [];
        $totalProductTax = 0;

        $mediaManagerService = new MediaManagerService();
        $orderPlaceActionService = new OrderPlaceActionService();

        foreach ($cartItems as $cart) {


            // Getting Product variation combinations data if exists for safety purpose.
            // Here safety purpose means, if the product edited by somebody and variation is not available in the database. then our combination data from json column will help us.
            $variationValuesArray = $cart["productVariation"]?->combinations->count() > 0 ? $this->generateVariationFromCombinations($cart["productVariation"]?->combinations) : [];

            // Product Information json
            $product = $cart["product"];

            // Product Attribute
            $productAttribute = $cart["productVariation"];

            // Product Attribute Campaign product
            $campaignProduct = $productAttribute->campaignProduct;

            // Campaign
            $campaign = $campaignProduct?->campaign;

            // Product Thumbnail base64
            $productThumbnailBase64Image = $product->productThumbnail ? $mediaManagerService->getMediaFileAsBase64($product->productThumbnail) : null;

            // Product Gallery Base64
            $productPicturesBase64Arr = $mediaManagerService->getProductGalleryBase64($product->images);

            // Product Owner Object
            $productOwner     = $cart["product"]->productOwner;


            //calculate total product tax
            if (!empty($cart["item_tax_summary"])) {
                foreach ($cart["item_tax_summary"] as $taxSummary) {
                    $totalProductTax += $taxSummary["tax_amount"];
                }
            }


            // Shop Object
            $productOwnerShop = $productOwner->shop;

            $orderProductPayloads = [
                'order_id'                   => $order->id,
                'product_owner_id'           => $productOwner->id,
                'shop_id'                    => $productOwnerShop?->id ?? null,
                'product_id'                 => $cart["product_id"],
                "product_attribute_id"       => $cart["product_attribute_id"],
                'qty'                        => $cart["qty"],
                'unit_price'                 => $cart["unit_price"],
                'total_tax'                  => $cart["tax_amount"],
                'discount_type'              => $cart["discount_type"] ?? constantFlags()::NO_DISCOUNT_IS_APPLIED,
                'discount_value'             => $cart["discount_value"],
                'discount_amount'            => $cart["discount_sub_total"],
                'sub_total'                  => $cart["sub_total"],
                'shipping_cost'              => 0,
                'total_price'                => $cart["grand_total"], // sub_total + total_tax
                'is_refund'                  => constantFlags()::ORDER_IS_NOT_REFUND,
                "attribute_combination_json" => json_encode($variationValuesArray),
                "product_json"               => json_encode($product),
                "product_thumbnail"          => $productThumbnailBase64Image,
                "product_pictures_json"      => json_encode($productPicturesBase64Arr),
                "campaign_json"              => json_encode($campaign),
                "campaign_product_json"      => json_encode($campaignProduct),
                "tax_calculation_details"    => json_encode($cart["item_tax_summary"]),
                "is_campaign_product"        => $campaignProduct ? 1 : 0,
            ];


            // Order Product Save
            $savedOrderProduct = $this->storeOrderProduct($orderProductPayloads);
            $orderProducts[] = $savedOrderProduct;

            // Campaign Product ordered_qty update
            if ($campaignProduct) {
                $updatedCampaignProduct = $this->updateCampaignProductOrderedAndAvailableStockQty($campaignProduct, $cart["qty"]);
            }


            // Update Product Owner total_sold column
            if (isSuccessDelivery($order->delivery_status_id)) {
                // Update Product All Time Sold
                $productSold =  $productService->updateProductSoldAmount($cart["product"], $cart["qty"]);

                // Update Product Owner Total Sold
                $productOwnerTotalSold = $productService->updateProductOwnerTotalSold($productOwner, $cart["qty"]);

                // Update Product Attribute Variation Stock 
                $orderPlaceActionService->updateOrderProductVariationStockByOrderProduct($savedOrderProduct);
            }

            // Cart Delete
            $cart["cart"]->delete();
        }

        return $orderProducts;
    }

    public function updateCampaignProductOrderedAndAvailableStockQty($campaignProduct, $cartQty)
    {
        // Update Campaign Product ordered_qty
        $campaignProduct->update([
            "ordered_qty"         => $campaignProduct->ordered_qty + $cartQty,
            "available_stock_qty" => $campaignProduct->available_stock_qty - $cartQty
        ]);

        return $campaignProduct;
    }
    

    public function storeOrderProduct(array $payloads)
    {
        if (array_key_exists("note", $payloads)) {
            unset($payloads["note"]);
        }

        return OrderProduct::query()->create($payloads);
    }

    public function generateOrderProductTrackingNo($order_id): string
    {
        return $order_id . randomStringNumberGenerator(4);
    }


    public function saveOrderAddress(object $order, array $payloads)
    {
        $user = $order->customer; // Customer Load Here

        if (!empty($payloads["user_address_id"])) {
            $userAddress = UserAddress::query()->findOrFail($payloads["user_address_id"]);
        } else {
            $userAddress = (new UserService())->storeUserAddressByUserId($user->id);
        }

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


    public function saveOrderCouponTrack($order)
    {
        $cookieCoupon = getCookieCoupon();

        // Get the coupon 
        $coupon = Coupon::query()->findOrFail($cookieCoupon->id);

        // Update 
        $coupon->update([
            "total_usage_count" => $coupon->total_usage_count + 1
        ]);

        // Order Coupon 
        $orderCoupon = OrderCoupon::query()->create([
            "order_id"         => $order->id,
            "coupon_id"        => $coupon->id,
            "discount_type"    => $cookieCoupon->discount_type,
            "coupon_code"      => $cookieCoupon->code,
            "discount_value"   => $cookieCoupon->discount_value,

            "coupon_total"     => $order->coupon_discount_amount,
            "user_group_id"    => $cookieCoupon->user_id,
            "coupon_json_data" => json_encode($cookieCoupon),
            "is_active"        => 1,
            "user_id"          => $order->customer_id
        ]);

        return $coupon;
    }
}
