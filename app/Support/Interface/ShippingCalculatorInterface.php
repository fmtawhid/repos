<?php

namespace App\Support\Interface;

interface ShippingCalculatorInterface
{
    /**
     * Calculate the shipping cost based on the provided weight.
     *
     * @param float $weight
     * @return float
     */
    public function calculateShippingCost(float $weight): float;
}