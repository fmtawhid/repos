<?php

namespace Modules\PosManager\App\Http\Requests;

use App\Traits\Api\ApiResponseTrait;
use Illuminate\Foundation\Http\FormRequest;

class CustomerStoreRequest extends FormRequest
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
            "first_name"      => "required",
            "email"     => "required",
            "mobile_no" => "required",
            "address"   => "nullable",
        ];
    }

    public function getData()
    {
        $data = $this->validated();


        // Password
        $data["password"] = bcrypt(randomStringNumberGenerator(6));

        // User Type
        $data["user_type"] = appStatic()::TYPE_CUSTOMER;

        // Is Verified
        $data["is_verified"] = appStatic()::ACTIVE; // As Verified

        // Email Verified at
        $data["email_verified_at"] = now();

        // Active Status
        $data["account_status"] = appStatic()::ACTIVE;

        return $data;
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
}
