@extends('layouts.admin')

@section('title', 'Edit Galeri')
@section('page-title', 'Edit Gambar')
@section('page-subtitle', 'Perbarui data galeri')

@section('content')
    <div class="mx-auto max-w-5xl">
        <form id="editGaleriForm" action="{{ route('galeri.update', $galeri) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Form --}}
            <div class="admin-card rounded-3xl p-6">

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                    {{-- Judul --}}
                    <div class="space-y-2 md:col-span-2">
                        <label class="admin-label text-sm font-semibold">
                            Judul Album
                        </label>

                        <input type="text" name="judul" value="{{ old('judul', $galeri->judul) }}"
                            class="admin-input h-12 rounded-xl text-base" required>

                        @error('judul')
                            <p class="text-xs text-destructive">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Kategori --}}
                    <div class="space-y-2">
                        <label class="admin-label text-sm font-semibold">
                            Kategori Album
                        </label>

                        <select name="kategori" class="admin-input h-12 rounded-xl" required>
                            @foreach (['Politik', 'Ekonomi', 'Sosial', 'Budaya', 'Olahraga', 'Teknologi', 'Lingkungan'] as $kategori)
                                <option value="{{ $kategori }}"
                                    {{ old('kategori', $galeri->kategori) == $kategori ? 'selected' : '' }}>
                                    {{ $kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori')
                            <p class="text-xs text-destructive">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Organisasi --}}
                    <div class="space-y-2">
                        <label class="admin-label text-sm font-semibold">
                            Organisasi
                        </label>

                        <select name="organisasi" class="admin-input h-12 rounded-xl" required>
                            @foreach (['Kepenghuluan', 'Badan Usaha Milik Kepenghuluan', 'Badan Permusyawaratan Kepenghuluan', 'Lembaga Pemberdayaan Masyarakat', 'Karang Taruna', 'PKK', 'PKKBN'] as $organisasi)
                                <option value="{{ $organisasi }}"
                                    {{ old('organisasi', $galeri->organisasi) == $organisasi ? 'selected' : '' }}>
                                    {{ $organisasi }}
                                </option>
                            @endforeach
                        </select>
                        @error('organisasi')
                            <p class="text-xs text-destructive">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Gambar saat ini (semua foto, bukan cuma satu) --}}
                @if ($galeri->fotos->isNotEmpty())
                    <div class="mt-6 space-y-3"> <label class="admin-label text-sm font-semibold"> Gambar Saat Ini
                            ({{ $galeri->fotos->count() }}) </label>
                        <div class="grid grid-cols-3 gap-3 sm:grid-cols-4 md:grid-cols-6">
                            @foreach ($galeri->fotos as $foto)
                                <div class="relative aspect-square overflow-hidden rounded-xl border border-border"> <img
                                        src="{{ asset('storage/' . $foto->gambar) }}" alt="{{ $galeri->judul }}"
                                        class="h-full w-full object-cover"> </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Upload baru --}}
                <div class="mt-6 space-y-3">

                    <label class="admin-label text-sm font-semibold">
                        Tambah Gambar Baru
                    </label>

                    <label id="dropzone"
                        class="flex cursor-pointer flex-col items-center justify-center rounded-3xl border border-dashed border-border bg-muted/30 px-6 py-10 text-center transition hover:border-primary/40 hover:bg-primary/5">

                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-primary/10 text-primary">
                            <i data-lucide="upload" class="h-6 w-6"></i>
                        </div>

                        <p id="dropzone-title" class="mt-3 text-sm font-semibold text-foreground">
                            Upload gambar baru
                        </p>

                        <p id="dropzone-subtitle" class="mt-1 text-sm text-muted-foreground">
                            Kosongkan jika tidak ingin menambah gambar
                        </p>

                        <input id="gambar-input" type="file" name="gambar[]" multiple accept="image/*" class="hidden">
                    </label>

                    <div id="preview-grid" class="hidden grid grid-cols-3 gap-3 sm:grid-cols-4 md:grid-cols-6"></div>

                    @error('gambar')
                        <p class="text-xs text-destructive">{{ $message }}</p>
                    @enderror
                    @error('gambar.*')
                        <p class="text-xs text-destructive">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Action --}}
            <div class="flex flex-col gap-3 sm:flex-row sm:justify-between">

                <a href="{{ route('galeri.index') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-primary/25 transition hover:bg-primary/90">
                    <i data-lucide="arrow-left" class="mr-2 h-4 w-4"></i>
                    Kembali
                </a>

                <button id="updateGaleriBtn" type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-primary/25 transition hover:bg-primary/90 disabled:opacity-60 disabled:cursor-not-allowed">
                    <i id="updateGaleriIcon" data-lucide="save" class="h-4 w-4"></i>
                    <span id="updateGaleriText">Simpan Perubahan</span>
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        const editGaleriForm = document.getElementById('editGaleriForm');
        const updateGaleriBtn = document.getElementById('updateGaleriBtn');
        const updateGaleriText = document.getElementById('updateGaleriText');
        const updateGaleriIcon = document.getElementById('updateGaleriIcon');

        let galeriUpdating = false;

        editGaleriForm.addEventListener('submit', function(e) {

            if (galeriUpdating) {
                e.preventDefault();
                return;
            }

            galeriUpdating = true;

            updateGaleriBtn.disabled = true;
            updateGaleriBtn.classList.add('opacity-80', 'cursor-not-allowed');

            updateGaleriText.textContent = 'Menyimpan...';

            updateGaleriIcon.outerHTML = `
            <svg class="h-4 w-4 animate-spin" viewBox="0 0 24 24" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <circle class="opacity-25" cx="12" cy="12" r="10"
                        stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                      d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
            </svg>
        `;
        });
    </script>
    <script>
        const input = document.getElementById('gambar-input');
        const grid = document.getElementById('preview-grid');
        const title = document.getElementById('dropzone-title');
        const subtitle = document.getElementById('dropzone-subtitle');

        input.addEventListener('change', () => {
            const files = Array.from(input.files);

            grid.innerHTML = '';

            if (files.length === 0) {
                grid.classList.add('hidden');
                title.textContent = 'Upload gambar baru';
                subtitle.textContent = 'Kosongkan jika tidak ingin menambah gambar';
                return;
            }

            title.textContent = `${files.length} gambar baru dipilih`;
            subtitle.textContent = 'Klik lagi untuk mengganti pilihan';
            grid.classList.remove('hidden');

            files.forEach((file) => {
                const url = URL.createObjectURL(file);
                const wrapper = document.createElement('div');
                wrapper.className =
                    'relative aspect-square overflow-hidden rounded-xl border border-border';
                wrapper.innerHTML =
                    `<img src="${url}" class="h-full w-full object-cover" alt="${file.name}">`;
                grid.appendChild(wrapper);
            });
        });
    </script>
@endpush
