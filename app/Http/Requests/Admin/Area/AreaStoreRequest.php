<?php

namespace App\Http\Requests\Admin\Area;

use App\Traits\Api\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AreaStoreRequest extends FormRequest
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
            "name"              => ["required", "string", Rule::unique("areas")->where("vendor_id",getUserParentId())],
            'branch_ids'        => 'required|array',
            "number_of_tables"  => "required|integer",
            'is_active'         => 'numeric',
        ];
    }


    /**
     * @throws \JsonException
     */
    protected function failedValidation(Validator $validator): void
    {
        $this->validationException($validator, localize("Area Store Validation failed"));
    }


    public function getValidatedData() {
        $data = $this->validated();
        $data["is_active"]         = setActiveStatus();
        return $data;
    }
}
