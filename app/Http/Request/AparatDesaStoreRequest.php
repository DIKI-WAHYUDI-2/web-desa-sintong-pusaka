<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class AparatDesaStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|max:2048',
            'mulai_jabatan' => 'required|date',
            'akhir_jabatan' => 'nullable|date|after_or_equal:mulai_jabatan',
            'status_aktif' => 'required|boolean',
        ];
    }
}
