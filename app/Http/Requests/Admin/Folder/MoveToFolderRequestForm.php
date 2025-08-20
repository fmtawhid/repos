<?php

namespace App\Http\Requests\Admin\Folder;

use App\Traits\Api\ApiResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class MoveToFolderRequestForm extends FormRequest
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
            "id"    => ["bail","required"],
            "model" => ["required","string"],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $appStatic = appStatic();
        validationException(
            $this->sendResponse(
                $appStatic::VALIDATION_ERROR,
                localize("Folder Move Validation Error"),
                [], $validator->errors()
            )
        );
    }
}