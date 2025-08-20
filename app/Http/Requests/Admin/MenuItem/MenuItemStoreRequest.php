<?php

namespace App\Http\Requests\Admin\MenuItem;

use App\Traits\Api\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Foundation\Http\FormRequest;

class MenuItemStoreRequest extends FormRequest
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
            "name"             => "required|string",
            "description"      => "nullable|string",
            "media_manager_id" => "nullable|numeric",
            "menu_id"          => "required|numeric",
            "item_category_id" => "required|numeric",
            "preparation_time" => "nullable|numeric",

            // for variations
            "variation_titles" => "array",
            "variation_titles.*" => "required",
            "variation_prices" => "array",
            "variation_prices.*" => "required",

            // for addons
            "addon_titles" => "nullable|array",
            "addon_titles.*" => "required",
            "addon_prices" => "nullable|array",
            "addon_prices.*" => "required",

            // variation ids
            "variation_ids"   => "nullable|array",

            // common
            'is_active'        => 'numeric',
        ];
    }

    public function getValidatedData() {
        $data              = $this->validated();
        $data["is_active"] = setActiveStatus();

        return $data;
    }

    /**
     * @throws \JsonException
     */
    protected function failedValidation(Validator $validator): void
    {
        $this->validationException($validator, localize("Menu Items Store Validation failed"));
    }

}
