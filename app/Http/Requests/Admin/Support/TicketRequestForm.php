<?php

namespace App\Http\Requests\Admin\Support;

use App\Traits\Api\ApiResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class TicketRequestForm extends FormRequest
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
            "title"       => [ "required"],
            "priority_id" => ["required","numeric"],
            "category_id" => ["required","numeric"],
            "description" => ["required"],
            "files"       => ["nullable","array"],
//            "files.*"     => ["image", 'mimes: png,jpg,jpeg,webp,bimp,svg'],
        ];
    }

    public function attributes()
    {
        return [
            "is_active"   => "status",
            "priority_id" => "priority",
            "category_id" => "category",
        ];
    }

    public function getData()
    {
        $data              = $this->validated();
        $data["is_active"] = 1;
        $data["slug"]      = slugMaker($this->title);

        return $data;
    }

    protected function failedValidation(Validator $validator)
    {
        $appStatic = appStatic();

        validationException(
            $this->sendResponse(
                $appStatic::VALIDATION_ERROR,
                localize("Priority Validation Error"),
                [], $validator->errors()
            )
        );
    }
}