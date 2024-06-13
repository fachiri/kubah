<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAvatarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'avatar' => 'required|file|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }

    public function messages(): array
    {
        return [
            'avatar.required' => 'Avatar wajib diunggah.',
            'avatar.file' => 'Avatar harus berupa file.',
            'avatar.image' => 'Avatar harus berupa gambar.',
            'avatar.mimes' => 'Avatar harus berupa file dengan format: jpeg, png, jpg, gif.',
            'avatar.max' => 'Ukuran Avatar tidak boleh lebih dari 2MB.',
        ];
    }
}
