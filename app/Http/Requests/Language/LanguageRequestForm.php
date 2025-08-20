<?php

namespace App\Http\Requests\Language;

use App\Traits\Api\ApiResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class LanguageRequestForm extends FormRequest
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
            'name'   => ['required'],
            'code'   => ['required', 'unique:languages,code,'.$this->id],
            'flag'   => ['required'],
            'is_rtl' => ['required'],       
            'is_active_for_templates' => ['required'],       

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
                localize("Language Validation Error"),
                [], $validator->errors()
            )
        );
    }
}
