<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'required|file|mimes:jpg,jpeg,png,webp|max:10240',
        ];
    }

    public function messages(): array
{
    return [
        'title.required' => 'Judul harus diisi.',
        'title.string' => 'Judul harus berupa string.',
        'title.max' => 'Judul maksimal 255 karakter.',
        'content.required' => 'Konten harus diisi.',
        'content.string' => 'Konten harus berupa string.',
        'image.required' => 'Gambar harus diisi.',
        'image.file' => 'Gambar harus berupa file.',
        'image.mimes' => 'Gambar harus berupa file dengan format jpg, jpeg, png atau webp.',
        'image.max' => 'Ukuran gambar maksimal 10MB.',
    ];
}
}
