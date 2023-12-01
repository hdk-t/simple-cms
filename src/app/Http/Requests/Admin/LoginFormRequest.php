<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LoginFormRequest extends FormRequest
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
            'password' => 'required|is_login_success',
        ];
    }
    
    /**
     * Custom varidation messages
     */
    public function messages(): array
    {
        return [
            'password.required'         => 'パスワードは、必須です。',
            'password.is_login_success' => 'パスワードが一致しません。',
        ];
    }
}
