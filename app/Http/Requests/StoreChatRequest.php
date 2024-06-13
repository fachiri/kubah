<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChatRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'subject' => 'required|string|max:255',
            'is_anonim' => 'nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'subject.required' => 'Subjek harus diisi.',
            'subject.string' => 'Subjek harus berupa teks.',
            'subject.max' => 'Subjek tidak boleh lebih dari 255 karakter.',
        ];
    }
}
