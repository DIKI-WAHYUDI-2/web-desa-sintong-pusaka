<?php

namespace App\Http\Controllers;

use App\Models\AparatDesa;
use Illuminate\Http\Request;

class AparatDesaController extends Controller
{
    public function index()
    {
        $aparat = AparatDesa::paginate(10);
        return view('admin.aparat', compact('aparat'));
    }

    public function create()
    {
        return view('admin.aparat-create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|max:2048',
            'mulai_jabatan' => 'required|date',
            'akhir_jabatan' => 'nullable|date|after_or_equal:mulai_jabatan',
            'status_aktif' => 'required|boolean',
        ]);

        AparatDesa::create([
            'nama' => $validated['nama'],
            'jabatan' => $validated['jabatan'],
            'foto' => $request->file('foto') ? $request->file('foto')->store('aparat_fotos', 'public') : null,
            'mulai_jabatan' => $validated['mulai_jabatan'],
            'akhir_jabatan' => $validated['akhir_jabatan'] ?? null,
            'status_aktif' => $validated['status_aktif'],
        ]);

        return redirect()->route('aparat')->with('success', 'Aparat Desa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $aparat = AparatDesa::findOrFail($id);
        return view('admin.aparat-create', compact('aparat'));
    }

    public function update(Request $request, $id)
    {
        $aparatDesa = AparatDesa::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'sometimes|required|string|max:255',
            'jabatan' => 'sometimes|required|string|max:255',
            'foto' => 'nullable|image|max:2048',
            'mulai_jabatan' => 'sometimes|required|date',
            'akhir_jabatan' => 'nullable|date|after_or_equal:mulai_jabatan',
            'status_aktif' => 'sometimes|required|boolean',
        ]);

        $aparatDesa->update([
            'nama' => $validated['nama'] ?? $aparatDesa->nama,
            'jabatan' => $validated['jabatan'] ?? $aparatDesa->jabatan,
            'foto' => $request->file('foto') ? $request->file('foto')->store('aparat_fotos', 'public') : $aparatDesa->foto,
            'mulai_jabatan' => $validated['mulai_jabatan'] ?? $aparatDesa->mulai_jabatan,
            'akhir_jabatan' => $validated['akhir_jabatan'] ?? $aparatDesa->akhir_jabatan,
            'status_aktif' => $validated['status_aktif'] ?? $aparatDesa->status_aktif,
        ]);

        return redirect()->route('aparat')->with('success', 'Aparat Desa berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $aparat = AparatDesa::findOrFail($id);
        $aparat->delete();
        return redirect()->route('aparat')->with('success', 'Aparat Desa berhasil dihapus.');
    }
}
