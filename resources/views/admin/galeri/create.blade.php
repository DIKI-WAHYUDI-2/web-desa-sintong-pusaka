@extends('layouts.admin')

@section('title', 'Tambah Galeri')
@section('page-title', 'Tambah Gambar Baru')
@section('page-subtitle', 'Tambahkan gambar baru ke galeri')

@section('content')
    <div class="mx-auto max-w-5xl">
        <form id="galeriForm" action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf

            {{-- Form --}}
            <div class="admin-card rounded-3xl p-6">

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                    {{-- Judul --}}
                    <div class="space-y-2 md:col-span-2">
                        <label class="admin-label text-sm font-semibold">
                            Judul Album
                        </label>

                        <input type="text" name="judul" value="{{ old('judul') }}"
                            class="admin-input h-12 rounded-xl text-base" placeholder="Contoh: Kegiatan Gotong Royong Desa"
                            required>

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
                            <option value="" disabled {{ old('kategori') ? '' : 'selected' }}>Pilih Kategori</option>
                            <option value="Politik" {{ old('kategori') == 'Politik' ? 'selected' : '' }}>Politik</option>
                            <option value="Ekonomi" {{ old('kategori') == 'Ekonomi' ? 'selected' : '' }}>Ekonomi</option>
                            <option value="Sosial" {{ old('kategori') == 'Sosial' ? 'selected' : '' }}>Sosial</option>
                            <option value="Budaya" {{ old('kategori') == 'Budaya' ? 'selected' : '' }}>Budaya</option>
                            <option value="Olahraga" {{ old('kategori') == 'Olahraga' ? 'selected' : '' }}>Olahraga</option>
                            <option value="Teknologi" {{ old('kategori') == 'Teknologi' ? 'selected' : '' }}>Teknologi
                            </option>
                            <option value="Lingkungan" {{ old('kategori') == 'Lingkungan' ? 'selected' : '' }}>Lingkungan
                            </option>
                        </select>
                    </div>

                    {{-- Organisasi --}}
                    <div class="space-y-2">
                        <label class="admin-label text-sm font-semibold">
                            Organisasi
                        </label>

                        <select name="organisasi" class="admin-input h-12 rounded-xl" required>
                            <option value="" disabled {{ old('organisasi') ? '' : 'selected' }}>
                                Pilih Organisasi
                            </option>
                            <option value="Kepenghuluan" {{ old('organisasi') == 'Kepenghuluan' ? 'selected' : '' }}>
                                Kepenghuluan
                            </option>
                            <option value="Badan Usaha Milik Kepenghuluan"
                                {{ old('organisasi') == 'Badan Usaha Milik Kepenghuluan' ? 'selected' : '' }}>
                                Badan Usaha Milik Kepenghuluan
                            </option>
                            <option value="Badan Permusyawaratan Kepenghuluan"
                                {{ old('organisasi') == 'Badan Permusyawaratan Kepenghuluan' ? 'selected' : '' }}>
                                Badan Permusyawaratan Kepenghuluan
                            </option>
                            <option value="Lembaga Pemberdayaan Masyarakat"
                                {{ old('organisasi') == 'Lembaga Pemberdayaan Masyarakat' ? 'selected' : '' }}>
                                Lembaga Pemberdayaan Masyarakat
                            </option>
                            <option value="Karang Taruna" {{ old('organisasi') == 'Karang Taruna' ? 'selected' : '' }}>
                                Karang Taruna
                            </option>
                            <option value="PKK" {{ old('organisasi') == 'PKK' ? 'selected' : '' }}>PKK</option>
                            <option value="PKKBN" {{ old('organisasi') == 'PKKBN' ? 'selected' : '' }}>PKKBN</option>
                        </select>
                    </div>
                </div>

                {{-- Upload gambar --}}
                <div class="mt-6 space-y-3">

                    <label class="admin-label text-sm font-semibold">
                        Upload Gambar
                    </label>

                    <label id="dropzone"
                        class="flex cursor-pointer flex-col items-center justify-center rounded-3xl border border-dashed border-border bg-muted/30 px-6 py-12 text-center transition hover:border-primary/40 hover:bg-primary/5">

                        <div class="flex h-14 w-14 items-center justify-center rounded-full bg-primary/10 text-primary">
                            <i data-lucide="upload" class="h-7 w-7"></i>
                        </div>

                        <p id="dropzone-title" class="mt-4 text-sm font-semibold text-foreground">
                            Klik untuk memilih gambar
                        </p>

                        <p id="dropzone-subtitle" class="mt-1 text-sm text-muted-foreground">
                            Anda dapat memilih beberapa gambar sekaligus
                        </p>

                        <p class="mt-2 text-xs text-muted-foreground">
                            JPG, PNG, WEBP • Maksimal 2 MB per gambar
                        </p>

                        <input id="gambar-input" type="file" name="gambar[]" multiple accept="image/*" class="hidden">
                    </label>

                    {{-- Preview gambar yang dipilih --}}
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

                <button id="submitGaleriBtn" type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-primary/25 transition hover:bg-primary/90 disabled:cursor-not-allowed disabled:opacity-60">
                    <i id="submitGaleriIcon" data-lucide="save" class="h-4 w-4"></i>
                    <span id="submitGaleriText">Simpan Galeri</span>
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        const galeriForm = document.getElementById('galeriForm');
        const submitGaleriBtn = document.getElementById('submitGaleriBtn');
        const submitGaleriText = document.getElementById('submitGaleriText');
        const submitGaleriIcon = document.getElementById('submitGaleriIcon');

        let galeriSubmitting = false;

        galeriForm.addEventListener('submit', function(e) {

            if (galeriSubmitting) {
                e.preventDefault();
                return;
            }

            galeriSubmitting = true;

            submitGaleriBtn.disabled = true;
            submitGaleriBtn.classList.add('opacity-80', 'cursor-not-allowed');

            submitGaleriText.textContent = 'Menyimpan...';

            submitGaleriIcon.outerHTML = `
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
                title.textContent = 'Klik untuk memilih gambar';
                subtitle.textContent = 'Anda dapat memilih beberapa gambar sekaligus';
                return;
            }

            title.textContent = `${files.length} gambar dipilih`;
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
