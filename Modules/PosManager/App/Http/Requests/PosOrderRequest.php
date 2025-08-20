<?php

namespace Modules\PosManager\App\Http\Requests;

use App\Traits\Api\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class PosOrderRequest extends FormRequest
{
    use ApiResponseTrait;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (!request()->has("payment_method")) {
            $this->request->add([
                "payment_method" => "cod",
            ]);
        }

        $rules = [
            "payment_method"      => "required|in:cod,cash,card",
            "total_shipping_cost" => "nullable|gt:-1",
            'phone'               => 'nullable',
            'network'             => 'nullable',
            "customer_id"         => "nullable|exists:users,id",
            "employee_id"         => "required|exists:users,id",
            "account_name"        => "required_if:payment_method,card|nullable",
            "card_number"         => "required_if:payment_method,card|nullable",
            "expiration"          => "required_if:payment_method,card|nullable",
            "cvv"                 => "required_if:payment_method,card|nullable",
            "discount_type"       => "nullable|in:1,2",
            "discount_value"      => "nullable|numeric|gt:-1",
            'is_take_way_order'   => "required"
        ];

        // Handle table_id only if is_take_way_order == 1
        if ($this->input('is_take_way_order') == 1) {
            $rules['table_id'] = 'required|exists:tables,id';
        }

        return $rules;
    }


    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'payment_method.required'  => localize('Payment method is required'),
            'payment_method.in'        => localize('Payment method must be in (cod,cash,card)'),
            'total_shipping_cost.gt'   => localize('Total shipping cost must be greater than or equal -1'),
            'table_id.required'        => localize('Please, select a table'),
            'table_id.exists'          => localize("Sorry! This table is not available"),
            'customer_id.exists'       => localize("Sorry! This customer is not available"),
            'account_name.required_if' => localize('Account name is required if payment method is card'),
            'card_number.required_if'  => localize('Card number is required if payment method is card'),
            'expiration.required_if'   => localize('Expiration is required if payment method is card'),
            'cvv.required_if'          => localize('CVV is required if payment method is card'),
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
