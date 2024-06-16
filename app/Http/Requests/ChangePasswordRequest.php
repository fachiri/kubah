<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'old_password' => 'required|current_password',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'old_password.required' => 'Password Lama wajib diisi.',
            'old_password.current_password' => 'Password Lama tidak valid.',
            'password.required' => 'Password Baru wajib diisi.',
            'password.string' => 'Password Baru harus berupa teks.',
            'password.min' => 'Password Baru harus memiliki minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ];
    }
}
