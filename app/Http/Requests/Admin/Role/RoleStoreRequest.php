<?php

namespace App\Http\Requests\Admin\Role;

use App\Traits\Api\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleStoreRequest extends FormRequest
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
            "name"            => ["required"],
            "permission_id"   => "required|array",
            "permission_id.*" => "exists:permissions,id",
            "is_active"       => "required|in:0,1"
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return $this->sendResponse(
          appStatic()::VALIDATION_ERROR,
          localize("Validation Error for the Role store request"),
          [],
          $validator->errors()
        );
    }
}
