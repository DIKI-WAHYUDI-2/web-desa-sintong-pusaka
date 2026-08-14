<?php

namespace App\Http\Controllers;

use App\Http\Request\GaleriStoreRequest;
use App\Http\Request\GaleriUpdateRequest;
use App\Http\Services\GaleriService;
use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function __construct(protected GaleriService $galeriService)
    {
    }

    public function index(Request $request)
    {
        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
        ]);

        $galeri = $this->galeriService->index($validated['search'] ?? null);
        return view('admin.galeri.index', compact('galeri'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(GaleriStoreRequest $request)
    {
        $this->galeriService->store($request->validated(), $request->file('gambar'));
        return redirect()->route('galeri.index')->with('success', 'Foto berhasil ditambahkan.');
    }

    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.update', compact('galeri'));
    }

    public function update(GaleriUpdateRequest $request, Galeri $galeri)
    {
        $this->galeriService->update($galeri, $request->validated(), $request->file('gambar'));
        return redirect()->route('galeri.index')->with('success', 'Galeri berhasil diperbarui');
    }

    public function destroy(Galeri $galeri)
    {
        $this->galeriService->destroy($galeri);
        return redirect()->route('galeri.index')->with('success', 'Galeri berhasil dihapus');
    }


}
