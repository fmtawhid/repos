<?php

namespace App\Http\Requests\Admin\Status;

use App\Traits\Api\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StatusUpdateRequest extends FormRequest
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
            "id"        => ["required"],
            "model"     => ["required"]
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $appStatic = appStatic();
        validationException($this->sendResponse(
            $appStatic::VALIDATION_ERROR,
            "Failed to update status",
            [],
            $validator->errors()
        ));
    }
}
