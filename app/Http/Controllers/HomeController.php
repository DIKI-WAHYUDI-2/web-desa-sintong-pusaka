<?php

namespace App\Http\Controllers;

use App\Models\AparatDesa;
use App\Models\Berita;
use App\Models\Demografis;
use App\Models\GaleriFoto;
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

        $selectedBeritaOrg = $request->organisasi ?? 'Kepenghuluan';

        $queryBerita = Berita::query()->latest();

        // Filter organisasi
        if ($selectedBeritaOrg !== 'Kepenghuluan') {
            $queryBerita->where('organisasi', $selectedBeritaOrg);
        }

        // 9 berita per halaman
        $beritas = $queryBerita
            ->paginate(9)
            ->withQueryString();

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

        // Galeri dipaginate per-foto (bukan per-album) supaya tetap enteng walau datanya banyak
        $selectedGaleriOrg = $request->galeri_organisasi ?? 'Kepenghuluan';

        $queryGaleriFoto = GaleriFoto::with('galeri')->latest('id');

        if ($selectedGaleriOrg !== 'Kepenghuluan') {
            $queryGaleriFoto->whereHas('galeri', function ($q) use ($selectedGaleriOrg) {
                $q->where('organisasi', $selectedGaleriOrg);
            });
        }

        $galeriFotos = $queryGaleriFoto
            ->paginate(12)
            ->withQueryString();

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

        return view('home', compact(
            'beritas',
            'selectedBeritaOrg',
            'data',
            'demografis',
            'aparat',
            'galeriFotos',
            'selectedGaleriOrg',
            'categories',
            'organisasi'
        ));
    }
}
