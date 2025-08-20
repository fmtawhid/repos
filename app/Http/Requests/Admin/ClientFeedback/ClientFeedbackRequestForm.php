<?php

namespace App\Http\Requests\Admin\ClientFeedback;

use App\Traits\Api\ApiResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class ClientFeedbackRequestForm extends FormRequest
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
            'name'        => ['required'],
            'designation' => ['required'],
            'rating'      => ['required'],
            'review'      => ['required'],     
            'avatar'      => ['nullable'],     
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
                localize("Client Feedback Validation Error"),
                [], $validator->errors()
            )
        );
    }
}
