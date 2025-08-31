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
    
    // public function scopeFilters($query)
    // {
    //     $query->when(request()->status_id, function ($query, $status_id) {
    //         $query->where('status_id', $status_id);
    //     });

    //     $query->when(request()->start_date && request()->end_date, function ($query) {
    //         $query
    //         ->where('start_datetime', '>=', request()->start_date)
    //         ->where('end_datetime', '<=', request()->end_date);
    //     });

    //     $query->when(request()->search, function ($query, $search) {
    //         $query->where(function ($query) use ($search) {
    //             $query->whereHas('customer', function ($query) use ($search) {
    //                 $query->where('first_name', 'LIKE', "%{$search}%")
    //                       ->orWhere('last_name', 'LIKE', "%{$search}%")
    //                       ->orWhere('email', 'LIKE', "%{$search}%");
    //             });
    //             $query->orWhereHas('reservationTable', function ($query) use ($search) {
    //                 $query->whereHas('table', function ($query) use ($search) {
    //                     $query->where('table_code', 'LIKE', "%{$search}%");
    //                 });
    //             });
    //         });
    //     });

    //     return $query;
    // }
    // Modules\ReservationManager\App\Models\Reservation.php
    public function scopeForVendor($query, $vendorId = null)
    {
        // ভেন্ডার রোল আছে এমন ইউজারদের জন্য শুধুমাত্র নিজের ভেন্ডার আইডির রিজার্ভেশন দেখাবে
        if (auth()->check()) {
            return $query->where("vendor_id", auth()->user()->vendor_id ?? auth()->id());
        }
        
        // নির্দিষ্ট ভেন্ডার আইডির জন্য ফিল্টার
        if ($vendorId) {
            return $query->where("vendor_id", $vendorId);
        }
        
        return $query;
    }

    public function scopeFilters($query)
    {
        $request = request();

        // ভেন্ডার ফিল্টার - শুধুমাত্র অ্যাডমিনদের জন্য
        if ($request->has("vendor_id") && auth()->user()->hasRole('admin')) {
            $query->where('vendor_id', $request->vendor_id);
        }

        // Status filter
        if ($request->has("status_id")) {
            $query->where('status_id', $request->status_id);
        }

        // Date range filter
        if ($request->has("start_date") && $request->has("end_date")) {
            $query->where('start_datetime', '>=', $request->start_date)
                ->where('end_datetime', '<=', $request->end_date);
        }

        // Search filter
        if ($request->has("search")) {
            $query->where(function ($query) use ($request) {
                $query->whereHas('customer', function ($query) use ($request) {
                    $query->where('first_name', 'LIKE', "%{$request->search}%")
                        ->orWhere('last_name', 'LIKE', "%{$request->search}%")
                        ->orWhere('email', 'LIKE', "%{$request->search}%");
                });
                $query->orWhereHas('reservationTable', function ($query) use ($request) {
                    $query->whereHas('table', function ($query) use ($request) {
                        $query->where('table_code', 'LIKE', "%{$request->search}%");
                    });
                });
            });
        }

        return $query;
    }
    
}
