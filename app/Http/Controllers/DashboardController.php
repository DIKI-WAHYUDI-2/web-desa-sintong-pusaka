<?php

namespace App\Http\Controllers;

use App\Models\AparatDesa;
use App\Models\Berita;
use App\Models\Galeri;
use Illuminate\Support\Facades\DB;
use DateTime;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // Data berita per bulan
        $dataBerita = DB::table('berita')
            ->select(DB::raw('MONTH(created_at) as bulan'), DB::raw('COUNT(*) as total'))
            ->groupBy('bulan')
            ->get()
            ->pluck('total', 'bulan');

        $bulanBerita = [];
        $jumlahBerita = [];

        foreach (range(1, 12) as $b) {
            $bulanBerita[] = DateTime::createFromFormat('!m', $b)->format('M');
            $jumlahBerita[] = $dataBerita[$b] ?? 0;
        }

        // Data galeri per bulan
        $dataGaleri = DB::table('galeri')
            ->select(DB::raw('MONTH(created_at) as bulan'), DB::raw('COUNT(*) as total'))
            ->groupBy('bulan')
            ->get()
            ->pluck('total', 'bulan');

        $bulanGaleri = $bulanBerita; // menggunakan label bulan yang sama
        $jumlahGaleri = [];

        foreach (range(1, 12) as $b) {
            $jumlahGaleri[] = $dataGaleri[$b] ?? 0;
        }

        $totalBerita = Berita::count();
        $totalGaleri = Galeri::count();
        $totalAparat = AparatDesa::count();

        return view('admin.dashboard', compact('totalGaleri', 'totalAparat', 'bulanBerita', 'totalBerita', 'jumlahBerita', 'bulanGaleri', 'jumlahGaleri'));
    }
}