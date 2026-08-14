@extends('layouts.admin')

@section('title', 'Tambah Berita')
@section('page-title', 'Tambah Berita Baru')
@section('page-subtitle', 'Buat artikel berita baru')

@section('content')
    <form id="beritaForm" action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
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

                            <input type="text" name="judul" value="{{ old('judul') }}"
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
                                    <option value="">Pilih kategori</option>
                                    @foreach (['Politik', 'Ekonomi', 'Sosial', 'Budaya', 'Olahraga', 'Teknologi', 'Lingkungan'] as $kategori)
                                        <option value="{{ $kategori }}"
                                            {{ old('kategori') == $kategori ? 'selected' : '' }}>
                                            {{ $kategori }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('kategori')
                                    <p class="text-xs text-destructive">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label class="admin-label text-sm font-semibold">Tanggal Publikasi</label>

                                <input type="date" name="tanggal" value="{{ old('tanggal', now()->format('Y-m-d')) }}"
                                    class="admin-input h-12 rounded-xl">

                                @error('tanggal')
                                    <p class="text-xs text-destructive">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Organisasi --}}
                        <div class="space-y-2">
                            <label class="admin-label text-sm font-semibold">Organisasi</label>

                            <select name="organisasi" class="admin-input h-12 rounded-xl">
                                <option value="">Pilih organisasi</option>
                                @foreach (['Kepenghuluan', 'Badan Usaha Milik Kepenghuluan', 'Badan Permusyawaratan Kepenghuluan', 'Lembaga Pemberdayaan Masyarakat', 'Karang Taruna', 'PKK', 'PKKBN'] as $organisasi)
                                    <option value="{{ $organisasi }}"
                                        {{ old('organisasi') == $organisasi ? 'selected' : '' }}>
                                        {{ $organisasi }}
                                    </option>
                                @endforeach
                            </select>

                            @error('organisasi')
                                <p class="text-xs text-destructive">{{ $message }}</p>
                            @enderror
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
                            placeholder="Tulis isi berita di sini...">{{ old('isi') }}</textarea>

                        <div class="flex items-center justify-between text-xs text-muted-foreground">
                            <span>Gunakan paragraf pendek agar mudah dibaca.</span>
                            <span>{{ strlen(old('isi', '')) }} karakter</span>
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

                    <label id="dropzone-gambar"
                        class="relative flex cursor-pointer flex-col items-center justify-center overflow-hidden rounded-2xl border border-dashed border-border bg-muted/40 px-4 py-10 text-center transition hover:border-primary/40 hover:bg-primary/5">

                        <div id="dropzone-gambar-empty" class="flex flex-col items-center">
                            <div class="flex h-14 w-14 items-center justify-center rounded-full bg-primary/10 text-primary">
                                <i data-lucide="upload" class="h-7 w-7"></i>
                            </div>
                            <p class="mt-4 text-sm font-medium text-foreground">
                                Upload gambar utama
                            </p>
                            <p class="mt-1 text-xs text-muted-foreground">
                                PNG atau JPG hingga 2MB
                            </p>
                        </div>

                        <div id="dropzone-gambar-filled" class="hidden w-full">
                            <img id="dropzone-gambar-img" src="" class="mx-auto max-h-40 rounded-xl object-cover">
                            <p id="dropzone-gambar-name" class="mt-2 truncate text-xs font-medium text-foreground"></p>
                            <p class="mt-1 text-xs text-primary">Klik untuk ganti gambar</p>
                        </div>

                        <input id="gambar-utama-input" type="file" name="gambar" accept="image/png,image/jpeg"
                            class="hidden">
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
                            <label
                                class="relative flex aspect-square cursor-pointer flex-col items-center justify-center overflow-hidden rounded-2xl border border-dashed border-border bg-muted/40 transition hover:border-primary/40 hover:bg-primary/5">

                                <div id="dropzone-gambar2-icon" class="flex flex-col items-center">
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
                                </div>

                                <img id="dropzone-gambar2-img" src="" class="hidden h-full w-full object-cover">

                                <input id="gambar2-input" type="file" name="gambar2" accept="image/png,image/jpeg"
                                    class="hidden">
                            </label>

                            <p id="dropzone-gambar2-name" class="truncate text-xs text-muted-foreground"></p>
                        </div>

                        {{-- Gambar 2 --}}
                        <div class="space-y-3">
                            <label
                                class="relative flex aspect-square cursor-pointer flex-col items-center justify-center overflow-hidden rounded-2xl border border-dashed border-border bg-muted/40 transition hover:border-primary/40 hover:bg-primary/5">

                                <div id="dropzone-gambar3-icon" class="flex flex-col items-center">
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
                                </div>

                                <img id="dropzone-gambar3-img" src="" class="hidden h-full w-full object-cover">

                                <input id="gambar3-input" type="file" name="gambar3" accept="image/png,image/jpeg"
                                    class="hidden">
                            </label>

                            <p id="dropzone-gambar3-name" class="truncate text-xs text-muted-foreground"></p>
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
                                Berita baru belum disimpan
                            </p>
                            <p class="text-xs text-muted-foreground">
                                Pastikan semua data sudah benar sebelum membuat berita.
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-col gap-3 sm:flex-row">
                        <a href="{{ route('berita.index') }}"
                            class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-primary/90 disabled:cursor-not-allowed disabled:opacity-60">
                            <i data-lucide="arrow-left" class="mr-2 h-4 w-4"></i>
                            Batal
                        </a>

                        <button id="submitBtn" type="submit"
                            class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-primary/90 disabled:cursor-not-allowed disabled:opacity-60">
                            <i id="submitIcon" data-lucide="save" class="h-4 w-4"></i>
                            <span id="submitText">Buat Berita</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        function setupSinglePreview(inputId, emptyId, filledId, imgId, nameId, maxMb = 2) {
            const input = document.getElementById(inputId);
            const empty = document.getElementById(emptyId);
            const filled = document.getElementById(filledId);
            const img = document.getElementById(imgId);
            const nameEl = document.getElementById(nameId);

            input.addEventListener('change', () => {
                const file = input.files[0];

                if (!file) {
                    empty.classList.remove('hidden');
                    filled.classList.add('hidden');
                    return;
                }

                if (file.size > maxMb * 1024 * 1024) {
                    alert(`Ukuran file maksimal ${maxMb}MB`);
                    input.value = '';
                    empty.classList.remove('hidden');
                    filled.classList.add('hidden');
                    return;
                }

                const url = URL.createObjectURL(file);
                img.src = url;
                nameEl.textContent = file.name;

                empty.classList.add('hidden');
                filled.classList.remove('hidden');
            });
        }

        function setupThumbPreview(inputId, iconId, imgId, nameId, maxMb = 2) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            const img = document.getElementById(imgId);
            const nameEl = document.getElementById(nameId);

            input.addEventListener('change', () => {
                const file = input.files[0];

                if (!file) {
                    icon.classList.remove('hidden');
                    img.classList.add('hidden');
                    nameEl.textContent = '';
                    return;
                }

                if (file.size > maxMb * 1024 * 1024) {
                    alert(`Ukuran file maksimal ${maxMb}MB`);
                    input.value = '';
                    icon.classList.remove('hidden');
                    img.classList.add('hidden');
                    nameEl.textContent = '';
                    return;
                }

                const url = URL.createObjectURL(file);
                img.src = url;
                nameEl.textContent = file.name;

                icon.classList.add('hidden');
                img.classList.remove('hidden');
            });
        }

        setupSinglePreview('gambar-utama-input', 'dropzone-gambar-empty', 'dropzone-gambar-filled',
            'dropzone-gambar-img', 'dropzone-gambar-name');
        setupThumbPreview('gambar2-input', 'dropzone-gambar2-icon', 'dropzone-gambar2-img', 'dropzone-gambar2-name');
        setupThumbPreview('gambar3-input', 'dropzone-gambar3-icon', 'dropzone-gambar3-img', 'dropzone-gambar3-name');
    </script>

    <script>
        const form = document.getElementById('beritaForm');
        const submitBtn = document.getElementById('submitBtn');
        const submitText = document.getElementById('submitText');
        const submitIcon = document.getElementById('submitIcon');

        let isSubmitting = false;

        form.addEventListener('submit', function(e) {

            // Cegah submit kedua
            if (isSubmitting) {
                e.preventDefault();
                return;
            }

            isSubmitting = true;

            // Disable tombol
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-80', 'cursor-not-allowed');

            // Ganti teks
            submitText.textContent = 'Menyimpan...';

            // Ganti icon jadi spinner
            submitIcon.outerHTML = `
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
