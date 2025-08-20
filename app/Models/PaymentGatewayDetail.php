<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentGatewayDetail extends Model
{
    use HasFactory;
    protected $fillable = ['payment_gateway_id', 'key', 'value'];
}
