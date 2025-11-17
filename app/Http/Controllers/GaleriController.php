<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\GaleriFoto;
use Illuminate\Http\Request;
use Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $galeri = Galeri::with(relations: 'fotos')->get();
        return view('admin.galeri', compact('galeri'));
    }

    public function create()
    {
        $kategori = ['Politik', 'Ekonomi', 'Sosial', 'Budaya', 'Olahraga', 'Teknologi', 'Lingkungan'];
        $organisasi = ['Kepenghuluan', 'Badan Usaha Milik Kepenghuluan', 'Badan Permusyawaratan Kepenghuluan', 'Lembaga Pemberdayaan Masyarakat', 'Karang Taruna', 'PKK', 'PKKBN'];
        return view('admin.galeri-create', compact('kategori', 'organisasi'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'organisasi' => 'nullable|string|max:255',
        ]);

        // Simpan data ke database
        $galeri = Galeri::create([
            'judul' => $validated['judul'],
            'kategori' => $validated['kategori'] ?? null,
            'organisasi' => $validated['organisasi'] ?? null,
        ]);

        if ($galeri && $galeri->id) {
            foreach ($request->file('gambar') as $file) {
                $path = $file->store('galeri_images', 'public');
                GaleriFoto::create([
                    'galeri_id' => $galeri->id,
                    'gambar' => $path,
                ]);
            }
        }

        return redirect()->route('galeri')->with('success', 'Foto berhasil ditambahkan.');
    }

    public function edit($id)
    {
        // Cari galeri berdasarkan ID
        $galeri = Galeri::findOrFail($id);
        $kategori = ['Politik', 'Ekonomi', 'Sosial', 'Budaya', 'Olahraga', 'Teknologi', 'Lingkungan'];
        $organisasi = ['Kepenghuluan', 'Badan Usaha Milik Kepenghuluan', 'Badan Permusyawaratan Kepenghuluan', 'Lembaga Pemberdayaan Masyarakat', 'Karang Taruna', 'PKK', 'PKKBN'];
        return view('admin.galeri-create', compact('galeri', 'kategori', 'organisasi'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'organisasi' => 'nullable|string|max:255',
        ]);

        $galeri->update($validated);

        // Jika upload foto baru → simpan ke galeri_fotos
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $path = $file->store('galeri_images', 'public');
                $galeri->fotos()->create(['gambar' => $path]);
            }
        }

        return redirect()->route('galeri')->with('success', 'Galeri berhasil diperbarui');
    }


    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);

        // Hapus semua foto fisik
        foreach ($galeri->fotos as $foto) {
            if ($foto->gambar && Storage::disk('public')->exists($foto->gambar)) {
                Storage::disk('public')->delete($foto->gambar);
            }
            $foto->delete();
        }

        // Hapus galeri utama
        $galeri->delete();

        return redirect()->route('galeri')->with('success', 'Galeri berhasil dihapus');
    }


}
