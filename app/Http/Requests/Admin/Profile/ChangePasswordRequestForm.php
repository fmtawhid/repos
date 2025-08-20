<?php

namespace App\Http\Requests\Admin\Profile;

use App\Traits\Api\ApiResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Hash;

class ChangePasswordRequestForm extends FormRequest


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
            "password_confirmation" => ["required"],
            "password"              => "required|min:6|confirmed",
            "old_password"          => "required|different:password",
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!password_verify($this->old_password, user()->password)) {
                $validator->errors()->add('old_password', localize('Old password is not correct.'));
            }
        });
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(
            $this->sendResponse(appStatic()::VALIDATION_ERROR,
            localize("Password update validation errors."), [],
                $validator->errors())
        );
    }
}