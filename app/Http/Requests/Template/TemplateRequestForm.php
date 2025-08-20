<?php

namespace App\Http\Requests\Template;

use App\Models\Template;
use App\Traits\Api\ApiResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class TemplateRequestForm extends FormRequest
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
            'template_name'        => "required|unique:templates,template_name,$this->id,id",
            'icon'                 => 'nullable|string',
            'template_category_id' => 'required|numeric',
            'description'          => 'nullable|string',
            'input_types'          => 'nullable|array',
            'input_names'          => 'nullable|array',
            'input_labels'         => 'nullable|array',
            'prompt'               => 'required|string',
            'is_active'            => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'template_name.required'        => 'The template name field is required.',
            'template_name.unique'          => 'The template name address is already in use.',
            'template_category_id.required' => 'The template category field is required.',
            'description.required'          => 'The template category field is string.',
            'input_types.array'             => 'The Input type must be an array.',
            'input_names.array'             => 'The Input name must be an array.',
            'input_labels.array'            => 'The Input label must be an array.',
            'prompt.required'               => 'The prompt field is required.',

        ];
    }
    public function attributes()
    {
        return [
            'template_category_id' => 'template category'
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        $appStatic = appStatic();

        validationException(
            $this->sendResponse(
                $appStatic::VALIDATION_ERROR,
                "Template Validation Error",
                [],
                $validator->errors()
            )
        );
    }

    public function getData()
    {
        $data           = $this->validated();
        $data["slug"]   = slugMaker($this->template_name);
        $data["fields"] = json_encode($this->fieldData());

        return $data;
    }
    private function fieldData()
    {
        $fields = [];
        foreach ($this->input_types as $key => $input_type) {          
            $field['label'] = $this->input_labels[$key];
            $field['is_required'] = true;
            $field['field']['name'] = $this->input_names[$key];
            $field['field']['type'] = $input_type;
            $field['field']['slug'] = slugMaker($this->input_names[$key], true, '_');
            array_push($fields, $field);
        }
        return $fields;
       
    }
}
