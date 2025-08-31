<?php

namespace Modules\ReservationManager\App\Services\Reservation;

use App\Models\User;
use Modules\ReservationManager\App\Models\Reservation;
use Modules\ReservationManager\App\Models\ReservationTable;
use phpDocumentor\Reflection\Types\This;
use Illuminate\Support\Carbon;

/**
 * Class ReservationService.
 */
class ReservationService
{
    protected $model = Reservation::class;
    public $customerObject = null;

    // Modules\ReservationManager\App\Services\Reservation\ReservationService.php
    public function getAll(
        $isPaginateGetOrPluck = null,
        $onlyActives = null,
        $relations = [],
        $forVendor = false
    )
    {
        $request = request();
        $query = $this->model::query()->filters();

        // ভেন্ডারের জন্য শুধুমাত্র নিজের ভেন্ডার আইডির রিজার্ভেশন দেখাবে
        if ($forVendor) {
            $query->forVendor();
        }

        if (is_null($isPaginateGetOrPluck)) {
            return $query->pluck("name", "id");
        }
        
        if ($relations) {
            $query->with($relations);
        }

        return $isPaginateGetOrPluck ? $query->paginate(maxPaginateNo()) : $query->get();
    }

    public function getReservationReports($forVendor = false)
    {
        $date_range = request()->date_range ?? null;
        $query = Reservation::query()->filters();

        // ভেন্ডারের জন্য শুধুমাত্র নিজের ভেন্ডার আইডির রিজার্ভেশন দেখাবে
        if ($forVendor) {
            $query->forVendor();
        }

        if ($date_range) {
            $dates = explode(' to ', $date_range);
            
            $query->whereBetween('start_datetime', [
                Carbon::createFromFormat('m/d/Y', $dates[0])->startOfDay(),
                Carbon::createFromFormat('m/d/Y', $dates[1])->endOfDay(),
            ]);
        }

        $branch_id = request()->branch_id ?? null;
        $status_id = request()->status_id ?? null;
        
        if($branch_id){
            $query->where('branch_id', $branch_id);
        }

        if($status_id){
            $query->where('status_id', $status_id);
        }

        return $query->paginate(maxPaginateNo() ?? 10);
    }
    // public function getAll(
    //     $isPaginateGetOrPluck = null,
    //     $onlyActives = null,
    //     $relations = []
    // )
    // {
    //     $request = request();
    //     $query = $this->model::query()->filters();

    //     if (is_null($isPaginateGetOrPluck)) {
    //         return $query->pluck("name", "id");
    //     }
    //     if ($relations) {
    //         $query->with($relations);
    //     }


    //     return $isPaginateGetOrPluck ? $query->paginate(maxPaginateNo()) : $query->get();
    // }

    public function storeReservation($payloads)
    {
        $this->model = $this->model::query()->create(
            $this->reservationStoreRequest($payloads)       
        );        
        
        return $this;;
    }

    public function updateReservation($payloads)
    {
        $this->model->update(
            $this->reservationStoreRequest($payloads)       
        );        
        return $this;
    }


    //this function is already used for multiple purposes
    public function reservationStoreRequest($payloads)
    {
        return [
            "customer_id"                   => $this->customerObject->id,
            "branch_id"                     => $payloads['branch_id'],
            "area_id"                       => $payloads['area_id'] ?? null,
            "start_datetime"                => $payloads['start_datetime'],
            "end_datetime"                  => $payloads['end_datetime'],
            "number_of_guests"              => $payloads['number_of_guests'],
            "is_paid"                       => $payloads['is_paid'],
            "status_id"                     => $payloads['status_id'],
            "vendor_id"                     => getUserParentId(),
            "total_reservation_amount"      => $payloads['total_reservation_amount'],
            "advance_reservation_payment"   => $payloads['advance_reservation_payment'],
            "due_reservation_payment"       => $payloads['total_reservation_amount'] - $payloads['advance_reservation_payment'],
        ];        
    }

    // store reservation table
    public function storeReservationTable($data)
    {
        $alreadyExist = $this->checkAlreadyBooked($data);

        if ($alreadyExist) {
            throw new \Exception("This table is already booked for this time slot");
        }else{
            $this->model->reservationTable()->create([
                "reservation_id" => $this->model->id,
                "table_id"       => $data['table_id']
            ]);
        }       
        return $this;
    }

    public function updateReservationTable($data)
    {
        $alreadyExist = $this->checkAlreadyBooked($data);

        if ($alreadyExist) {
            throw new \Exception("This table is already booked for this time slot");
        }else{
            $this->model->reservationTable()->update([
                "reservation_id" => $this->model->id,
                "table_id"       => $data['table_id']
            ]);
        }       

        return $this;        
    }


    private function checkAlreadyBooked($data){
        return ReservationTable::query()
            ->whereHas('reservation', function($query) use ($data){
                $query
                ->where('start_datetime', '<=', $data['end_datetime'])
                ->where('end_datetime', '>=', $data['start_datetime'])
                ->where('status_id', 1);
            })
            ->where('table_id', $data['table_id'])
            ->where('reservation_id', '!=', $this->model->id)                       
            ->exists();
    }

    public function findById($id, $relations = [])
    {
        return $this->model::query()
            ->with($relations)
            ->findOrFail($id);
    }


    public function createReservationCustomer($data)
    {
        $user = User::query()->create($this->customerRequest($data));
        $this->customerObject = $user;
        
        return $this;
    }

    public function setModel($reservation){
        $this->model = $reservation;
        return $this;
    }
    
    
    public function updateReservationCustomer($data)
    {
        $this->model->customer->update($this->customerRequest($data));                 
        $this->customerObject = $this->model->customer;

        return $this;
    }


    public function customerRequest($data){
        return [
            "first_name"    => $data['customer_first_name'] ?? null,
            "last_name"     => $data['customer_last_name'] ?? null,
            "mobile_no"     => $data['customer_phone'] ?? null,
            "email"         => $data['customer_email'] ?? null,
            "user_type"     => appStatic()::TYPE_CUSTOMER,
            "password"      => bcrypt($data['customer_email']) //by default email will be password
        ];
    }

    // public function getReservationReports(){
    //     $date_range = request()->date_range ?? null;
    //     $query      = Reservation::query();

    //     if ($date_range) {
    //         $dates = explode(' to ', $date_range);
            
    //         $query->whereBetween('start_datetime', [
    //             Carbon::createFromFormat('m/d/Y', $dates[0])->startOfDay(),
    //             Carbon::createFromFormat('m/d/Y', $dates[1])->endOfDay(),
    //         ]);
    //     }

    //     $branch_id = request()->branch_id ?? null;
    //     $status_id = request()->status_id ?? null;
    //     if($branch_id){
    //         $query->where('branch_id', $branch_id);
    //     }

    //     if($status_id){
    //         $query->where('status_id', $status_id);
    //     }

    //     return $query->paginate(maxPaginateNo() ?? 10);
    // }


}

