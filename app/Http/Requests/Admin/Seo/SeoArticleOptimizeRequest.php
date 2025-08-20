<?php

namespace App\Http\Requests\Admin\Seo;

use App\Traits\Api\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class SeoArticleOptimizeRequest extends FormRequest
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
            "article_id" => "required|exists:articles,id",
        ];
    }

    public function messages()
    {
        return [
          "article_id.required" => "The article id is required.",
        ];
    }

    /**
     * @throws \JsonException
     */
    protected function failedValidation(Validator $validator)
    {

        $this->validationException($validator,"Failed to optimize article");
    }
}
