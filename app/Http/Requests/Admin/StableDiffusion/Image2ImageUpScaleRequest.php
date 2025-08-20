<?php

namespace App\Http\Requests\Admin\StableDiffusion;

use App\Traits\Api\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class Image2ImageUpScaleRequest extends FormRequest
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
        wLog("SD i2i Upscale",["payloads"=>$this->request->all()], logService()::LOG_SD);

        return [
            "title"             => "required",
            "number_of_results" => "required|integer|between:1,10",
            "size"              => "nullable",
            "mood"              => "nullable",
            "style"             => "nullable",
            "lighting_style"    => "nullable",
            "content_purpose"   => "nullable",
            "image"             => "required|image|mimes:jpeg,png,webp|max:5250",
        ];
    }


    /**
     * @throws \JsonException
     */
    protected function failedValidation(Validator $validator)
    {
        return $this->validationException($validator, localize("Stable Diffusion Upscale Validation Error."));
    }
}
