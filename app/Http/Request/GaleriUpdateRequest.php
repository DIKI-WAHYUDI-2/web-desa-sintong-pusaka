<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class GaleriUpdateRequest extends FormRequest
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
            'judul' => ['required', 'string', 'max:255'],
            'kategori' => ['nullable', 'string', 'max:100'],
            'organisasi' => ['nullable', 'string', 'max:255'],
            'gambar' => ['nullable', 'array'],
            'gambar.*' => ['image', 'max:2048'],
        ];
    }
}
