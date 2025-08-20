<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\Status\IsActiveTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BootTrait\CreatedByUpdatedByIdTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\BootTrait\CreatedUpdatedByRelationshipTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubscriptionUser extends Model
{
    use HasFactory;
    use IsActiveTrait;
    use CreatedUpdatedByRelationshipTrait;
    use SoftDeletes;

    protected $fillable = [
        "has_monthly_limit",
        "start_at",
        "expire_at",
        "expire_by_admin_date",
        "subscription_plan_id",
        "subscription_status",
        "payment_status",
        "price",
        "discount",
        'discount_type',
        "payment_details",
        "note",
        'feedback_note',
        "forcefully_active",
        "is_recurring",
        "is_carried_over",
        "payment_method",
        "offline_payment_id",
        "payment_gateway_id",
        "file",
        "order_id",
        "user_id",
        "is_active",
        "created_by_id",
        "updated_by_id",
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(SubscriptionPlan::class, 'subscription_plan_id', 'id')->withDefault();
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentGateway::class, 'payment_gateway_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withDefault();
    }

    public function offlinePaymentMethod(): BelongsTo
    {
        return $this->belongsTo(OfflinePaymentMethod::class, 'offline_payment_id', 'id')->withDefault();
    }
}
