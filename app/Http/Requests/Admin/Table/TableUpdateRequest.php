<?php

namespace App\Http\Requests\Admin\Table;

use App\Traits\Api\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Foundation\Http\FormRequest;

class TableUpdateRequest extends FormRequest
{
    use ApiResponseTrait;
    /**
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
            "table_code"        => "required|string|unique:tables,table_code," . $this->table->id,
            "area_id"           => "required|integer|exists:areas,id",
            "number_of_seats"  => "required|integer",
            "is_active"         => 'numeric',
        ];
    }


     protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(
            $this->sendResponse(appStatic()::VALIDATION_ERROR,
                "Table Validation errors.", [],
                $validator->errors())
        );
    }


    public function getValidatedData() {
        $data = $this->validated();
        $data["is_active"]         = setActiveStatus();
        return $data;
    }
}

