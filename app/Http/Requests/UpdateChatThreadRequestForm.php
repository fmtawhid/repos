<?php

namespace App\Http\Requests;

use App\Traits\Api\ApiResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class UpdateChatThreadRequestForm extends FormRequest
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
         $rules = [
            "title"        => "required|string",
            "chat_thread_id" => "required|exists:chat_threads,id",
        ];

        return $rules;
    }

    public function getData()
    {
        $data = $this->validated();
        $data["title"] = "untitled-conversation";
        $data["type"] = "chat";
        return $data;
    }

    protected function failedValidation(Validator $validator)
    {
        validationException(
            $this->sendResponse(
                appStatic()::VALIDATION_ERROR,
                localize("Validation error"),
                [],
                $validator->errors()
            )
        );
    }

}

