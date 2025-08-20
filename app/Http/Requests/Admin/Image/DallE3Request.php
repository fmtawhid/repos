<?php

namespace App\Http\Requests\Admin\Image;

use App\Traits\Api\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class DallE3Request extends FormRequest
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
        wLog("Dall-e-3 Image Creation Incoming Payloads : ", $this->all(), logService()::LOG_OPEN_AI);

        return [
            "content_purpose"   => "required|in:dall-e-3",
            "number_of_results" => "required|integer|max:1",
            "size"              => "required|in:1792x1024,1792x1024,1024x1024",
            "title"             => "required"
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $appStatic = appStatic();

        throw new HttpResponseException(
            $this->sendResponse(
                $appStatic::VALIDATION_ERROR,
                localize("Dall E 3 Validation Error"),
                [],
                $validator->errors(),
            )
        );
    }
}
