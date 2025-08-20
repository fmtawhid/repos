<?php

namespace Modules\CartManager\App\Http\Requests;

use App\Traits\Api\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CartStoreRequest extends FormRequest
{
    use ApiResponseTrait;
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "product_id"           => "required|exists:products,id",
            "product_attribute_id" => "required|exists:product_attributes,id",
            "qty_change"           => "required|integer|min:-1|not_in:-1",
        ];
    }

    public function messages(): array
    {

        return [
            "product_id.required"   => "The product ID is required.",
            "product_id.exists"     => "The selected product ID is invalid.",
            "product_attribute_id.required" => "The Attribute Value is required.",
            "product_attribute_id.exists"   => "The Attribute Value is invalid.",
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @throws \JsonException
     */
    protected function failedValidation(Validator $validator): void
    {
        $messages = getValidatorFieldsError($validator);

        $this->validationException($validator,"Failed! ". $messages);
    }
}
