<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $table = "order_products";

    protected $fillable = [
        "order_id",
        "product_id",
        "product_owner_id",
        "product_json",
        "product_attribute_json",
        "product_addons",
        "product_attribute_id",
        "qty",
        "price",
        "sub_total",
        "addons_price",
        "discount_type",
        "discount_value",
        "discount_amount",
        "shipping_cost",
        "total_price",
        "is_refund",
        "is_cancel"
    ];

    protected $casts = [
        "product_json"   => 'array',
        "product_attribute_json"   => 'array',
        "product_addons" => 'array'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
