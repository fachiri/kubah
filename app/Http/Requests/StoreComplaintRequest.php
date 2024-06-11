<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreComplaintRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'reporter_role' => 'required|string',
            'ktp' => 'required|file|mimes:jpeg,jpg,png|max:10240', // KTP max 10MB
            'category' => 'required|string',
            'description' => 'required|string',
            'location' => 'required|string',
            'incident_date' => 'required|date',
            'incident_time' => 'required|date_format:H:i',
            'evidences' => 'required|array',
            'evidences.*' => 'file|mimes:jpeg,jpg,png,webp,mpeg,wav,ogg,mp4,webm,pdf,zip,rar,tar,gz,7z|max:10240', // max 10MB per file
        ];
    }

    public function messages(): array
    {
        return [
            'reporter_role.required' => 'Status Pelapor wajib diisi.',
            'ktp.required' => 'KTP wajib diunggah.',
            'ktp.file' => 'KTP harus berupa file.',
            'ktp.mimes' => 'KTP harus berupa file bertipe: jpeg, jpg, png.',
            'ktp.max' => 'Ukuran file KTP maksimal 10MB.',
            'category.required' => 'Kategori wajib diisi.',
            'description.required' => 'Deskripsi kejadian wajib diisi.',
            'location.required' => 'Lokasi kejadian wajib diisi.',
            'incident_date.required' => 'Tanggal kejadian wajib diisi.',
            'incident_date.date' => 'Tanggal kejadian harus berupa tanggal yang valid.',
            'incident_time.required' => 'Waktu kejadian wajib diisi.',
            'incident_time.date_format' => 'Waktu kejadian harus dalam format HH:mm.',
            'evidences.required' => 'Bukti wajib diunggah.',
            'evidences.*.file' => 'Bukti harus berupa file.',
            'evidences.*.mimes' => 'Bukti harus berupa file bertipe: jpeg, jpg, png, webp, mpeg, wav, ogg, mp4, webm, pdf, zip, rar, tar, gz, 7z.',
            'evidences.*.max' => 'Ukuran setiap file bukti maksimal 10MB.',
        ];
    }
}
