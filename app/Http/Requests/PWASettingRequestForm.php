<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PWASettingRequestForm extends FormRequest
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
        return [
            'start_url'        => ['required'],
            'name'             => ['required'],
            'short_name'       => ['required'],
            'background_color' => ['required'],
            'theme_color'      => ['required'],
            'status_bar'       => ['required'],
            'icon_72'          => ['sometimes', 'nullable', 'mimes:png', 'dimensions:height=72, width=72'],
            'icon_96'          => ['sometimes', 'nullable', 'mimes:png', 'dimensions:height=96, width=96'],
            'icon_128'         => ['sometimes', 'nullable',  'mimes:png', 'dimensions:height=128, width=128'],
            'icon_144'         => ['sometimes', 'nullable',  'mimes:png', 'dimensions:height=144, width=144'],
            'icon_152'         => ['sometimes', 'nullable', 'mimes:png', 'dimensions:height=152, width=152'],
            'icon_192'         => ['sometimes', 'nullable', 'mimes:png', 'dimensions:height=192, width=192'],
            'icon_384'         => ['sometimes', 'nullable', 'mimes:png', 'dimensions:height=384, width=384'],
            'icon_512'         => ['sometimes', 'nullable',  'mimes:png', 'dimensions:height=512, width=512'],
            'icon_512'         => ['sometimes', 'nullable',  'mimes:png', 'dimensions:height=512, width=512'],
            'screenshot_540'   => ['sometimes', 'nullable',  'mimes:png', 'dimensions:height=540, width=720'],
            'screenshot_720'   => ['sometimes', 'nullable',  'mimes:png', 'dimensions:height=720, width=540'],
        ];
    }
}
