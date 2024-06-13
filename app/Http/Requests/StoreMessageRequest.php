<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'message' => 'required',
            'chat_id' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'message.required' => 'Tulis pesan.',
        ];
    }
}
