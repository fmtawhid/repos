<?php

namespace Modules\ReservationManager\App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;
use App\Traits\Api\ApiResponseTrait;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class ReservationUpdateRequest extends FormRequest
{    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [                        
            'status_id'            => 'required|numeric|exists:statuses,id',
            'table_id'             => 'required|numeric|exists:tables,id',
            'customer_first_name'  => 'required|nullable|string',
            'customer_last_name'   => 'nullable|nullable|string',
            'customer_email'       => 'required|email|unique:users,email,'.$this->reservationmanager->customer->id,
            'customer_phone'       => 'required|string',
            'branch_id'            => 'required|numeric|exists:branches,id',            
            'area_id'              => 'required|numeric|exists:areas,id',            
            'number_of_guests'     => 'required|numeric|min:1',
            'start_datetime'       => 'nullable|date|after:now',
            'end_datetime'         => 'nullable|date|after:start_datetime',
            'is_paid'              => 'required|boolean',
            'total_reservation_amount'      => 'required|numeric|min:0',
            'advance_reservation_payment'   => 'required|numeric|min:0',
        ];
    }

    public function getValidatedData() {
        $data = $this->validated();
        return $data;
    }
}
