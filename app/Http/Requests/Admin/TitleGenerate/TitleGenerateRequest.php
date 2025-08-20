<?php

namespace App\Http\Requests\Admin\TitleGenerate;

use Illuminate\Foundation\Http\FormRequest;

class TitleGenerateRequest extends FormRequest
{
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
            "topic"             => "required|string",
            "mainKeywords"      => "required|string",
            "contentKeywords"   => "nullable|string",
            "number_of_results" => "required|min:1",
            "lang"              => "required|string",
            "article_id"        => "required|exists:articles,id",
            "content_purpose"   => "required|in:".contentPurposeInside(),
        ];
    }
}
