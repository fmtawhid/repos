<?php

namespace App\Http\Requests\Frontend;

use App\Traits\Api\ApiResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class ContactUsRequestForm extends FormRequest
{
    use ApiResponseTrait;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            "name"    => ["required"],
            "email"   => ["required"],
            "phone"   => ["nullable"],
            "message" => ["required"],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $appStatic = appStatic();

        validationException(
            $this->sendResponse(
                $appStatic::VALIDATION_ERROR,
                localize("Contact to us Validation Error"),
                [],
                $validator->errors()
            )
        );
    }
}
