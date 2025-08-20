<?php

namespace Modules\ReservationManager\App\Models;

use App\Models\Area;
use App\Models\Status;
use App\Models\User;
use App\Traits\BootTrait\CreatedByUpdatedByIdTrait;
use App\Traits\BootTrait\VendorTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\BranchModule\App\Models\Branch;
use Modules\ReservationManager\Database\factories\ReservationFactory;

class Reservation extends Model
{
    use HasFactory;
    use CreatedByUpdatedByIdTrait;
    use VendorTrait;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        "status_id",
        "branch_id",
        "area_id",
        "vendor_id",
        "customer_id",
        "start_datetime",
        "end_datetime",
        "number_of_guests",
        "is_paid",
        "advance_reservation_payment",
        "total_reservation_amount",
        'due_reservation_payment',
        "reservation_due_total",
        "created_by_id",
        "updated_by_id",
        "deleted_by_id",
        "created_at",
        "updated_at",
        "deleted_at"
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    protected static function newFactory()
    {
        //return ReservationFactory::new();
        return null;
    }

    public function reservationTable(){
        return $this->hasOne(ReservationTable::class, 'reservation_id');
    }

    public function status(){
        return $this->belongsTo(Status::class, 'status_id');
    }
    
    public function scopeFilters($query)
    {
        $query->when(request()->status_id, function ($query, $status_id) {
            $query->where('status_id', $status_id);
        });

        $query->when(request()->start_date && request()->end_date, function ($query) {
            $query
            ->where('start_datetime', '>=', request()->start_date)
            ->where('end_datetime', '<=', request()->end_date);
        });

        $query->when(request()->search, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->whereHas('customer', function ($query) use ($search) {
                    $query->where('first_name', 'LIKE', "%{$search}%")
                          ->orWhere('last_name', 'LIKE', "%{$search}%")
                          ->orWhere('email', 'LIKE', "%{$search}%");
                });
                $query->orWhereHas('reservationTable', function ($query) use ($search) {
                    $query->whereHas('table', function ($query) use ($search) {
                        $query->where('table_code', 'LIKE', "%{$search}%");
                    });
                });
            });
        });

        return $query;
    }
    
}
