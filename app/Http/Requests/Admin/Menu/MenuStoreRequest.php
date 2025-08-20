<?php

namespace App\Http\Requests\Admin\Menu;

use App\Traits\Api\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MenuStoreRequest extends FormRequest
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
            "name"         => ["required", "string", Rule::unique("menus")->where("vendor_id",getUserParentId())],
            'branch_ids'   => 'array|required',
            'branch_ids.*' => 'required|exists:branches,id',
            'is_active'    => 'numeric',
        ];
    }


    public function messages()
    {
        return [
            'name.required'         => 'The name field is required.',
            'name.string'           => 'The name field must be a string.',
            'name.unique'           => 'The name address is already in use.',
            'branch_ids.array'      => 'The branch ids field must be an array.',
            'branch_ids.*.required' => 'Branch is required',
            'is_active.numeric'     => 'The is active field must be numeric.',
        ];
    }

    public function getValidatedData() {

        $data = $this->validated();
        $data["is_active"]         = setActiveStatus();

        return $data;
    }

    /**
     * @throws \JsonException
     */
    protected function failedValidation(Validator $validator): void
    {
        $this->validationException($validator, localize("Menu Store Validation failed"));
    }
}
