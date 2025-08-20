<?php

namespace App\Models;

use App\Traits\BootTrait\CreatedByUpdatedByIdTrait;
use App\Traits\BootTrait\HasBranchId;
use App\Traits\BootTrait\HasOrderCode;
use App\Traits\BootTrait\VendorTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\BranchModule\App\Models\Branch;
use App\Models\User;

class Order extends Model
{
    use HasFactory;
    use CreatedByUpdatedByIdTrait;
    use VendorTrait;
    use HasOrderCode;
    use HasBranchId;

    protected $fillable = [
        "invoice_no",
        "is_online_order",
        "is_take_way_order",
        "online_platform",
        "vendor_id",
        "branch_id",
        "employee_id",
        "customer_id",
        "table_id",
        "status_id",
        "total_qty",
        "payment_method",
        "is_paid",
        "total",
        "discount_type",
        "discount_value",
        "discounted_amount",
        "payable_after_discount",
        "paid_amount",
        "customer_note",
        "kitchen_note",
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

    public function table(): BelongsTo
    {
        return $this->belongsTo(Table::class, 'table_id');
    }

    public function waiter() : BelongsTo
    {
        return $this->belongsTo(User::class,"employee_id");
    }

    public function customer() : BelongsTo
    {
        return $this->belongsTo(User::class,"customer_id");
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class, 'order_id');
    }



    // Scope Start
    public function scopeStatusId($query, $statusId)
    {
        $query->where("orders.status_id", $statusId);
    }

    public function scopeBranchId($query, $branchId)
    {
        $query->where("orders.branch_id", $branchId);
    }

    public function scopeEmployeeId($query, $employeeId)
    {
        $query->where("orders.employee_id", $employeeId);
    }


    // Scope End
}
