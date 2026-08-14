@extends('layouts.admin')

@section('title', 'Edit Berita')
@section('page-title', 'Edit Berita')
@section('page-subtitle', 'Perbarui data berita')

@section('content')
    <form id="editBeritaForm" action="{{ route('berita.update', $berita) }}" method="POST" enctype="multipart/form-data"
        class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Layout utama --}}
        <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">

            {{-- Kolom kiri --}}
            <div class="space-y-6 xl:col-span-2">

                {{-- Informasi utama --}}
                <div class="admin-card rounded-3xl p-6">
                    <div class="mb-6 flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-foreground">Informasi Utama</h3>
                            <p class="text-sm text-muted-foreground">Data dasar berita</p>
                        </div>

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary/10 text-primary">
                            <i data-lucide="file-text" class="h-5 w-5"></i>
                        </div>
                    </div>

                    <div class="space-y-5">

                        {{-- Judul --}}
                        <div class="space-y-2">
                            <label class="admin-label text-sm font-semibold">
                                Judul Berita
                            </label>

                            <input type="text" name="judul" value="{{ old('judul', $berita->judul) }}"
                                class="admin-input h-12 rounded-xl text-base"
                                placeholder="Masukkan judul berita yang jelas dan informatif">

                            @error('judul')
                                <p class="text-xs text-destructive">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Kategori & Tanggal --}}
                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                            <div class="space-y-2">
                                <label class="admin-label text-sm font-semibold">Kategori</label>

                                <select name="kategori" class="admin-input h-12 rounded-xl">
                                    @foreach (['Politik', 'Ekonomi', 'Sosial', 'Budaya', 'Olahraga', 'Teknologi', 'Lingkungan'] as $kategori)
                                        <option value="{{ $kategori }}"
                                            {{ old('kategori', $berita->kategori) == $kategori ? 'selected' : '' }}>
                                            {{ $kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="space-y-2">
                                <label class="admin-label text-sm font-semibold">Tanggal Publikasi</label>

                                <input type="date" name="tanggal" value="{{ old('tanggal', $berita->tanggal) }}"
                                    class="admin-input h-12 rounded-xl">
                            </div>
                        </div>

                        {{-- Organisasi --}}
                        <div class="space-y-2">
                            <label class="admin-label text-sm font-semibold">Organisasi</label>

                            <select name="organisasi" class="admin-input h-12 rounded-xl">
                                @foreach (['Kepenghuluan', 'Badan Usaha Milik Kepenghuluan', 'Badan Permusyawaratan Kepenghuluan', 'Lembaga Pemberdayaan Masyarakat', 'Karang Taruna', 'PKK', 'PKKBN'] as $organisasi)
                                    <option value="{{ $organisasi }}"
                                        {{ old('organisasi', $berita->organisasi) == $organisasi ? 'selected' : '' }}>
                                        {{ $organisasi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Isi berita --}}
                <div class="admin-card rounded-3xl p-6">

                    <div class="mb-4 flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-foreground">Isi Berita</h3>
                            <p class="text-sm text-muted-foreground">
                                Tulis isi berita dengan bahasa yang jelas dan mudah dipahami masyarakat.
                            </p>
                        </div>

                        <span class="text-xs text-muted-foreground">
                            Maks. 5.000 karakter
                        </span>
                    </div>

                    <div class="space-y-2">
                        <textarea name="isi" rows="14" class="admin-input min-h-[360px] rounded-2xl leading-7"
                            placeholder="Tulis isi berita di sini...">{{ old('isi', $berita->isi) }}</textarea>

                        <div class="flex items-center justify-between text-xs text-muted-foreground">
                            <span>Gunakan paragraf pendek agar mudah dibaca.</span>
                            <span>{{ strlen(old('isi', $berita->isi)) }} karakter</span>
                        </div>

                        @error('isi')
                            <p class="text-xs text-destructive">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Sidebar kanan --}}
            <div class="space-y-6">

                {{-- Gambar utama --}}
                <div class="admin-card rounded-3xl p-6">

                    <div class="mb-4 flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-foreground">Gambar Utama</h3>
                            <p class="text-sm text-muted-foreground">Rasio disarankan 16:9</p>
                        </div>

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary/10 text-primary">
                            <i data-lucide="image" class="h-5 w-5"></i>
                        </div>
                    </div>

                    <div class="overflow-hidden rounded-2xl border border-border bg-muted">
                        <img id="preview-gambar"
                            src="{{ $berita->gambar ? asset('storage/' . $berita->gambar) : asset('images/placeholder.jpg') }}"
                            alt="Preview Gambar Utama" class="h-52 w-full object-cover">
                    </div>

                    <label
                        class="mt-4 flex cursor-pointer flex-col items-center justify-center rounded-2xl border border-dashed border-border bg-muted/40 px-4 py-8 text-center transition hover:border-primary/40 hover:bg-primary/5">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-primary/10 text-primary">
                            <i data-lucide="upload" class="h-6 w-6"></i>
                        </div>

                        <p class="mt-3 text-sm font-medium text-foreground">
                            Upload gambar baru
                        </p>

                        <p class="mt-1 text-xs text-muted-foreground">
                            PNG atau JPG hingga 2MB
                        </p>

                        <input id="input-gambar" type="file" name="gambar" accept="image/*" class="hidden">
                    </label>

                    @error('gambar')
                        <p class="mt-2 text-xs text-destructive">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Galeri pendukung --}}
                <div class="admin-card rounded-3xl p-6">

                    <div class="mb-4 flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-foreground">Galeri Pendukung</h3>
                            <p class="text-sm text-muted-foreground">Maksimal 2 gambar tambahan</p>
                        </div>

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary/10 text-primary">
                            <i data-lucide="images" class="h-5 w-5"></i>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">

                        {{-- Gambar 1 --}}
                        <div class="space-y-3">
                            <div class="overflow-hidden rounded-2xl border border-border bg-muted aspect-square">
                                @if ($berita->gambar2)
                                    <img id="preview-gambar2"
                                        src="{{ $berita->gambar2 ? asset('storage/' . $berita->gambar2) : asset('images/placeholder.jpg') }}"
                                        alt="Preview Gambar 1" onerror="this.style.display='none'"
                                        class="h-full w-full object-cover">
                                @else
                                    <div class="flex h-full items-center justify-center text-muted-foreground">
                                        <i data-lucide="image-plus" class="h-8 w-8"></i>
                                    </div>
                                @endif
                            </div>

                            <label
                                class="mt-4 flex cursor-pointer flex-col items-center justify-center rounded-2xl border border-dashed border-border bg-muted/40 px-4 py-8 text-center transition hover:border-primary/40 hover:bg-primary/5">
                                <div
                                    class="flex h-12 w-12 items-center justify-center rounded-full bg-primary/10 text-primary">
                                    <i data-lucide="plus" class="h-6 w-6"></i>
                                </div>

                                <p class="mt-3 text-sm font-medium text-foreground">
                                    Upload gambar baru
                                </p>

                                <p class="mt-1 text-xs text-muted-foreground">
                                    PNG atau JPG hingga 2MB
                                </p>

                                <input id="input-gambar2" type="file" name="gambar2" accept="image/*"
                                    class="hidden">
                            </label>

                            @error('gambar2')
                                <p class="text-xs text-destructive">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Gambar 2 --}}
                        <div class="space-y-3">
                            <div class="overflow-hidden rounded-2xl border border-border bg-muted aspect-square">
                                @if ($berita->gambar3)
                                    <img id="preview-gambar3"
                                        src="{{ $berita->gambar3 ? asset('storage/' . $berita->gambar3) : asset('images/placeholder.jpg') }}"
                                        alt="Preview Gambar 1" onerror="this.style.display='none'"
                                        class="h-full w-full object-cover">
                                @else
                                    <div class="flex h-full items-center justify-center text-muted-foreground">
                                        <i data-lucide="image-plus" class="h-8 w-8"></i>
                                    </div>
                                @endif
                            </div>

                            <label
                                class="mt-4 flex cursor-pointer flex-col items-center justify-center rounded-2xl border border-dashed border-border bg-muted/40 px-4 py-8 text-center transition hover:border-primary/40 hover:bg-primary/5">
                                <div
                                    class="flex h-12 w-12 items-center justify-center rounded-full bg-primary/10 text-primary">
                                    <i data-lucide="plus" class="h-6 w-6"></i>
                                </div>

                                <p class="mt-3 text-sm font-medium text-foreground">
                                    Upload gambar baru
                                </p>

                                <p class="mt-1 text-xs text-muted-foreground">
                                    PNG atau JPG hingga 2MB
                                </p>

                                <input id="input-gambar3" type="file" name="gambar3" accept="image/*"
                                    class="hidden">
                            </label>

                            @error('gambar3')
                                <p class="text-xs text-destructive">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Action bar sticky --}}
        <div class="sticky bottom-4 z-20">
            <div class="admin-card rounded-3xl border border-border/80 bg-background/95 p-4 shadow-xl backdrop-blur">

                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-center gap-3">
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-full bg-amber-100 text-amber-700 dark:bg-amber-500/20 dark:text-amber-300">
                            <i data-lucide="alert-circle" class="h-5 w-5"></i>
                        </div>

                        <div>
                            <p class="text-sm font-medium text-foreground">
                                Perubahan belum disimpan
                            </p>
                            <p class="text-xs text-muted-foreground">
                                Pastikan semua data sudah benar sebelum menyimpan.
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-col gap-3 sm:flex-row">
                        <a href="{{ route('berita.index') }}"
                            class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-primary/90 disabled:cursor-not-allowed disabled:opacity-60">
                            <i data-lucide="arrow-left" class="mr-2 h-4 w-4"></i>
                            Batal
                        </a>

                        <button id="updateBtn" type="submit"
                            class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-primary/90 disabled:cursor-not-allowed disabled:opacity-60">
                            <i id="updateIcon" data-lucide="save" class="h-4 w-4"></i>
                            <span id="updateText">Simpan Perubahan</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>


@endsection

@push('scripts')
    <script>
        function setupPreview(inputId, previewId) {
            const input = document.getElementById(inputId);
            const preview = document.getElementById(previewId);

            if (!input || !preview) return;

            input.addEventListener('change', function() {
                const file = this.files[0];

                if (file) {
                    preview.src = URL.createObjectURL(file);
                }
            });
        }

        setupPreview('input-gambar', 'preview-gambar');
        setupPreview('input-gambar2', 'preview-gambar2');
        setupPreview('input-gambar3', 'preview-gambar3');
    </script>

    <script>
        const editForm = document.getElementById('editBeritaForm');
        const updateBtn = document.getElementById('updateBtn');
        const updateText = document.getElementById('updateText');
        const updateIcon = document.getElementById('updateIcon');

        let updating = false;

        editForm.addEventListener('submit', function(e) {

            if (updating) {
                e.preventDefault();
                return;
            }

            updating = true;

            updateBtn.disabled = true;
            updateBtn.classList.add('opacity-80', 'cursor-not-allowed');

            updateText.textContent = 'Menyimpan...';

            updateIcon.outerHTML = `
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
@endpush
