<?php

namespace App\Http\Requests\Admin\Page;

use App\Traits\Api\ApiResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class PageRequestForm extends FormRequest
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
            'title'            => ['required', 'unique:pages,title,'.$this->id],
            'content'          => ['required'],
            'meta_title'       => ['nullable'],
            'meta_image'       => ['sometimes', 'nullable'], 
            'meta_description' => ['nullable'],
            'is_active'        => ['nullable'], 
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
        $data["slug"] = slugMaker($this->title, true);

        return $data;
    }

    protected function failedValidation(Validator $validator)
    {
        $appStatic = appStatic();

        validationException(
            $this->sendResponse(
                $appStatic::VALIDATION_ERROR,
                localize("page Validation Error"),
                [], $validator->errors()
            )
        );
    }
}
