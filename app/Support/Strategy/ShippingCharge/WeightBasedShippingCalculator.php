<?php

namespace App\Support\Strategy\ShippingCharge;

use App\Utils\CacheManager;
use App\Support\Interface\ShippingCalculatorInterface;

class WeightBasedShippingCalculator implements ShippingCalculatorInterface
{
    public function calculateShippingCost(float $weight): float
    {
        // Get the cost from unit_prices table
        return (new CacheManager())->getShippingChargeByWeight($weight);
    }


}