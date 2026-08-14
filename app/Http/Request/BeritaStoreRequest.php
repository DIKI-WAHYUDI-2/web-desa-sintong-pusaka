<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class BeritaStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'judul' => ['required', 'string', 'max:255'],
            'isi' => ['required', 'string'],
            'tanggal' => ['required', 'date'],
            'kategori' => ['required', 'string', 'max:100'],
            'organisasi' => ['required', 'string', 'max:100'],
            'gambar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'gambar2' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'gambar3' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }
}
