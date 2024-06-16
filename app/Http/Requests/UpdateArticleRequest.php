<?php

namespace App\Http\Requests;

use App\Models\Article;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateArticleRequest extends FormRequest
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
            'image' => 'nullable',
        ];
    }

    protected function withValidator($validator)
    {
        $validator->sometimes('image', 'file|mimes:jpg,jpeg,png,webp|max:10240', function ($input) {
            return is_file($input->image);
        });

        $validator->after(function ($validator) {
            $slug = Str::slug($this->title);

            $articleId = $this->route('article')->id ?? null;

            $count = Article::where('slug', $slug)
                ->where('id', '!=', $articleId)
                ->count();

            if ($count > 0) {
                $validator->errors()->add('title', 'Judul ini sudah digunakan.');
            }
        });
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul harus diisi.',
            'title.string' => 'Judul harus berupa string.',
            'title.max' => 'Judul maksimal 255 karakter.',
            'content.required' => 'Konten harus diisi.',
            'content.string' => 'Konten harus berupa string.',
            'image.file' => 'Gambar harus berupa file.',
            'image.mimes' => 'Gambar harus berupa file dengan format jpg, jpeg, png atau webp.',
            'image.max' => 'Ukuran gambar maksimal 10MB.',
        ];
    }
}
