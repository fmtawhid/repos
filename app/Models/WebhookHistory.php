<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebhookHistory extends Model
{
    use HasFactory;

    protected $table = "webhook_histories";
    protected $fillable = [
        "gateway",
        "webhook_id",
        "stripe_product_id",
        "stripe_plan",
        "customer_id",
        "customer_name",
        "customer_email",
        "create_time",
        "resource_type",
        "event_type",
        "summary",
        "resource_id",
        "resource_state",
        "parent_payment",
        "amount_total",
        "amount_currency",
        "incoming_json",
        "hook_payloads",
        "status"
    ];
}
