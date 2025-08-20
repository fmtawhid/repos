<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ContentBalanceUpdateRequest extends FormRequest
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
        info("Incoming Balance : ".json_encode($this->request->all()));
        return [
            "calculation_type" => "required|in:articles,chat,image,generateText,vision,pdf,templateContents",
            "platform"         => "required|in:openai,azure,googleTTS,elevenLabs,geminiai",
        ];
    }
}
