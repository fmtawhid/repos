<?php

namespace App\Support\Strategy\ShippingCharge;

class FlatRateShippingCalculator
{
    public function calculateShippingCost(float $weight): float
    {
        return 10.00; // Flat rate for all weights
    }
}