<?php

namespace Modules\CartManager\Services\Action;

use Modules\CartManager\App\Models\Cart;
use App\Services\Action\PricingService;
use App\Support\Facade\ShippingCharge\ShippingChargeFacade;
use Modules\CartManager\Services\Business\CartService;

class CartActionService
{
    private $cartService;

    public function __construct()
    {
        $this->cartService = new CartService();
    }

    public function getCartsByUserId($userId)
    {
        return $this->cartService->getPosCartsByUserId($userId);
    }

    public function deleteCartsByUserId($userId)
    {
        return $this->cartService->deleteCartsByUserId($userId);
    }

    public function getCartById($id)
    {
        return $this->cartService->getCartById($id);
    }


    public function storeCartByUserId($userId, array $cartData)
    {
        return $this->cartService->storeCartByUserId($userId, $cartData);
    }


    public function updateCartByUserId($userId, array $cartData)
    {
        return $this->cartService->updateCartByUserId($userId, $cartData);
    }

    public function validateCartPermission()
    {
        $request = request();

        // When logged in user is not customer & trying to add cart from website item.
        if ($request->has("is_pos_route") && $request->is_pos_route == 1) {
            if (isCustomer()) {
                throw new \Exception(localize("Sorry, You are not authorize to add/update/delete cart in POS route"), requestResponse()::BAD_CART_PERMISSION);
            }

            return true;
        } else {
            // When logged in user is not customer & trying to add cart from website item.
            if (!isCustomer()) {
                throw new \Exception(localize("Sorry, Only customer can order from website item."), requestResponse()::BAD_CART_PERMISSION);
            }
        }
    }


    public function init()
    {
        // Helper function coming from app/Helpers/Helpers.php
        $cartInfo = getCartInfo();


        // Cart Item rendering from CartManager module
        if (request()->has("is_pos_route") && isPOSRoute(request()->is_pos_route)) {

            $cartItems = view("cartmanager::render.pos.render-cart-item")->render();
        }
        else {
            $cartItems = view("cartmanager::render.website.render-cart-item")->render();
        }


        // Customer Checkout Cart Items Blade
        $customerCheckoutCartItems = null;
        if (request()->has("isCustomerWebsite") && request()->isCustomerWebsite == 1) {
            $customerCheckoutCartItems = view("cartmanager::render.website.render-checkout-cart-item")->render();
        }

        $subTotal   = getCartSubTotal($cartInfo);
        $tax        = getCartTotalTax($cartInfo);
        $grandTotal = getCartGrandTotal($cartInfo);
        $cartCouponTotal = $this->getCouponTotal();
        //    dd( $tax);


        return [
            "cart_total_qty" => getCartTotalQty($cartInfo), // Blade Render
            "cart_items"  => $cartItems, // Blade Render
            "sub_total"   => formatPrice($subTotal ?? 0),
            "tax"         => formatPrice($tax ?? 0),
            "grand_total" => formatPrice($grandTotal ?? 0),
            "customer_checkout_cart_items" => $customerCheckoutCartItems ?? [],
            "cart_coupon_total" => $cartCouponTotal
        ];
    }


    public function carts($userId = null)
    {

        $userId = empty($userId) ? request()->user()->id : $userId;

        return Cart::query()->where("user_id", $userId)->latest()->get();
    }

    public function getCartInfo(): array
    {
        try {
            $cartBody = $this->cartBody();

            return [
                "cart_sub_total"      => !isLoggedIn() ? 0 :  $cartBody["cart_sub_total"],
                "cart_total_qty"      => !isLoggedIn() ? 0 :  $cartBody["cart_total_qty"],
                "cart_total_discount" => !isLoggedIn() ? 0 :  $cartBody["cart_total_discount"],
                "cart_total_tax"      => !isLoggedIn() ? 0 :  $cartBody["cart_total_tax"],
                "cart_grand_total"    => !isLoggedIn() ? 0 :  $cartBody["cart_grand_total"],
                "cart_items"          => !isLoggedIn() ? [] : $cartBody["cart_items"],
                "cart_shipping_cost"  => !isLoggedIn() ? 0 :  $cartBody["cart_shipping_cost"],
                "cart_coupon_total"   => !isLoggedIn() ? 0 :  $cartBody["cart_coupon_total"] ?? 0,
            ];
        } catch (\Throwable $e) {

            throw new \Exception("Failed to init cart - " . $e->getMessage());
        }
    }


    public function cartBody(): array
    {
        // Value initialize
        $cartSubTotal = $totalQty = $totalDiscount = $totalTax = $grandTotal = 0;

        // Carts & Service Initialize
        $carts          = myCarts();
        $pricingService = new PricingService();
        $cartItems      = [];

        $loopNo = 1;
        foreach ($carts ?? [] as $cart) {
            $product = $cart->product;

            $unitPrice = $productDiscount = $priceAfterDiscount = $discountType = $discountValue = 0;

            $isValidCampaignStock  = false;

            // Product Variation Price Calculation start here
            $productAttribute      = $cart->productAttribute;

            // Product Price information
            $discountType          = $productAttribute->discount_type ?? 0;
            $discountValue         = $productAttribute->discount_value ?? 0;
            $unitPrice             = getProductPriceByProductAttribute($productAttribute);
            $priceAfterDiscount    = getProductDiscountByProductAttribute($productAttribute);

            // addons price calculate
            $addonsPrice = 0;
            if (!empty($cart->product_addons)) {
                $addonsPrice = collect($cart->product_addons)->sum('price');
            }

            // Discount Total
            $productDiscount       = $unitPrice - $priceAfterDiscount;

            // Product Sub total calculate Ex. PriceAfterDiscount * Qty (100*1)
            // $subTotal = $priceAfterDiscount * $cart->qty;
            $subTotal = $priceAfterDiscount * $cart->qty;

            // Cart Sub-total (Price After Discount * Qty) addition with previous sub-total
            $cartSubTotal += $subTotal;

            // Cart Sub-total + product addons price
            $cartSubTotal += $addonsPrice;

            // Discount Sub Total Calculate
            $discountSubTotal = $productDiscount * $cart->qty;

            // Total Discount Calculate
            $totalDiscount += $discountSubTotal;

            // Cart Qty Calculate
            $totalQty += $cart->qty;

            // Tax Calculate
            $taxInfo    = [
                "taxAmount" => 0,
                "appliedProductTaxes" => null
            ];

            if ($product->id == 539) {
                // dd($taxInfo);
            }

            $totalTax += $taxInfo["taxAmount"];

            $productGrandTotal = ($subTotal + $addonsPrice + $totalTax);

            // Grand Total Calculate (Sub Total + addons price + Tax)+ Grand Total
            $grandTotal += $productGrandTotal;

            // Show Out of stock
            $cartItems[] = [
                "cart_id"                 => $cart->id,
                "product_id"              => $cart->product_id,
                "product_attribute_id"    => $cart->product_attribute_id,
                "product"                 => $product,
                "product_addons"          => $cart->product_addons,
                "product_owner_id"        => $product->product_owner_id,
                "unit_weight"             => $productAttribute?->weight ?? 0,
                "productVariation"        => $productAttribute,
                "product_discount"        => $productDiscount,
                "discount_sub_total"      => $discountSubTotal,
                "unit_price"              => $unitPrice,
                "price_after_discount"    => $priceAfterDiscount,
                "addons_price"            => $addonsPrice,
                "discount_type"           => $discountType,
                "discount_value"          => $discountValue,
                "is_campaign_variation"   => $isValidCampaignStock,
                "available_stock"         => true,
                "is_show_out_of_stock"    => false,
                "out_of_stock_text"       => null,
                "sub_total"               => $subTotal,
                "qty"                     => $cart->qty,
                "grand_total"             => $productGrandTotal,
                "cart"                    => $cart,
                "tax_amount"              => $taxInfo["taxAmount"],
                "item_tax_summary"        => $taxInfo['appliedProductTaxes'] ?? null,
                "stock"                   =>  $productAttribute?->productVariationStock
            ];
        }

        // Max Unit Weight of the product shipping cost
        // Allow overriding shipping cost via request (from POS inputs)
        $shippingCost = request()->has('total_shipping_cost') ? (float) request()->total_shipping_cost : (empty($cartItems) ? 0 : $this->calculateShippingCost($cartItems));

        // Order level discount (flat or percentage) from POS inputs
        $orderDiscountTotal = 0;
        if (request()->has('discount_type')) {
            $orderDiscountTotal = (double) discountCalculations($cartSubTotal, (float) (request()->discount_value ?? 0), request()->discount_type);
        }

        return [
            "cart_sub_total"      => $cartSubTotal,
            "cart_total_qty"      => $totalQty,
            "cart_total_discount" => $totalDiscount + $orderDiscountTotal,
            "cart_total_tax"      => $totalTax,
            "cart_grand_total"    => ($grandTotal + $shippingCost) - $orderDiscountTotal, // Shipping cost added and order discount subtracted
            "cart_items"          => $cartItems,
            "cart_shipping_cost"  => $shippingCost,
        ];
    }

    public function calculateShippingCost($cartItems)
    {
        $maxUnitWeight = 0;

        if (empty($cartItems)) {
            return 0;
        }

        foreach ($cartItems as $item) {
            $unitWeight = 0;

            // array of prepared cart items
            if (is_array($item)) {
                $unitWeight = $item['unit_weight'] ?? 0;
            } elseif (is_object($item)) {
                // Eloquent Cart model with relation productAttribute
                if (isset($item->productAttribute) && isset($item->productAttribute->weight)) {
                    $unitWeight = $item->productAttribute->weight ?? 0;
                } elseif (isset($item->product) && isset($item->product->variations) && $item->product->variations->count()) {
                    $var = $item->product->variations->first();
                    $unitWeight = $var->weight ?? 0;
                } elseif (isset($item->productVariation) && is_array($item->productVariation)) {
                    $unitWeight = $item->productVariation['weight'] ?? 0;
                }
            }

            $maxUnitWeight = max($maxUnitWeight, (float) $unitWeight);
        }

        $shippingCost = 0; // ShippingChargeFacade::calculateShippingCost($maxUnitWeight);

        return $shippingCost;
    }

    public function deleteCartByCardId($cardId)
    {

        return $this->cartService->deleteCartByCardId($cardId);
    }


    public function getCouponTotal()
    {

        $couponTotal = 0;
        $cartItems   = getCartItems();

        if (empty($cartItems)) {
            return $couponTotal;
        }


        $cookieCoupon = $_COOKIE["coupon"] ?? null;

        if (empty($cookieCoupon)) {
            return $couponTotal;
        }

        $cookieCoupon = json_decode($cookieCoupon);

        $items = array_filter($cartItems, function ($item) use ($cookieCoupon) {
            return $item["product_owner_id"] == $cookieCoupon->user_id;
        });

        if (empty($items)) {
            return $couponTotal;
        }

        $totalSum = array_sum(array_column($items, 'grand_total'));

        // When coupon is percentage
        if (isPercentage($cookieCoupon->discount_type)) {
            $percentageAmount = percentageCalculations($totalSum, $cookieCoupon->discount_value);

            if ($percentageAmount >= $cookieCoupon->max_discount_amount) {
                return $cookieCoupon->max_discount_amount;
            }

            return $percentageAmount;
        }

        if ($totalSum >= $cookieCoupon->max_discount_amount) {
            return $cookieCoupon->max_discount_amount;
        }

        return $totalSum;
    }
}
