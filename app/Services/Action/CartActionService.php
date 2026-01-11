<?php

namespace App\Services\Action;

use App\Services\Models\Cart\CartService;
use App\Services\Models\Product\ProductService;

class CartActionService
{
    protected $cartService;
    protected $productService;

    public function __construct(CartService $cartService, ProductService $productService)
    {
        $this->cartService = $cartService;
        $this->productService = $productService;
    }

    /**
     * Load Cart Items & calculate totals
     */
public function init($discount_value = 0, $discount_type = 'fixed', $shipping_cost = 0)
{
    $cartItems = CartService::getCartItems(); // your existing method
    $subTotal   = CartService::getSubTotal();
    $tax        = CartService::getTax();

    // Calculate discount
    if ($discount_type == 'percent') {
        $discountAmount = ($discount_value / 100) * $subTotal;
    } else {
        $discountAmount = $discount_value;
    }

    $grandTotal = $subTotal + $tax + $shipping_cost - $discountAmount;

    return [
        'cart_items' => view('posmanager::render.render-cart-items', compact('cartItems'))->render(),
        'sub_total' => formatPrice($subTotal),
        'tax' => formatPrice($tax),
        'grand_total' => formatPrice($grandTotal),
        'cart_total_qty' => CartService::getTotalQty(),
        'cart_coupon_total' => $discountAmount,
    ];
}

}
