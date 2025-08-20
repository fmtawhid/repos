<?php

namespace App\Http\Requests\Admin\Template;

use Illuminate\Validation\Rule;
use App\Traits\Api\ApiResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class TemplateCategoryStoreRequestForm extends FormRequest
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
            "category_name" => ["bail","required","unique:template_categories,category_name", "string","max:255"],
            "icon"          => "nullable|string",
            "is_active"     => "required|numeric",
        ];
    }


    public function attributes()
    {
        return [         
            "is_active"     => "Status",
        ];
    }

    public function getData()
    {
        $data = $this->validated();
        $data["slug"] = slugMaker($this->category_name);
        
        return $data;
    }

    protected function failedValidation(Validator $validator)
    {
        $appStatic = appStatic();

        validationException(
            $this->sendResponse(
                $appStatic::VALIDATION_ERROR,
                "Template Category Validation Error",
                [], $validator->errors()
            )
        );
    }
}