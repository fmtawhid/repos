<?php

namespace App\Http\Requests\Admin\Area;

use App\Traits\Api\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AreaUpdateRequest extends FormRequest
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
            "name"              => ["required", "string", Rule::unique("areas")->where("vendor_id",getUserParentId())->ignore($this->area->id)],
            'branch_ids'        => 'array',
            'branch_ids.*'      => 'required|exists:branches,id',
            "number_of_tables"  => "required|integer",
            'is_active'         => 'numeric',
        ];
    }


    /**
     * @throws \JsonException
     */
    protected function failedValidation(Validator $validator): void
    {

        $this->validationException($validator, localize("Area update validation errors"));
    }


    public function getValidatedData() {
        $data = $this->validated();
        $data["is_active"]         = setActiveStatus();
        return $data;
    }
}

