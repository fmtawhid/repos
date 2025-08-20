<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BootTrait\CreatedByUpdatedByIdTrait;
use App\Traits\BootTrait\CreatedUpdatedByRelationshipTrait;
use App\Traits\Merchant\MerchantTrait;
use App\Traits\Models\Localization\LocalizationTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;






class Subscription extends Model
{
    use HasFactory,
        // ActiveStat,
        MerchantTrait,
        CreatedByUpdatedByIdTrait,
        CreatedUpdatedByRelationshipTrait,
        // LocalizationTrait,
        SoftDeletes;


    protected $table = "subscriptions";
    protected $fillable = [
        "is_free",
        "title",
        "subscription_category_id",
        "subscription_type",
        "is_active",
        "total_products_limit",
        "total_team_limit",
        "is_ai_included",
        "is_pos_included",
        "price",
        "discount_value",
        "discount_type",
        "discounted_price",
        "features",
        "description",
        "rank",
        "duration",
        "user_id",
        "created_by_id",
        "updated_by_id",
        "deleted_at"
    ];

  
    public function localizations() : HasMany
    {
        return $this->hasMany(SubscriptionLocalization::class, "subscription_id");
    }

    public function category() : BelongsTo
    {
        return $this->belongsTo(SubscriptionCategory::class, "subscription_category_id")->withTrashed();
    }


    // scope filters
    public function scopeFilters($query){
        $request = request();

        //
    }


}
