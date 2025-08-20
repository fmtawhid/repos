<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AiAvatarProRequest extends FormRequest
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
            "avatar_id"     => "required",
            "avatar_style"  => "required",
            "voice_id"      => "required",
            "matting"       => "required",
            "caption"       => "required",
            "script"        => "required",
        ];
    }
}
