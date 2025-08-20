<?php

namespace App\Http\Requests\Admin\Template;

use Illuminate\Foundation\Http\FormRequest;

class TemplateContentRequest extends FormRequest
{
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
        $rules = [];
        if(templatesEngine() ==  appStatic()::ENGINE_OPEN_AI) {
            $rules = [
                "prompt"    => "required",
                "tone"      => "required",
                "language"  => "required|string",
            ];
        }
        $fields = json_decode($this->field_names);
        $fieldArray = str_replace(['{_', '_}'], '', $fields);
        if(!empty($fieldArray)) {
            foreach($fieldArray as $field) {
                $rules[$field]= ['required'];
            }
        }
        return $rules;

    }

    public function getData()
    {
        $title = localize('Untitled project').' '.date('Y-m-d');
        $data                 = $this->except(["_token"]);
        $data["slug"]         = slugMaker($title);
        $data['title']        = $title;
        $data['model_name']   = contentGeneratedModel();
        $data['content_type'] = appStatic()::PURPOSE_TEMPLATE_CONTENT;

        return $data;
    }
}
