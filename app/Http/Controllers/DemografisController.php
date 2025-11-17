<?php

namespace App\Http\Controllers;

use App\Models\Demografis;
use Illuminate\Http\Request;

class DemografisController extends Controller
{
    public function index()
    {
        $demografis = Demografis::first();
        return view('admin.demografis', compact('demografis'));
    }

    public function update(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'jumlah_dusun' => 'required|integer|min:0',
            'jumlah_rw' => 'required|integer|min:0',
            'jumlah_rt' => 'required|integer|min:0',
            'jumlah_keluarga' => 'required|integer|min:0',
            'jumlah_penduduk' => 'required|integer|min:0',
            'kepadatan_penduduk' => 'required|numeric|min:0',
            'jumlah_laki_laki' => 'required|integer|min:0',
            'jumlah_perempuan' => 'required|integer|min:0',
            'luas_perkebunan_sawit' => 'required|numeric|min:0',
        ]);

        // Simpan atau perbarui data demografis
        $demografis = Demografis::first();
        if ($demografis) {
            $demografis->update($validatedData);
        } else {
            Demografis::create($validatedData);
        }

        return redirect()->route('demografis')->with('success', 'Data demografis berhasil diperbarui.');
    }
}
