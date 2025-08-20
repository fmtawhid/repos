<?php

namespace App\Services\Model\SubscriptionPlan;

use App\Models\SubscriptionPlan;
use App\Models\PaymentGatewayProduct;


class SubscriptionSettingsService
{
    public function index():array
    {
        $data = [];
        $data['isActivePaypal']         = paymentGateway('paypal')?->is_active; 
        $data['isActiveStripe']         = paymentGateway('stripe')?->is_active; 
        $exitPapalProductIds            = $this->gatewayProducts([['gateway', 'paypal']], true, true);
        $exitStripeProductIds           = $this->gatewayProducts([['gateway', 'stripe']], true, true);
        $data['gateWaysProductsPaypal'] = $this->gatewayProducts([['gateway', 'paypal']], false, true);
        $data['gateWaysProductsStripe'] = $this->gatewayProducts([['gateway', 'stripe']], false, true);
        $data['paypalPackages']         = SubscriptionPlan::whereNotIn('id', $exitPapalProductIds)->where('package_type', '!=', 'starter')->get(['id', 'title', 'package_type', 'price']);
        $data['stripPackages']          = SubscriptionPlan::whereNotIn('id', $exitStripeProductIds)->where('package_type', '!=', 'starter')->get(['id', 'title', 'package_type', 'price']);
        return $data;
    }
    private function gatewayProducts($conditions = [], $toArray = null, $is_active = null):array|object
    {
        $gatewayProducts = PaymentGatewayProduct::when($is_active, function($q) use($is_active){
            $q->where('is_active', $is_active);
        })
        ->when($conditions, function($q) use($conditions){
            $q->where($conditions);
        });
        if($toArray){
            return $gatewayProducts->pluck('subscription_plan_id')->toArray();
        }
        return $gatewayProducts->get();
    }
    public function storeGatewayProduct()
    {
        
    }
}