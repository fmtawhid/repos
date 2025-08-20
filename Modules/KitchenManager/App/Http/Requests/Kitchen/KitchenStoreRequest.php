<?php

namespace Modules\KitchenManager\App\Http\Requests\Kitchen;

use App\Traits\Api\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KitchenStoreRequest extends FormRequest
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
            "name"      => "required|string",
            "branch_id" => "required",
            'is_active' => 'required|numeric',
        ];
    }


    /**
     * @throws \JsonException
     */
    protected function failedValidation(Validator $validator): void
    {

        $this->validationException($validator,"Kitchen Store Validation failed");
    }


    public function getValidatedData() {

        $data              = $this->validated();
        $data["is_active"] = setActiveStatus();
        return $data;
    }
}
