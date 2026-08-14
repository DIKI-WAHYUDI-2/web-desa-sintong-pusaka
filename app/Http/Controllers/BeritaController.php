<?php

namespace App\Http\Controllers;
use App\Http\Request\BeritaStoreRequest;
use App\Http\Request\BeritaUpdateRequest;
use App\Http\Services\BeritaService;
use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function __construct(
        protected BeritaService $beritaService
    ) {
    }

    public function index(Request $request)
    {
        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
        ]);

        $berita = $this->beritaService->index($validated['search'] ?? null);

        return view('admin.berita.index', compact('berita'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(BeritaStoreRequest $request)
    {
        $this->beritaService->store($request->validated());
        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(Berita $berita)
    {
        return view('admin.berita.update', compact('berita'));
    }

    public function update(BeritaUpdateRequest $request, Berita $berita)
    {
        $this->beritaService->update(
            berita: $berita,
            data: $request->validated(),
            images: [
                'gambar' => $request->file('gambar'),
                'gambar2' => $request->file('gambar2'),
                'gambar3' => $request->file('gambar3'),
            ]
        );
        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $berita)
    {
        $this->beritaService->destroy($berita);

        return redirect()
            ->route('berita.index')
            ->with('success', 'Berita berhasil dihapus.');
    }

    public function show(string $slug)
    {
        $data = $this->beritaService->getDetailBySlug($slug);

        return view('components.detail-news', $data);
    }


}
