<?php

namespace App\Traits\Relationship;

use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait ProductCallTrait
{
    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class,"product_id")->withTrashed();
    }

}
