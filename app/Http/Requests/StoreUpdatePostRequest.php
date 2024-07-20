<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class StoreUpdatePostRequest extends FormRequest
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
    public static function rules(): array
    {
        return [
            'imagesUrls' => 'required|array|max:5',
            // 'images.*' => [
            //     File::image()->min('10kb')->max('10mb'),
            // ],
            'name' => 'required|max:100|regex:/^[\p{L}\p{N}\sñÑáéíóúÁÉÍÓÚüÜ.,:;-_()]+$/u',
            'purpose' => 'required',
            'expected_item' => 'exclude_unless:purpose,i|required|max:100|regex:/^[\p{L}\p{N}\sñÑáéíóúÁÉÍÓÚüÜ.,:;-_()]+$/u',
            'description' => 'required|max:255|regex:/^[\p{L}\p{N}\sñÑáéíóúÁÉÍÓÚüÜ.,:;-_()]+$/u',
            'location_id' => 'required',
            'category_id' => 'required'
        ];
    }
}
