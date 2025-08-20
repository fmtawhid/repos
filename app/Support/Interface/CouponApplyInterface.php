<?php

namespace App\Support\Interface;

interface CouponApplyInterface
{
    /**
     * ----------------------------------------------------------
     * | Get product best discount by product and variation.
     * |
     * |----------------------------------------------------------
     * |Step1. Get product and variation
     * |Step 2: Get the product price from productVariation
     * |Step 3: Find the merchant/supplier
     * |Step 4: Get the coupons from coupons where coupon_manner_type == 1(quantity based coupon. Ex. Buy 3 and get $5 or 5% off) user_id is the users table id which is equal to the coupons table user_id
     * |Step 5: Get all the collected coupons from user_coupon_collections table where coupon_id is belongs to products table user_id and user_coupon_collections.user_id == my user id (Here, logged in user id is  my user id)
     * |Step 6: Apply collected coupons coupon discount logically based on discount_type for the product price and store into applied_coupon_array
     * |Step 7: Apply step 4 collected coupons coupon discount logically based on discount_type for the product price and store into applied_coupon_array
     * |Step 8: Now get the largest discount_amount from applied_coupon_array . Ex (Array should be like ["discount_amount" => 5, coupon_id = 1] like this
     * |
     * ----------------------------------------------------------
     * */
    public function applyCouponsForCartItemsAndGetTotalDiscount(object $user, object $carts, $getOnlyDiscountAmount=false);


    /**
     * ------------------------------------------------------------------------------------------------------------------------------
     *  Create product/item owner wise cart group. (Here owner means products.user_id column is a merchant/supplier of the product)
     * ------------------------------------------------------------------------------------------------------------------------------
     * ## Required params: carts object of the cart.
     *
     * 1. Run the carts object loop
     * 2. serialize the user_id, price, qty
     * 3. check the user_id wise userGroupCart exists or not.
     *      If not exists create an array with ["total_qty" => 0, "total_amount" => 0, "cart_items"=>[]]
     * 4. Now set the actual qty and subtotal into total_amount and cart_items
     * 5. Continue the loop
     * 6. return the final userGroupCart array
     * ------------------------------------------------------------------------------------------------------------------------------
     * */
    public function makeUserIdWiseCartGroup(object | array $carts);


    /**
     * ------------------------------------------------------------------------------------------------------------------------------
     *  Get the User Group Wise Best coupon for the customer
     * ------------------------------------------------------------------------------------------------------------------------------
     * ## Required params: $userGroupCarts, object $customer
     *
     * 1. Initial the CouponService, UserService as Singleton service and $userGroupBestCoupon array
     * 2. Run the $userGroupCarts object|array loop
     * 3. Declare $userGroupTotalQty, $userGroupTotalAmount, $merchantOrSupplier inside the loop.
     * 4. Initial the merchant/supplier object into $merchantOrSupplier Params
     * 5. Get all the collected coupons by CouponService getCollectedCouponsByUserId($user->id, false, $merchantOrSupplier->id) method
     * 6. Now Get the appropriate coupon from CouponService getBestCollectedCoupon($collectedCoupons, $userGroupTotalAmount) method
     * 7. Now apply the coupon and get the coupon info with CouponService applyCouponBasedOnUserWise($bestCollectedCoupon, $userGroupTotalAmount, $merchantOrSupplier) method
     *        Ex: [
     *              "coupon_id"           => $coupon->id,
     *              "coupon_total"        => $getCouponDiscount,
     *              "is_collected_coupon" => $isCollectedCoupon,
     *              "user"                => $user,
     *              "discount_type"       => $coupon->discount_type,
     *              "discount_value"      => $coupon->discount_value,
     *              "cart_total"          => $amount,
     *              "min_amount"          => $coupon->min_amount,
     *              "is_percentage_coupon"=> $coupon->discount_type == 2 ? true : false
     *          ]
     * 8. Same as step 5,6,7 for the store coupons which is based on quantity (Ex. Buy 3 and get $5 or 5% off) based on user_id
     * 9. Get the best coupon from CouponService getTheBestCouponBetweenCollectedAndStoreCoupons($appliedCoupons) method
     * 10. Push the best coupon into $userGroupBestCoupon array
     * ------------------------------------------------------------------------------------------------------------------------------
     * */
    public function getUserGroupWiseCoupon(
        array $userGroupedCart, object $user
    );




    /**
     * ------------------------------------------------------------------------------------------------------------------------------
     *  Get Best Collected Coupon
     * ------------------------------------------------------------------------------------------------------------------------------
     * ## Required params: $userGroupCarts, object $customer
     *
     * Once the condition is met, we assign the coupon to $bestCollectedCoupon.
     * if no best coupon is assigned yet or if the current coupon has a higher min_amount than the currently selected best coupon.
     *
     * 1.Initial a BestCollectedCoupon params with null
     * 2. Run the $collectedCoupons object|array loop
     * 3. Check if the coupon's min_amount is less than or equal to the user group total amount . Ex $collectedCoupon->min_amount <= $userGroupTotalAmount
     * 4. If the condition is met,
     *      if the bestCollectedCoupon is null or the current coupon has a higher min_amount than the currently selected best coupon
     * 5. Assign the current coupon to $bestCollectedCoupon
     * 6. Continue the loop
     * 7. Return $bestCollectedCoupon
     * ------------------------------------------------------------------------------------------------------------------------------
     * */
    public function getBestCollectedCoupon(object $collectedCoupons, $userGroupTotalAmount, $userGroupTotalQty);




    /**
     * ------------------------------------------------------------------------------------------------------------------------------
     *  Apply Coupon & get the coupon information with calculated coupon discount amount
     * ------------------------------------------------------------------------------------------------------------------------------
     * ## Required params: object $coupon, $amount, object $merchantOrSupplier, $isCollectedCoupon = true
     *
     * 1. Apply the coupon code and get the coupon discount amount by using calculateDiscount() method
     * 2. prepare an array with the coupon information
     *      Ex: [
     *          "coupon_id"           => $coupon->id,
     *          "coupon_total"        => $getCouponDiscount,
     *          "is_collected_coupon" => $isCollectedCoupon,
     *          "user"                => $user,
     *          "discount_type"       => $coupon->discount_type,
     *          "discount_value"      => $coupon->discount_value,
     *          "cart_total"          => $amount,
     *          "min_amount"          => $coupon->min_amount,
     *          "is_percentage_coupon"=> $coupon->discount_type == 2 ? true : false
     *      ];
     *
     * ------------------------------------------------------------------------------------------------------------------------------
     * */

    public function applyCouponBasedOnUserWise(
        object $bestCollectedCoupon,
        $userGroupTotalAmount,
        $userGroupTotalQty,
        object $merchantOrSupplier,
        $isCollectedCoupon = true
    );


    /**
     * ------------------------------------------------------------------------------------------------------------------------------
     *  Get the best store coupon from the store coupons which is based on quantity (Ex. Buy 3 and get $5 or 5% off) based on user_id
     * ------------------------------------------------------------------------------------------------------------------------------
     * ## Required params: $quantityBasedCoupons, $userGroupTotalQty
     *
     * 1. Initial $bestStoreCoupon with null
     * 2. Run the $quantityBasedCoupons object|array loop
     * 3. Check if $quantityBasedCoupon->min_amount == $userGroupTotalQty
     * 4. If the condition is met, assign $quantityBasedCoupon to $bestStoreCoupon
     * 5. else
     *          check the $quantityBasedCoupon->min_amount <= $userGroupTotalQty if the condition is true update $bestStoreCoupon
     * 6. Continue the loop
     * 7. Return $bestStoreCoupon
     *
     * ------------------------------------------------------------------------------------------------------------------------------
     * */
    public function getBestStoreCoupon(
        $quantityBasedCoupons,
        $userGroupTotalAmount,
        $userGroupTotalQty,
    );


    /**
     * ------------------------------------------------------------------------------------------------------------------------------
     *  Get the best coupon from appliedCoupons array.
     * ------------------------------------------------------------------------------------------------------------------------------
     * ## Required params: $appliedCoupons
     *
     * 1. Initial $maxCouponTotal = 0 and $bestCoupon = null
     * 2. Run the $appliedCoupons array loop
     * 3. Check if $couponInfo["coupon_total"] > $maxCouponTotal
     *      if the condition is met, assign $couponInfo to $bestCoupon
     * 4. Continue the loop
     * 5. Return $bestCoupon
     * ------------------------------------------------------------------------------------------------------------------------------
     * */
    public function getTheBestCouponBetweenCollectedAndStoreCoupons(
        array $appliedCoupons
    );
}