<?php

namespace Modules\ReservationManager\App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;
use App\Traits\Api\ApiResponseTrait;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class ReservationStoreRequest extends FormRequest
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
            'table_id'             => 'required|numeric|exists:tables,id',
            'status_id'            => 'required|numeric|exists:statuses,id',
            
            'customer_first_name'  => 'required|nullable|string',
            'customer_last_name'   => 'nullable|nullable|string',

            'customer_phone'       => 'required|string',
            'customer_email'       => 'required|email|unique:users,email',
            'branch_id'            => 'required|numeric|exists:branches,id',            
            'area_id'              => 'required|numeric|exists:areas,id',            
            
            'start_datetime'       => 'nullable|date|after:now',
            'end_datetime'         => 'nullable|date|after:start_datetime',

            'number_of_guests'     => 'required|numeric|min:1',
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
