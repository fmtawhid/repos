<?php

namespace Modules\BranchModule\App\Http\Requests\Branch;

use App\Traits\Api\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class BranchStoreRequest extends FormRequest
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
            "name"        => "required|string",
            "branch_code" => ["required", "string",Rule::unique("branches")->where("vendor_id",getUserParentId())],
            "address"     => "nullable|string",
            "mobile_no"   => "nullable|string",
            "email"       => "nullable|email",
            'is_active'   => 'numeric',
        ];
    }


    /**
     * @throws \JsonException
     */
    protected function failedValidation(Validator $validator): void
    {

        $this->validationException($validator,"Branch Store Validation failed");
    }


    public function getValidatedData() {

        $data              = $this->validated();
        $data["is_active"] = setActiveStatus();
        return $data;
    }
}
