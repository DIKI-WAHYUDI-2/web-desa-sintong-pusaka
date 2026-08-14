<?php

namespace App\Http\Services;

use App\Models\Galeri;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class GaleriService
{
    public function index(?string $keyword): LengthAwarePaginator
    {
        return Galeri::query()
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('judul', 'like', '%' . $keyword . '%');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();
    }

    public function store(array $validated, array $files): Galeri
    {
        $galeri = Galeri::create([
            'judul' => $validated['judul'],
            'kategori' => $validated['kategori'] ?? null,
            'organisasi' => $validated['organisasi'] ?? null,
        ]);

        $this->simpanFoto($galeri, $files);

        return $galeri;
    }

    public function update(Galeri $galeri, array $validated, ?array $files): Galeri
    {
        $galeri->update([
            'judul' => $validated['judul'],
            'kategori' => $validated['kategori'] ?? null,
            'organisasi' => $validated['organisasi'] ?? null,
        ]);

        if ($files) {
            $this->simpanFoto($galeri, $files);
        }

        return $galeri;
    }

    public function destroy(Galeri $galeri): void
    {
        foreach ($galeri->fotos as $foto) {
            if ($foto->gambar && Storage::disk('public')->exists($foto->gambar)) {
                Storage::disk('public')->delete($foto->gambar);
            }
            $foto->delete();
        }

        $galeri->delete();
    }

    private function simpanFoto(Galeri $galeri, array $files): void
    {
        foreach ($files as $file) {
            $path = $file->store('galeri_images', 'public');
            $galeri->fotos()->create(['gambar' => $path]);
        }
    }
}
