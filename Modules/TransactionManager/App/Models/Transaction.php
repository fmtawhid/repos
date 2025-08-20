<?php

namespace Modules\TransactionManager\App\Models;

use App\Models\User;
use App\Traits\BootTrait\CreatedByUpdatedByIdTrait;
use App\Traits\BootTrait\HasTransactionNoTrait;
use App\Traits\BootTrait\VendorTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\BranchModule\App\Models\Branch;
use Modules\TransactionManager\Database\factories\TransactionFactory;

class Transaction extends Model
{
    use HasFactory;
    use CreatedByUpdatedByIdTrait;
    use VendorTrait;
    use HasTransactionNoTrait;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        "transaction_no",
        "vendor_id",
        "branch_id",
        "order_id",
        "customer_id",
        "reservation_id",
        "paid_amount",
        "payment_method",
        "status_id",
        "note",
        "created_by_id",
        "updated_by_id",
        "deleted_by_id",
        "created_at",
        "updated_at",
        "deleted_at"
    ];

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    protected static function newFactory()
    {
        //return TransactionFactory::new();
        return null;
    }
}
