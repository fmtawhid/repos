<?php

namespace App\Http\Requests\Admin;

use App\Traits\Api\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class MetaDescrtiptionGenerateRequest extends FormRequest
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
        info("Generate Title Incoming Payloads". json_encode($this->request->all(), JSON_THROW_ON_ERROR));

        return [
            "title"             => "required|string",
            "number_of_results" => "required|min:1",
            "lang"              => "required|string",
            "article_id"        => "nullable|exists:articles,id",
            "content_purpose"   => "required|in:".contentPurposeInside(),
        ];
    }

    /**
     * @throws \JsonException
     */
    protected function failedValidation(Validator $validator)
    {
        $this->validationException($validator,localize("Failed to generate meta description"));
    }


}
