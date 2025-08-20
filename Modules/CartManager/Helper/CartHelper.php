<?php

use \Modules\CartManager\Services\Action\CartActionService;

# Carts
if (!function_exists('carts')) {
    function carts()
    {
        return (new CartActionService())->carts();
    }
}


# My Carts
if (!function_exists('myCarts')) {
    function myCarts()
    {
        return user()->myCarts ?? [];
    }
}


if (!function_exists('getSubTotal')) {
    // return subtotal price
    function getSubTotal($carts, $couponDiscount = true, $couponCode = '', $addTax = true, $formatted = true)
    {
        $subTotal = $totalSubtotal = $totalDiscount = 0;
        if (count($carts) > 0) {
            foreach ($carts as $cart) {

                $unitQty              = $cart->qty;
                $productInfo          = getProductPriceAndDiscountWithCampaignValidStockFlag($cart->product, $cart->productVariation);
                $unitPrice            = $productInfo["unit_price"];
                $priceAfterDiscount   = $productInfo["price_after_discount"];
                $isValidCampaignStock = $productInfo["is_valid_campaign_stock"];
                $campaignProduct      = $productInfo["campaign_product"];
                $totalUnitPrice       = $priceAfterDiscount * $unitQty;
                $subTotal += $totalUnitPrice;
            }
        }

        return $formatted ? formatPrice($subTotal) : $subTotal;
    }
}


/**
 * Get Product Price
 *
 * 1. Check is campaign product?
 * 2. check the campaign record getting or not
 * 3. If the campaign record found check the available stock
 * 4.
 * */
if (!function_exists("getProductPriceAndDiscountWithCampaignValidStockFlag")) {
    function getProductPriceAndDiscountWithCampaignValidStockFlag($product, $cartProductVariation = null)
    {
        $productVariation = !empty($cartProductVariation) ? $cartProductVariation : $product->variations?->first();

        if (empty($productVariation)) {
            return [
                "unit_price"                     => 0,
                "price_after_discount"           => 0,
                "is_valid_campaign_stock"        => false,
                "is_campaign_variation"          => false,
                "campaign_product"               => [],
                "product_variation"              => [],
                "discount"                       => 0,
                "discount_type"                  => 0,
                "discount_value"                 => 0,
                "available_stock_qty"            => 0,
                "is_valid_stock"                 => false,
                "total_product_variations_count" => 0,
            ];
        }

        // Check is Campaign product Or not
        $unitPrice       = $productVariation->price;
        $discountType    = $product->discount_type;
        $discountValue   = $product->discount_value;
        $productDiscount = discountCalculations(
            $unitPrice,
            $discountValue,
            $discountType
        );

        $availableStock       = $productVariation->productVariationStock?->stock_qty ?? 0;
        $priceAfterDiscount   = $unitPrice - $productDiscount;
        $isValidCampaignStock = false;
        $campaignProduct      = null;

        $productCollection = getCampaignProductPriceAndDiscountedPrice($product->id, $productVariation->id);

        if ($productCollection["is_campaign_product_variation"]) {
            $campaignProductVariation = $productCollection["campaignProductVariation"];

            if (!empty($campaignProductVariation) && $campaignProductVariation->available_stock_qty > 0) {
                $campaignProduct      = $campaignProductVariation;
                $unitPrice            = $campaignProduct->product_price ?? 0;
                $productDiscount      = $campaignProduct->product_price - $campaignProduct->price_after_discount;
                $priceAfterDiscount   = $campaignProduct->price_after_discount ?? 0;
                $isValidCampaignStock = true;
                $discountType         = $campaignProduct->discount_type;
                $discountValue        = $campaignProduct->discount_value;
                $productVariation     = $campaignProduct;
                $availableStock       = $campaignProduct->available_stock_qty;
            }
        }

        $isValidStock = true;

        $productVariationCount = 1;

        if (empty($campaignProduct)) {
            $productVariationCount = $product->variations->count();
            if ($productVariationCount <= 1) {
                $isValidStock = $availableStock > 0;
            }
        } else {
            $isValidStock = $availableStock > 0;
        }

        return [
            "unit_price"                     => $unitPrice,
            "price_after_discount"           => $priceAfterDiscount,
            "is_valid_campaign_stock"        => $isValidCampaignStock,
            "is_campaign_variation"          => $productCollection["is_campaign_product_variation"],
            "campaign_product"               => $campaignProduct,
            "product_variation"              => $productVariation,
            "discount"                       => $productDiscount,
            "discount_type"                  => $discountType,
            "discount_value"                 => $discountValue,
            "available_stock_qty"            => $availableStock,
            "is_valid_stock"                 => $isValidStock,
            "total_product_variations_count" => $productVariationCount,
        ];
    }
}


if (!function_exists("getCartInfo")) {
    function getCartInfo()
    {
        return (new CartActionService())->getCartInfo();
    }
}


if (!function_exists("getCartItems")) {
    function getCartItems($globalCartData = null)
    {
        if (!empty($globalCartData)) {
            return $globalCartData["cart_items"] ?? [];
        }

        return getCartInfo()["cart_items"] ?? [];
    }
}

if (!function_exists("getCartSubTotal")) {
    function getCartSubTotal($cartInfo, $formatted = false)
    {
        $cartSubTotal = $cartInfo["cart_sub_total"] ?? 0;

        return $formatted ? formatPrice($cartSubTotal, true) : $cartSubTotal;
    }
}


if (!function_exists("getCartItemSubTotal")) {
    function getCartItemSubTotal($cart)
    {
        return $cart["sub_total"] ?? 0;
    }
}



if (!function_exists("getCartItemPrice")) {
    function getCartItemPrice($cartItem)
    {
        return $cartItem["unit_price"] ?? 0;
    }
}

if (!function_exists("getCartItemPriceAfterDiscount")) {
    function getCartItemPriceAfterDiscount($cartItem)
    {
        return $cartItem["price_after_discount"] ?? 0;
    }
}



if (!function_exists("getCartTotalDiscount")) {
    function getCartTotalDiscount($cartInfo, $formatted = false)
    {
        $cartSubTotal = $cartInfo["cart_total_discount"] ?? 0;

        return $formatted ? formatPrice($cartSubTotal, true) : $cartSubTotal;
    }
}

if (!function_exists("getCartTotalTax")) {
    function getCartTotalTax($cartInfo, $formatted = false)
    {
        $cartTotalTax = $cartInfo["cart_total_tax"] ?? 0;

        return $formatted ? formatPrice($cartTotalTax, true) : $cartTotalTax;
    }
}

if (!function_exists("getCartDiscountTotal")) {
    function getCartDiscountTotal($cartInfo, $formatted = false)
    {
        $cartTotalTax = $cartInfo["cart_total_discount"] ?? 0;

        return $formatted ? formatPrice($cartTotalTax, true) : $cartTotalTax;
    }
}

if (!function_exists("getCartTotalQty")) {
    function getCartTotalQty($cartInfo = null, $formatted = false)
    {
        if (!empty($cartInfo)) {
            return $cartInfo["cart_total_qty"] ?? 0;
        }

        return getCartInfo()["cart_total_qty"] ?? 0;
    }
}

if (!function_exists("getCartShippingCost")) {
    function getCartShippingCost($cartInfo, $formatted = false)
    {
        $cartShippingCost = $cartInfo["cart_shipping_cost"] ?? 0;

        return $formatted ? formatPrice($cartShippingCost, true) : $cartShippingCost;
    }
}

if (!function_exists("getCartGrandTotal")) {
    function getCartGrandTotal($cartInfo, $formatted = false)
    {
        $cartGrandTotal = $cartInfo["cart_grand_total"] ?? 0;

        return $formatted ? formatPrice($cartGrandTotal, true) : $cartGrandTotal;
    }
}


if (!function_exists("getCartCouponTotal")) {
    function getCartCouponTotal($cartInfo, $formatted = false)
    {
        $cartCouponTotal = $cartInfo["cart_coupon_total"] ?? 0;

        return $formatted ? formatPrice($cartCouponTotal, true) : $cartCouponTotal;
    }
}



if (!function_exists("cartItemQty")) {
    function cartItemQty(array $cartItem)
    {

        return $cartItem["qty"] ?? 0;
    }
}

if (!function_exists("cartItemSubTotal")) {
    function cartItemSubTotal(array $cartItem)
    {

        return $cartItem["sub_total"] ?? 0;
    }
}

if (!function_exists("cartItemAvailableStockQty")) {
    function cartItemAvailableStockQty(array $cartItem)
    {

        return $cartItem["available_stock"] ?? 0;
    }
}

if (!function_exists("cartItemPriceAfterDiscount")) {
    function cartItemPriceAfterDiscount(array $cartItem, $formatted = false)
    {
        $priceAfterDiscount = $cartItem["price_after_discount"] ?? 0;

        return $formatted ? formatPrice($priceAfterDiscount, true) : $priceAfterDiscount;
    }
}

if (!function_exists("cartProduct")) {
    function cartProduct(array $cartItem)
    {

        return $cartItem["product"];
    }
}

if (!function_exists("cartProductVariation")) {
    function cartProductVariation(array $cartItem)
    {

        return $cartItem["productVariation"];
    }
}


if (!function_exists("cartStock")) {
    function cartStock(array $cartItem)
    {

        return $cartItem["stock"];
    }
}



if (!function_exists("cartItemTitle")) {
    function cartItemTitle(array $cartItem)
    {

        return $cartItem["product"]?->title ?? "";
    }
}


if (!function_exists("cartItemSlug")) {
    function cartItemSlug(array $cartItem)
    {

        return $cartItem["product"]?->slug ?? "";
    }
}

if (!function_exists("cartItemThumbnail")) {
    function cartItemThumbnail(array $cartItem)
    {

        return urlVersion($cartItem["product"]?->productThumbnail?->media_file ?? null);
    }
}



if (!function_exists("getCartId")) {
    function getCartId(array $cartItem): int
    {

        return $cartItem["cart_id"];
    }
}
