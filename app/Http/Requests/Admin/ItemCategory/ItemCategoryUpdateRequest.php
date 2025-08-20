<?php

namespace App\Http\Requests\Admin\ItemCategory;

use App\Traits\Api\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ItemCategoryUpdateRequest extends FormRequest
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
            "name"      => ["required","string",Rule::unique("item_categories")->where("vendor_id",getUserParentId())->ignore($this->item_category->id)],
            'is_active' => 'numeric',
        ];
    }

    public function getValidatedData() {

        $data               = $this->validated();
        $data["is_active"]  = setActiveStatus();

        return $data;
    }

    /**
     * @throws \JsonException
     */
    protected function failedValidation(Validator $validator): void
    {
        $this->validationException($validator, localize("Item Category Store Validation failed") );
    }
}
