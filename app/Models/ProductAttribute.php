<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        "product_id",
        "is_active",
        "title",
        "price",
        "discount_start_at",
        "discount_end_at",
        "discount_type",
        "discount_value",
        "discount_amount",
        "discounted_price",
    ];


    protected $appends  = [
        'formatted_price',
        'calculated_amount',
    ];



    public function getCalculatedAmountAttribute()
    {

        return formatPrice($this->discounted_price);
    }

    public function getFormattedPriceAttribute()
    {
        return formatPrice($this->price);
    }
    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class, 'product_attribute_id');
    }




}
