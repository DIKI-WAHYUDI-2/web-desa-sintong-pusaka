<?php

namespace App\Http\Services;

use App\Models\AparatDesa;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class AparatDesaService
{
    public function store(array $data, ?UploadedFile $foto = null): AparatDesa
    {
        if ($foto) {
            $data['foto'] = $foto->store('aparat_fotos', 'public');
        }
        return AparatDesa::create($data);
    }

    public function update(AparatDesa $aparat, array $data, ?UploadedFile $foto = null): AparatDesa
    {
        if ($foto) {

            // hapus foto lama jika ada 
            if ($aparat->foto && Storage::disk('public')->exists($aparat->foto)) {
                Storage::disk('public')->delete($aparat->foto);
            }
            // simpan foto baru 
            $data['foto'] = $foto->store('aparat_fotos', 'public');
        }

        $aparat->update($data);
        return $aparat->fresh();
    }

    public function destroy(AparatDesa $aparat): bool
    {
        if ($aparat->foto && Storage::disk('public')->exists($aparat->foto)) {
            Storage::disk('public')->delete($aparat->foto);
        }
        return $aparat->delete();
    }

}
