<?php

namespace App\Support\Interface;

interface ShippingStrategy
{
    public function calculateShipping(array $products): float;
}