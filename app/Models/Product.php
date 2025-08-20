<?php

namespace App\Models;

use App\Traits\BootTrait\CreatedByUpdatedByIdTrait;
use App\Traits\BootTrait\CreatedUpdatedByRelationshipTrait;
use App\Traits\BootTrait\VendorTrait;
use App\Traits\Global\VendorIdGlobalTrait;
use App\Traits\MediaManagerTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use CreatedByUpdatedByIdTrait;
    use CreatedUpdatedByRelationshipTrait;
    use MediaManagerTrait;
    use VendorTrait;
    use VendorIdGlobalTrait;
    use SoftDeletes;

    protected $table = 'products';

    protected $fillable = [
        "vendor_id",
        "is_active",
        "name",
        "menu_id",
        "item_category_id",
        "media_manager_id",
        "preparation_time",
        "description",
        "product_addons",
        "created_by_id",
        "updated_by_id",
        "deleted_by_id",
        "deleted_at"
    ];

    protected $casts = [
        'product_addons' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(ItemCategory::class, 'item_category_id');
    }

    public function vendor(){
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function menu() : BelongsTo
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function productAttributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    public function lowestVariationPrice(){
        return $this->productAttributes()->min('price');
    }


    public function scopeFilters($query)
    {
        $request = request();

        // Menu Name
        if($request->has("keyword") && !empty($request->keyword)) {
            $keyword = $request->keyword;

            $query->where('products.name', 'like', '%'.$keyword.'%');
        }

        // search
        if($request->has("search") && !empty($request->search)) {
            $keyword = $request->search;

            $query->where('products.name', 'like', '%'.$keyword.'%');
        }

        //Filter By Item Name Only
        if($request->has("item_name") && !empty($request->item_name)) {
            $item_name = $request->item_name;

            $query->where('products.name', 'like', '%'.$item_name.'%');
        }


        // Status
        if($request->has("is_active") && !is_null($request->is_active)) {
            $is_active = $request->is_active;

            $query->where('products.is_active', $is_active);
        }

        // Item Category
        if($request->has("category_id") && !empty($request->category_id)) {
            $category_id = $request->category_id;

            $query->where('products.item_category_id', $category_id);
        }

    }

    public function itemCategory(){
        return $this->belongsTo(ItemCategory::class, 'item_category_id');
    }


}
