<?php

namespace App\Http\Requests\Admin\FAQ;

use App\Traits\Api\ApiResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class FAQRequestForm extends FormRequest
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
           'question'  => ['required'],
           'answer'    => ['required'],
           "is_active" => ["required","numeric"],
        ];
    }
    public function attributes()
    {
        return [
            "is_active" => "Status",
        ];
    }

    public function getData()
    {
        $data = $this->validated();
        return $data;
    }

    protected function failedValidation(Validator $validator)
    {
        $appStatic = appStatic();

        validationException(
            $this->sendResponse(
                $appStatic::VALIDATION_ERROR,
                localize("FAQ Validation Error"),
                [], $validator->errors()
            )
        );
    }
}
