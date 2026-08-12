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
    public function index()
    {
        $aparat = AparatDesa::paginate(10);
        return view('admin.aparat', compact('aparat'));
    }

    public function create()
    {
        return view('admin.aparat-create');
    }

    public function store(AparatDesaStoreRequest $request)
    {
        $this->aparatDesaService->store(
            $request->validated(),
            $request->file('foto')
        );

        return redirect()->route('aparat_desa.index')->with('success', 'Data aparat desa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $aparat = AparatDesa::findOrFail($id);
        return view('admin.aparat-create', compact('aparat'));
    }

    public function update(AparatDesaUpdateRequest $request, AparatDesa $aparatDesa)
    {
        $this->aparatDesaService->update(
            aparat: $aparatDesa,
            data: $request->validated(),
            foto: $request->file('foto')
        );

        return redirect()->route('aparat_desa.index')->with('success', 'Data aparat desa berhasil diperbarui.');
    }


    public function destroy(AparatDesa $aparatDesa)
    {
        $this->aparatDesaService->destroy($aparatDesa);
        return back()->with('success', 'Data berhasil dihapus');
    }
}
