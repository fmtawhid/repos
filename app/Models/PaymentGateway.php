<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentGateway extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function gatewayDetails(): HasMany
    {
        return $this->hasMany(PaymentGatewayDetail::class);
    }
    public function scopeActiveStatus($q)
    {
        return $q->where('is_active', 1);
    }
}
