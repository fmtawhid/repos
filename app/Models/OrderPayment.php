<?php

namespace App\Models;

use App\Traits\BootTrait\VendorTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\BranchModule\App\Models\Branch;
use Modules\TransactionManager\App\Models\Transaction;
use App\Models\User;

class OrderPayment extends Model
{
    use HasFactory;
    use VendorTrait;

    protected $fillable = [
        "vendor_id",
        "branch_id",
        "order_id",
        "transaction_id",
        "amount",
        "created_at",
        "updated_at"
    ];

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }
}
