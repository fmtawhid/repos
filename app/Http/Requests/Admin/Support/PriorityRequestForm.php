<?php

namespace App\Http\Requests\Admin\Support;

use App\Traits\Api\ApiResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class PriorityRequestForm extends FormRequest
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
            "name"       => ["bail","required","string","max: 255", 'unique:support_priorities,name,'.$this->id],
            "is_active"  => ["required","numeric"],
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
        $data         = $this->validated();
        $data["slug"] = slugMaker($this->name);

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
