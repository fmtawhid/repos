<?php

namespace Modules\CartManager\App\Models;

use App\Models\ProductAttribute;
use App\Models\User;
use App\Traits\BootTrait\CreatedByUpdatedByIdTrait;
use App\Traits\BootTrait\HasBranchId;
use App\Traits\BootTrait\HasUserId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\Relationship\ProductCallTrait;

class Cart extends Model
{
    use HasFactory, CreatedByUpdatedByIdTrait,ProductCallTrait,HasUserId,HasBranchId;

    protected $table = 'carts';

    protected $fillable = [
        "user_id",
        "branch_id",
        "product_id",
        "product_attribute_id",
        "qty",
        "product_addons",
        "created_by_id",
        "updated_by_id",
        "deleted_by_id"
    ];

    protected $casts = [
        "product_addons" => "array"
    ];

    public function productVariation() : BelongsTo
    {
        return $this->belongsTo(ProductAttribute::class,"product_attribute_id");
    }


    public function attribute() : BelongsTo
    {
        return $this->belongsTo(ProductAttribute::class,"product_attribute_id");
    }

    public function productAttribute() : BelongsTo
    {
        return $this->belongsTo(ProductAttribute::class,"product_attribute_id");
    }

    public function customer() : BelongsTo
    {
        return $this->belongsTo(User::class,"user_id");
    }



    # Scope
    public function scopeUserId($query, $user_id = null){
        $user_id = empty($user_id) ? userID() : $user_id;

        $query->where('carts.user_id', $user_id);
    }

    public function scopeProductAttributeId($query, $product_attribute_id)
    {
        $query->where('carts.product_attribute_id', $product_attribute_id);

    }



    #Dynamic Column Scope
    public function scopeDynamicColumn($query, $column = null, $value){
        $column = empty($column) ? "product_attribute_id" : $column;

        $query->where($column, $value);
    }
}
