<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\Status\IsActiveTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BootTrait\CreatedByUpdatedByIdTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\BootTrait\CreatedUpdatedByRelationshipTrait;

class SubscriptionPlan extends Model
{
    use HasFactory;
    use IsActiveTrait;
    use CreatedByUpdatedByIdTrait;
    use CreatedUpdatedByRelationshipTrait;
    use SoftDeletes;

    protected $table = 'subscription_plans';

    protected $fillable = [
            "has_monthly_limit",
            "title",
            "slug",
            "user_id",
            "duration",
            "openai_model",
            "description",
            "package_type",
            "price",
            "discount_price",
            "discount_type",
            "discount",
            "discount_status",
            "discount_start_date",
            "discount_end_date",

            'allow_unlimited_branches',
            'total_branches',

            'allow_kitchen_panel',
            'show_kitchen_panel',

            'allow_reservations',
            'show_reservations',

            'allow_support',
            'show_support',

            'allow_team',
            'show_team',

            "is_featured",
            "other_features",
            "is_active",
            "created_by_id",
            "updated_by_id",
            "created_at",
            "updated_at",
            "deleted_at"
    ];

    public function scopeFilters($query)
    {
        $request = request();

        // Is Active
        if ($request->has("package_type")) {
            $query->where('package_type', $request->package_type);
        }else{
            $query->whereIn('package_type', [appStatic()::PACKAGE_TYPE_STARTER, appStatic()::PACKAGE_TYPE_MONTHLY]);
        }

        // When package type is monthly add starter to the query
        if((string) $request->package_type === 'monthly' && !isCustomer()){
            $query->orWhere('package_type', 'starter');
        }

        // Search
        if ($request->has("search")) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        return $query;
    }
}
