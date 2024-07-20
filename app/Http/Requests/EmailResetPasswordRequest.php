<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailResetPasswordRequest extends FormRequest
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
            'email' => 'required|email|exists:App\Models\User,email',
        ];
    }

    public function messages() : array
    {
        return [
            'email.required' => 'El :attribute es requerido.',
            'email.exists' => 'El :attribute no se está registrado.'
        ];
    }
}
