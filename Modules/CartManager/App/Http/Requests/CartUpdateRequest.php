<?php

namespace Modules\CartManager\App\Http\Requests;

use App\Traits\Api\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CartUpdateRequest extends FormRequest
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
            "cart_id"    => "required|exists:carts,id",
            "qty_change" => "required|integer|min:-1|not_in:0",
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

    protected function failedValidation(Validator $validator)
    {

        $this->validationException($validator,"Failed to Update Cart Item");
    }
}
