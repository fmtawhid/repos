<?php

namespace App\Http\Requests\Admin\Support;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class ReplyTicketRequestForm extends FormRequest
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
        return [
            'ticket_id'   => ['required', 'integer'],
            'description' => ['required'],
            'files'       => ['sometimes', 'nullable', 'mimes:jpeg,jpg,png'],
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        $appStatic = appStatic();

        validationException(
            $this->sendResponse(
                $appStatic::VALIDATION_ERROR,
                localize("Ticket Reply Validation Error"),
                [], $validator->errors()
            )
        );
    }
}
