<?php

namespace App\Http\Controllers;

use App\Models\AparatDesa;
use App\Models\Berita;
use App\Models\Demografis;
use App\Models\Galeri;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $organisasi = [
            'Kepenghuluan',
            'Badan Usaha Milik Kepenghuluan',
            'Badan Permusyawaratan Kepenghuluan',
            'Lembaga Pemberdayaan Masyarakat',
            'Karang Taruna',
            'PKK',
            'PKKBN'
        ];

        $queryBase = Berita::query();

        if ($request->has('organisasi')) {
            $queryBase->where('organisasi', $request->organisasi);
        }

        // Berita utama
        $berita = $queryBase->orderBy('created_at', 'desc')->first();

        // Query kedua
        $queryBase2 = Berita::query();

        if ($request->has('organisasi')) {
            $queryBase2->where('organisasi', $request->organisasi);
        }

        $beritaLain = $queryBase2
            ->orderBy('created_at', 'desc')
            ->skip(1)
            ->take(PHP_INT_MAX)
            ->get();

        $aparat = AparatDesa::orderByRaw("
            CASE 
                WHEN jabatan = 'Pj. Penghulu' THEN 1
                WHEN jabatan = 'Sekdes' THEN 2
                WHEN jabatan = 'Kaur Keuangan' THEN 3
                WHEN jabatan = 'Kaur Perencanaan' THEN 4
                WHEN jabatan = 'Kaur Umum' THEN 5
                WHEN jabatan = 'Kasi Pemerintahan' THEN 6
                WHEN jabatan = 'Kasi Kesejahteraan' THEN 7
                WHEN jabatan = 'Kasi Pelayanan' THEN 8
                WHEN jabatan = 'Kadus Pusako' THEN 9
                WHEN jabatan = 'Kadus Pematang Mutun' THEN 10
                WHEN jabatan = 'Kadus Pagar Harapan' THEN 11
                WHEN jabatan = 'Kadus Pusaka Ujung' THEN 12
                ELSE 5
            END
        ")->get();


        // Kategori bisa di-hardcode juga
        $categories = ['Politik', 'Ekonomi', 'Sosial', 'Budaya', 'Olahraga', 'Teknologi', 'Lingkungan'];

        // Ambil galeri dan ubah format agar siap dipakai Alpine.js
        $queryGaleri = Galeri::query();
        if ($request->has('galeri_organisasi')) {
            $queryGaleri->where('organisasi', $request->galeri_organisasi);
        }
        $galeri = $queryGaleri->with('fotos')->get();

        $demografis = Demografis::first();
        $data = [
            ['label' => 'Jumlah Dusun', 'value' => $demografis->jumlah_dusun],
            ['label' => 'Jumlah RW', 'value' => $demografis->jumlah_rw],
            ['label' => 'Jumlah RT', 'value' => $demografis->jumlah_rt],
            ['label' => 'Jumlah Keluarga', 'value' => $demografis->jumlah_keluarga],
            ['label' => 'Jumlah Penduduk', 'value' => $demografis->jumlah_penduduk],
            ['label' => 'Kepadatan Penduduk', 'value' => $demografis->kepadatan_penduduk],
            ['label' => 'Jumlah Laki-laki', 'value' => $demografis->jumlah_laki_laki],
            ['label' => 'Jumlah Perempuan', 'value' => $demografis->jumlah_perempuan],
            ['label' => 'Luas Perkebunan Sawit', 'value' => $demografis->luas_perkebunan_sawit],
        ];

        return view('home', compact('berita', 'data', 'demografis', 'beritaLain', 'aparat', 'galeri', 'categories', 'organisasi'));
    }
}
