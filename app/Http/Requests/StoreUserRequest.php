<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|regex:/^[\p{L}\s]+$/u',
            'surname' => 'nullable|regex:/^[\p{L}\s]+$/u',
            'password' => 'required|regex:/^(?=.*\d).{6,14}$/'
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'El :attribute es requerido.',
            'password.required' => 'La :attribute es requerida.',
            'password.regex' => 'Debe contener mínimo 6 caracteres, máximo 14 y al menos un número.'
        ];
    }
}
