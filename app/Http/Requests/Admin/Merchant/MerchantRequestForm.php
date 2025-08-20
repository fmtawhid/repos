<?php

namespace App\Http\Requests\Admin\Merchant;

use App\Traits\Api\ApiResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class MerchantRequestForm extends FormRequest
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
        $isRouteMatchWithCurrentRoute = $this->isRouteMatchWithCurrentRoute('admin.merchants.store');

        return [
            "first_name"           => "required|string",
            "last_name"            => "nullable|string",
            'email'                => 'required|email|unique:users,email,' . $this->id,
            'password'             => $isRouteMatchWithCurrentRoute ? 'required|string|min:6' : 'nullable',
            'assign_plan'          => 'nullable',
            'subscription_plan_id' => 'required_if:assign_plan,on',
            'mobile_no'            => 'nullable|string',
            'payment_method'       => 'required_if:is_paid,paid',
            'payment_amount'       => 'nullable|numeric',
            'payment_detail'       => 'nullable|string',
            'account_status'       => 'numeric',
        ];
        
    }

    public function messages()
     {
        return [
            'first_name.required'   => 'The first name field is required.',
            'last_name.required'   => 'The last name field is required.',
            'first_name.string'     => 'The first name field must be a string.',
            'first_name.max'     => 'The first name field must not exceed 255 characters.',
            'email.required'        => 'The email field is required.',
            'email.email'           => 'Please enter a valid email address.',
            'email.unique'          => 'The email address is already in use.',
            'password.required'     => 'The password field is required.',
            'password.string'       => 'The password field must be a string.',
            'password.min'          => 'The password must be at least 6 characters long.',
            'password.confirmed'    => 'The password confirmation does not match.',
        ];
    }

    protected function failedValidation(Validator $validator) 
    {
        throw new HttpResponseException($this->sendResponse(appStatic()::VALIDATION_ERROR, localize("There are errors in the form."), [], $validator->errors()));
    }

    public function getUserData() 
    {
        $data = $this->validated();

        if($this->isRouteMatchWithCurrentRoute('admin.merchants.store')) {
            $data['user_type'] = appStatic()::TYPE_CUSTOMER;
            $data['password']  = bcrypt($data['password']);
        } else {
            unset($data['subscription_plan_id']);
            unset($data['payment_method']);
            unset($data['payment_amount']);
            unset($data['payment_detail']);
            unset($data['password']);
            unset($data['id']);
        }

        return $data;
    }

    public function isRouteMatchWithCurrentRoute(string $routeName)
    {
        return $routeName === currentRoute();
    }
}
