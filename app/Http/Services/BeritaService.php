<?php

namespace App\Http\Services;

use App\Models\Berita;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaService
{
    public function index(?string $keyword): LengthAwarePaginator
    {
        return Berita::query()
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('judul', 'like', '%' . $keyword . '%');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();
    }

    public function store(array $data): Berita
    {
        $data['slug'] = Str::slug($data['judul']);
        foreach (['gambar', 'gambar2', 'gambar3'] as $field) {
            if (isset($data[$field]) && $data[$field] instanceof UploadedFile) {
                $data[$field] = $data[$field]->store('berita_images', 'public');
            }
        }
        return Berita::create($data);
    }

    public function update(Berita $berita, array $data, array $images = []): Berita
    {
        $data['slug'] = Str::slug($data['judul']);
        foreach (['gambar', 'gambar2', 'gambar3'] as $field) {
            if (isset($images[$field]) && $images[$field] instanceof UploadedFile) {
                if ($berita->$field) {
                    Storage::disk('public')->delete($berita->$field);
                }
                $data[$field] = $images[$field]->store('berita_images', 'public');
            } else {
                $data[$field] = $berita->$field;
            }
        }
        $berita->update($data);
        return $berita->fresh();
    }

    public function destroy(Berita $berita): void
    {
        foreach (['gambar', 'gambar2', 'gambar3'] as $field) {
            if ($berita->$field) {
                Storage::disk('public')->delete($berita->$field);
            }
        }
        $berita->delete();
    }
    public function getDetailBySlug(string $slug): array
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();
        $beritaLain = Berita::where('id', '!=', $berita->id)->latest()->get();
        return ['berita' => $berita, 'beritaLain' => $beritaLain,];
    }

}
