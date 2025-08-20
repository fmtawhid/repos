<?php

namespace Modules\CartManager\Services\Business;

use App\Models\Product;
use App\Models\ProductAttribute;
use Modules\CartManager\App\Models\Cart;

class CartService
{

    /*
     * Get the POS Carts Item
     * */
    public function getPosCartsByUserId($userId){

        return Cart::query()->with(["product","productVariation"])->where('user_id',$userId)->latest()->get();
    }


    /*
     * Get the eCommerce Cart By User id
     * */
    public function getEcommerceCartsByUserId($userId){

    }


    public function storeCartByUserId($userId, array $cartData)
    {
        // Code Here
        $productId          = $cartData['product_id'];
        $productAttributeId = $cartData['product_attribute_id'];

        // Product
        $product = $this->getProductById($productId);

        // Qty Change
        $qtyChange = $cartData['qty_change'] ?? 0;


        // Is product_id and product_attribute_id already exists for the user_id ?
        $cart = $this->getCartByUserIdAndProductAttributeId($userId, $productAttributeId);

        // user_id, qty, product_attribute_id
        $cartData["user_id"]              = $userId;
        $cartData["qty"]                  = max(1, $qtyChange);
        $cartData["product_attribute_id"] = $productAttributeId;


        // Product Addon Ids
        $productAddonArr            = $this->prepareProductAddons();
        $cartData["product_addons"] = $productAddonArr;

        // Store newly
        if(empty($cart)){
            return $this->saveCart($cartData);
        }

        // Update CartAddons
        if(!empty($productAddonArr)){
            $cart->update([
                "product_addons" => $productAddonArr
            ]);
        }

        /**
         * Existing Cart Found - Update the Cart
         * */

        return $this->updateCartQuantity($cart, $qtyChange);
    }

    public function prepareProductAddons()
    {
        $request         = request();
        $productAddonArr = [];

        if($request->has("selected_addons")){
            foreach ($request->selected_addons as $key => $addonId) {
                $titleKey = "addon_title_".$addonId;
                $priceKey = "addon_price_".$addonId;

                $productAddonArr[] = [
                    "title" => $request->$titleKey,
                    "price" => $request->$priceKey,
                ];
            }
        }

        return $productAddonArr;
    }

    public function updateCartQuantity(object $cart, $qty): ?object
    {
        $newQuantity = max(0, $cart->qty + $qty);

        $cart->update([
            'qty' => $newQuantity,
        ]);

        // If quantity is 0 or negative, delete cart item
        if ($newQuantity <= 0) {
            $cart->delete();

            return null;
        }

        return $cart;
    }

    public function updateCartByUserId($userId, $cartData)
    {
        // Cart
        $cart      = $this->getCartById($cartData["cart_id"]);

        // Qty Change
        $qtyChange = $cartData["qty_change"] ?? 0;

        return $this->updateCartQuantity($cart, $qtyChange);
    }

    public function getCartById($cartId)
    {
        return Cart::query()->findOrFail($cartId);
    }

    public function saveCart(array $payloads)
    {

        return Cart::query()->create($payloads);
    }



    public function getProductById($id)
    {
        return Product::query()
            ->with('attributes')
            ->where("is_active", "=", appStatic()::ACTIVE)
            ->whereNull("deleted_at")
            ->findOrFail($id);
    }

    public function getProductAttributeByAttributeValueId($attributeValueId)
    {
        $productCombination = ProductAttributeCombination::query()
            ->with('productAttribute')
            ->where('attribute_value_id',$attributeValueId)
            ->firstOrFail();

        return $productCombination->productAttribute;
    }


    public function getCartByUserIdAndProductAttributeId($userId, $productAttributeId)
    {

        return Cart::query()
            ->userId($userId)
            ->productAttributeId($productAttributeId)
            ->first();
    }


    public function deleteCartByCardId($cartId)
    {
        $cart = $this->getCartById($cartId);

        return $cart->delete();
    }

    public function deleteCartsByUserId($userId)
    {
        return Cart::query()->userId($userId)->latest()->delete();
    }
}
