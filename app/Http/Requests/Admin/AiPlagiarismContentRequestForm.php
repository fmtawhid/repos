<?php

namespace App\Http\Requests\Admin;

use App\Traits\Api\ApiResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class AiPlagiarismContentRequestForm extends FormRequest
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
            "title"             => ["required"],
            "content_purpose"   => ["required"],
            "text"              => ["required"],
        ];
    }

    public function getData()
    {
        $data         = $this->validated();
        $data["slug"] = slugMaker($this->title);

        return $data;
    }

    protected function failedValidation(Validator $validator)
    {
        $appStatic = appStatic();

        validationException(
            $this->sendResponse(
                $appStatic::VALIDATION_ERROR,
                localize("Plagiarism Content Validation Error"),
                [], $validator->errors()
            )
        );
    }
}
