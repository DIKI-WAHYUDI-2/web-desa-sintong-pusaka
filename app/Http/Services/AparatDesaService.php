<?php

namespace App\Http\Services;

use App\Models\AparatDesa;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class AparatDesaService
{
    public function index(?string $keyword): LengthAwarePaginator
    {
        return AparatDesa::query()->when($keyword, function ($query) use ($keyword) {
            $query->where('nama', 'like', '%' . $keyword . '%');
        })
            ->orderByDesc('status_aktif')
            ->orderByRaw(" 
            CASE 
            WHEN LOWER(jabatan) IN ('penghulu', 'kepala desa', 'kades') 
            THEN 1 WHEN LOWER(jabatan) IN ('sekdes', 'sekretaris desa') 
            THEN 2 WHEN LOWER(jabatan) = 'kaur keuangan' 
            THEN 3 WHEN LOWER(jabatan) = 'kaur perencanaan' 
            THEN 4 WHEN LOWER(jabatan) = 'kasi pemerintahan' 
            THEN 5 WHEN LOWER(jabatan) = 'kasi pelayanan' 
            THEN 6 WHEN LOWER(jabatan) = 'kasi kesejahteraan' 
            THEN 7 WHEN LOWER(jabatan) LIKE 'kadus%' 
            THEN 8 ELSE 99 
            END ")
            ->orderBy('jabatan')->paginate(10)->withQueryString();
    }
    
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
