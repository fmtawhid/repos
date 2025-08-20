<?php

namespace App\Http\Requests\Currency;

use App\Traits\Api\ApiResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class CurrencyRequestForm extends FormRequest
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
            'name'      => ['required'],
            'symbol'    => ['required'],       
            'code'      => ['required', 'unique:currencies,code,'.$this->id],
            'rate'      => ['required'],
            'alignment' => ['required'],       
            'is_active' => ['required'],       

        ];
    }
    public function getData()
    {
        $data = $this->validated();
        return $data;
    }

    /**
     * @throws \JsonException
     */
    protected function failedValidation(Validator $validator)
    {

        $this->validationException($validator,"Currency Store Validation Error");
    }
}
