<?php

namespace App\Http\Requests\Admin\Image;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class PhotoStudioRequest extends FormRequest
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
        $appStatic = appStatic();

        $replaceBackground = $appStatic::PHOTO_STUDIO_REPLACE_BACKGROUND;
        $sketchToImage     = $appStatic::PHOTO_STUDIO_SKETCH_TO_IMAGE;
        $text2Image        = $appStatic::PHOTO_STUDIO_TEXT_TO_IMAGE;
        $upscale           = $appStatic::PHOTO_STUDIO_UPSCALE;

        return [
            "action"        => "required|numeric|in:1,2,3,4,5,6",
            "image_file"    => "required_unless:action,{$text2Image}|image|mimes:jpeg,png,webp|max:5250",
            "prompt"        => "nullable|string|required_if:action,{$replaceBackground},{$sketchToImage},{$text2Image}",
            "target_width"  => "nullable|numeric|required_if:action,{$upscale}",
            "target_height" => "nullable|numeric|required_if:action,{$upscale}",
        ];
    }

    public function messages(): array
    {
        return [
            "action.required"            => "Please select an action.",
            "action.in"                  => "Invalid action selected.",
            "image_file.required_unless" => "Please select an image file.(Extension : jpeg, png, webp)",
            "image_file.image"           => "The selected image file is not a valid image.",
            "image_file.mimes"           => "The selected image file must be a file of type: jpeg, png, webp.",
            "image_file.max"             => "The selected image file must not be greater than 5,250 kilobytes.",
            "prompt.required_if"         => "Please enter a prompt.",
            "target_width.required_if"   => "Please enter a target width.",
            "target_width.numeric"       => "The target width must be a number.",
            "target_height.required_if"  => "Please enter a target height.",
            "target_height.numeric"      => "The target height must be a number.",
        ];
    }
}
