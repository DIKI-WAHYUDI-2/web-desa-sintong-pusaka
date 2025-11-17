<?php

namespace App\Http\Controllers;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::all();
        return view('admin.berita', compact('berita'));
    }

    public function create()
    {
        $kategori = ['Politik', 'Ekonomi', 'Sosial', 'Budaya', 'Olahraga', 'Teknologi', 'Lingkungan'];
        $organisasi = ['Kepenghuluan', 'Badan Usaha Milik Kepenghuluan', 'Badan Permusyawaratan Kepenghuluan', 'Lembaga Pemberdayaan Masyarakat', 'Karang Taruna', 'PKK', 'PKKBN'];
        return view('admin.berita-create', compact('kategori', 'organisasi'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gambar2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gambar3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal' => 'required|date',
            'kategori' => 'required|string|max:100',
            'organisasi' => 'required|string|max:100',
        ]);

        // Tambahkan slug dari judul
        $validatedData['slug'] = Str::slug($validatedData['judul']);

        // Folder tujuan upload di hosting
        $targetPath = base_path('uploads/berita_images');

        // Handle upload 3 gambar
        foreach (['gambar', 'gambar2', 'gambar3'] as $field) {
            if ($request->hasFile($field)) {
                $namaFile = time() . '_' . $request->file($field)->getClientOriginalName();

                // Pindahkan file
                $request->file($field)->move($targetPath, $namaFile);

                // Simpan path untuk DB
                $validatedData[$field] = '/uploads/berita_images/' . $namaFile;
            }
        }

        // Simpan ke database
        Berita::create($validatedData);

        return redirect()->route('berita')->with('success', 'Berita berhasil ditambahkan.');
    }


    public function edit($id)
    {
        // Cari berita berdasarkan ID
        $berita = Berita::findOrFail($id);
        $kategori = ['Politik', 'Ekonomi', 'Sosial', 'Budaya', 'Olahraga', 'Teknologi', 'Lingkungan'];
        $organisasi = ['Kepenghuluan', 'Badan Usaha Milik Kepenghuluan', 'Badan Permusyawaratan Kepenghuluan', 'Lembaga Pemberdayaan Masyarakat', 'Karang Taruna', 'PKK', 'PKKBN'];
        return view('admin.berita-create', compact('berita', 'kategori', 'organisasi'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gambar2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gambar3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal' => 'required|date',
            'kategori' => 'required|string|max:100',
            'organisasi' => 'required|string|max:100',
        ]);

        // Cari berita berdasarkan ID
        $berita = Berita::findOrFail($id);

        // Siapkan data awal
        $data = $validatedData;

        // Folder tujuan upload
        $targetPath = base_path('uploads/berita_images');
        if (!file_exists($targetPath)) {
            mkdir($targetPath, 0755, true);
        }

        // Handle update gambar (hanya ganti kalau ada upload baru)
        foreach (['gambar', 'gambar2', 'gambar3'] as $field) {
            if ($request->hasFile($field)) {
                // Hapus gambar lama (jika ada & file memang eksis)
                if ($berita->$field && file_exists(public_path($berita->$field))) {
                    unlink(public_path($berita->$field));
                }

                // Upload gambar baru
                $namaFile = time() . '_' . $request->file($field)->getClientOriginalName();
                $request->file($field)->move($targetPath, $namaFile);

                // Simpan path ke DB
                $data[$field] = '/uploads/berita_images/' . $namaFile;
            } else {
                // Kalau tidak ada upload baru, tetap pakai gambar lama
                $data[$field] = $berita->$field;
            }
        }

        // Update berita
        $berita->update($data);

        return redirect()->route('berita')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Cari berita berdasarkan ID
        $berita = Berita::findOrFail($id);

        // Hapus data dari database
        $berita->delete();

        return redirect()->route('berita')->with('success', 'Berita berhasil dihapus.');
    }

    public function show($slug)
    {
        // Ambil berita sesuai slug
        $berita = Berita::where('slug', $slug)->firstOrFail();

        // Ambil berita lain untuk ditampilkan di bawah
        $beritaLain = Berita::where('id', '!=', $berita->id)
            ->take(PHP_INT_MAX)
            ->get();

        return view('components.detail-news', compact('berita', 'beritaLain'));
    }


}
