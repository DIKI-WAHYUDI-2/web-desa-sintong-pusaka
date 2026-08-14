<?php

namespace App\Http\Controllers;

use App\Http\Request\AparatDesaStoreRequest;
use App\Http\Request\AparatDesaUpdateRequest;
use App\Http\Services\AparatDesaService;
use App\Models\AparatDesa;
use Illuminate\Http\Request;

class AparatDesaController extends Controller
{
    public function __construct(
        protected AparatDesaService $aparatDesaService
    ) {

    }
    public function index(Request $request)
    {
        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
        ]);

        $aparat_desa = $this->aparatDesaService->index($validated['search'] ?? null);

        return view('admin.aparat-desa.index', compact('aparat_desa'));
    }

    public function create()
    {
        return view('admin.aparat-desa.create');
    }

    public function store(AparatDesaStoreRequest $request)
    {
        $this->aparatDesaService->store(
            data: $request->validated(),
            foto: $request->file('foto')
        );

        return redirect()->route('aparat_desa.index')->with('success', 'Data aparat desa berhasil ditambahkan.');
    }

    public function edit(AparatDesa $aparat_desa)
    {
        return view('admin.aparat-desa.update', compact('aparat_desa'));
    }

    public function update(AparatDesaUpdateRequest $request, AparatDesa $aparat_desa)
    {
        $this->aparatDesaService->update(
            aparat: $aparat_desa,
            data: $request->validated(),
            foto: $request->file('foto')
        );

        return redirect()->route('aparat_desa.index')->with('success', 'Data aparat desa berhasil diperbarui.');
    }


    public function destroy(AparatDesa $aparat_desa)
    {
        $this->aparatDesaService->destroy($aparat_desa);
        return back()->with('success', 'Data berhasil dihapus');
    }
}
