<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewPasswordRequest extends FormRequest
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
            'password' => 'required|confirmed|regex:/^(?=.*[a-zA-Z])(?=.*\d).{6,16}$/',
            'password_confirmation' => 'required'
        ];
    }

    public function messages() : array
    {
        return [
            'password.required' => 'La :attribute es requerida.',
            'password_confirmation.required' => 'La :attribute es requerida.',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'password.regex' => 'Debe contener mínimo 6 y máximo 16 caracteres, números, letras y/o carácteres especiales.'
        ];
    }
}
