<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\Status\IsActiveTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\BootTrait\CreatedUpdatedByRelationshipTrait;

class SubscriptionUserUsage extends Model
{
    use HasFactory;
    use SoftDeletes;
    use IsActiveTrait;
    use CreatedUpdatedByRelationshipTrait;

    protected $table = 'subscription_user_usages';
    protected $fillable = [
        "user_id",
        "subscription_user_id",
        "subscription_plan_id",
        "subscription_status",
        "platform",
        "has_monthly_limit",
        "start_at",
        "expire_at",

        // branches
        'allow_unlimited_branches',
        'branch_balance',
        "branch_balance_used",
        "branch_balance_remaining",

        'allow_kitchen_panel',
        'allow_reservations',
        "allow_support",
        "allow_team",
        
        "is_active",
        "created_by_id",
        "updated_by_id",
        "deleted_at"
    ];
}
