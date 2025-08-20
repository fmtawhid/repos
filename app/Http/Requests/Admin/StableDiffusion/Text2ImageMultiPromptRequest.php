<?php

namespace App\Http\Requests\Admin\StableDiffusion;

use App\Traits\Api\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class Text2ImageMultiPromptRequest extends FormRequest
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
            "title"             => "array",
            "title.*"           => "required",
            "number_of_results" => "required|integer|between:1,10",
            "size"              => "nullable",
            "mood"              => "nullable",
            "style"             => "nullable",
            "lighting_style"    => "nullable",
            "content_purpose"   => "nullable",
        ];
    }

    public function failedValidation(Validator $validator)
    {
        validationException(
            $this->sendResponse(
                appStatic()::VALIDATION_ERROR,
                "SD Multi Prompt Image Validation Error",
                [],
                $validator->errors()
            )
        );
    }
}
