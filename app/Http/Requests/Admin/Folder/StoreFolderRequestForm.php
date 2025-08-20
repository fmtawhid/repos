<?php

namespace App\Http\Requests\Admin\Folder;

use Illuminate\Validation\Rule;
use App\Traits\Api\ApiResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class StoreFolderRequestForm extends FormRequest
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
            "folder_name" => ["bail","required","string","max:255",  Rule::unique('folders', 'folder_name')->where('created_by_id', userId())->whereNull('deleted_at')->ignore($this->id)],
            "icon"        => ["nullable","string"],
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
        $data              = $this->validated();
        $data['is_active'] = 1;
        $data["slug"]      = slugMaker($this->folder_name);

        return $data;
    }

    protected function failedValidation(Validator $validator)
    {
        $appStatic = appStatic();

        validationException(
            $this->sendResponse(
                $appStatic::VALIDATION_ERROR,
                localize("Folder Validation Error"),
                [], $validator->errors()
            )
        );
    }
}
