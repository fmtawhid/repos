<?php

namespace App\Http\Requests\Admin\Profile;

use App\Services\Model\User\UserService;
use Illuminate\Validation\Rule;
use App\Traits\Api\ApiResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class InfoUpdateRequestForm extends FormRequest
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
        /**
         * branch_id update to the user profile
         * */
        if($this->branch_id && $this->purpose){
            return [
                "branch_id" => ["required", Rule::exists("branches","id")->where("vendor_id", getUserParentId())]
            ];
        }

        $user = (new UserService())->findById($this->user_id ?? user()->id);

        return [
            "first_name" => "required|string",
            "last_name"  => "nullable|string",
            "email"      => ["bail","required","email:rfc,dns",Rule::unique("users")->ignore($user)],
            "mobile_no"  => ["nullable"],
            "avatar"     => ["nullable"],
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(
            $this->sendResponse(appStatic()::VALIDATION_ERROR,
                localize("User Info validation error."), [],
                $validator->errors())
        );
    }

}
