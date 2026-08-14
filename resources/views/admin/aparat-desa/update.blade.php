@extends('layouts.admin')

@section('title', 'Edit Aparat Desa')
@section('page-title', 'Edit Aparat Desa')
@section('page-subtitle', 'Perbarui data aparat desa')

@section('content')
    <div class="mx-auto max-w-6xl">
        <form id="aparat-form" action="{{ route('aparat_desa.update', $aparat_desa) }}" method="POST"
            enctype="multipart/form-data" class="space-y-6">
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
                                <p class="text-sm text-muted-foreground">Data identitas aparat desa</p>
                            </div>

                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary/10 text-primary">
                                <i data-lucide="id-card" class="h-5 w-5"></i>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                            {{-- Nama --}}
                            <div class="space-y-2 md:col-span-2">
                                <label for="nama" class="admin-label text-sm font-semibold">
                                    Nama Lengkap
                                </label>

                                <input type="text" id="nama" name="nama"
                                    value="{{ old('nama', $aparat_desa->nama) }}"
                                    class="admin-input h-12 rounded-xl text-base"
                                    placeholder="Masukkan nama lengkap aparat desa" required>

                                @error('nama')
                                    <p class="text-xs text-destructive">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Jabatan --}}
                            <div class="space-y-2">
                                <label for="jabatan" class="admin-label text-sm font-semibold">
                                    Jabatan
                                </label>

                                <input type="text" id="jabatan" name="jabatan"
                                    value="{{ old('jabatan', $aparat_desa->jabatan) }}" class="admin-input h-12 rounded-xl"
                                    placeholder="Contoh: Sekretaris Desa" required>

                                @error('jabatan')
                                    <p class="text-xs text-destructive">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Status --}}
                            <div class="space-y-2">
                                <label for="status_aktif" class="admin-label text-sm font-semibold">
                                    Status
                                </label>

                                <select id="status_aktif" name="status_aktif" class="admin-input h-12 rounded-xl" required>

                                    <option value="1"
                                        {{ old('status_aktif', $aparat_desa->status_aktif) == 1 ? 'selected' : '' }}>
                                        Aktif
                                    </option>

                                    <option value="0"
                                        {{ old('status_aktif', $aparat_desa->status_aktif) == 0 ? 'selected' : '' }}>
                                        Tidak Aktif
                                    </option>
                                </select>

                                @error('status_aktif')
                                    <p class="text-xs text-destructive">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Mulai Jabatan --}}
                            <div class="space-y-2">
                                <label for="mulai_jabatan" class="admin-label text-sm font-semibold">
                                    Mulai Jabatan
                                </label>

                                <input type="date" id="mulai_jabatan" name="mulai_jabatan"
                                    value="{{ old('mulai_jabatan', optional($aparat_desa->mulai_jabatan)->format('Y-m-d') ?? \Carbon\Carbon::parse($aparat_desa->mulai_jabatan)->format('Y-m-d')) }}"
                                    class="admin-input h-12 rounded-xl" required>

                                @error('mulai_jabatan')
                                    <p class="text-xs text-destructive">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Akhir Jabatan --}}
                            <div class="space-y-2">
                                <label for="akhir_jabatan" class="admin-label text-sm font-semibold">
                                    Akhir Jabatan
                                </label>

                                <input type="date" id="akhir_jabatan" name="akhir_jabatan"
                                    value="{{ old('akhir_jabatan', $aparat_desa->akhir_jabatan ? \Carbon\Carbon::parse($aparat_desa->akhir_jabatan)->format('Y-m-d') : '') }}"
                                    class="admin-input h-12 rounded-xl">

                                <p class="text-xs text-muted-foreground">
                                    Kosongkan jika masih menjabat.
                                </p>

                                @error('akhir_jabatan')
                                    <p class="text-xs text-destructive">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Informasi tambahan --}}
                    <div class="admin-card rounded-3xl p-6">

                        <div class="mb-4 flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary/10 text-primary">
                                <i data-lucide="calendar-range" class="h-5 w-5"></i>
                            </div>

                            <div>
                                <h3 class="text-lg font-semibold text-foreground">Masa Jabatan</h3>
                                <p class="text-sm text-muted-foreground">
                                    Pastikan rentang tanggal jabatan sudah benar.
                                </p>
                            </div>
                        </div>

                        <div class="rounded-2xl border border-border bg-muted/20 p-4">
                            <div class="flex items-start gap-3">
                                <div
                                    class="mt-0.5 flex h-8 w-8 items-center justify-center rounded-lg bg-amber-100 text-amber-700 dark:bg-amber-500/20 dark:text-amber-300">
                                    <i data-lucide="info" class="h-4 w-4"></i>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-foreground">
                                        Informasi masa jabatan
                                    </p>

                                    <p class="mt-1 text-sm text-muted-foreground">
                                        Akhir jabatan tidak boleh lebih awal dari mulai jabatan.
                                        Jika aparat masih aktif menjabat, biarkan akhir jabatan kosong.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sidebar kanan --}}
                <div class="space-y-6">

                    {{-- Foto profil --}}
                    <div class="admin-card rounded-3xl p-6">

                        <div class="mb-4 flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-foreground">Foto Profil</h3>
                                <p class="text-sm text-muted-foreground">Foto saat ini dan penggantian foto</p>
                            </div>

                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary/10 text-primary">
                                <i data-lucide="image" class="h-5 w-5"></i>
                            </div>
                        </div>

                        {{-- Preview besar --}}
                        <div class="mb-5 flex justify-center">
                            <div
                                class="relative h-44 w-44 overflow-hidden rounded-full border border-border bg-muted shadow-sm">

                                @if ($aparat_desa->foto)
                                    <img id="preview-image" src="{{ asset('storage/' . $aparat_desa->foto) }}"
                                        alt="{{ $aparat_desa->nama }}" class="h-full w-full object-cover">
                                @else
                                    <div id="preview-placeholder"
                                        class="flex h-full w-full items-center justify-center bg-primary/10 text-primary">
                                        <i data-lucide="user" class="h-16 w-16"></i>
                                    </div>

                                    <img id="preview-image" class="hidden h-full w-full object-cover" alt="Preview foto">
                                @endif
                            </div>
                        </div>

                        {{-- Upload --}}
                        <label
                            class="flex cursor-pointer flex-col items-center justify-center rounded-2xl border border-dashed border-border bg-muted/40 px-4 py-8 text-center transition hover:border-primary/40 hover:bg-primary/5">

                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-full bg-primary/10 text-primary">
                                <i data-lucide="upload" class="h-6 w-6"></i>
                            </div>

                            <p class="mt-3 text-sm font-medium text-foreground">
                                Ganti foto aparat
                            </p>

                            <p class="mt-1 text-xs text-muted-foreground">
                                JPG, PNG, atau GIF hingga 2MB
                            </p>

                            <input type="file" id="foto" name="foto" accept="image/*" class="hidden">
                        </label>

                        @error('foto')
                            <p class="mt-2 text-xs text-destructive">{{ $message }}</p>
                        @enderror
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
                                    Pastikan semua informasi sudah benar sebelum menyimpan perubahan.
                                </p>
                            </div>
                        </div>

                        <div class="flex flex-col gap-3 sm:flex-row">

                            <a href="{{ route('aparat_desa.index') }}"
                                class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-primary/90 disabled:cursor-not-allowed disabled:opacity-60">
                                <i data-lucide="arrow-left" class="mr-2 h-4 w-4"></i>
                                Kembali
                            </a>

                            <button type="submit" id="submit-btn"
                                class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-primary/90 disabled:cursor-not-allowed disabled:opacity-60">
                                <i data-lucide="save" class="mr-2 h-4 w-4"></i>
                                Simpan Aparat
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
                    const form = document.getElementById('aparat-form');
                    const submitBtn = document.getElementById('submit-btn');
                    const fotoInput = document.getElementById('foto');
                    const previewImage = document.getElementById('preview-image');
                    const previewPlaceholder = document.getElementById('preview-placeholder');

                    // Preview foto baru
                    fotoInput.addEventListener('change', function(e) {
                        const file = e.target.files[0];

                        if (!file) return;

                        const reader = new FileReader();

                        reader.onload = function(event) {
                            previewImage.src = event.target.result;
                            previewImage.classList.remove('hidden');

                            if (previewPlaceholder) {
                                previewPlaceholder.classList.add('hidden');
                            }
                        };

                        reader.readAsDataURL(file);
                    });

                    // Validasi & loading submit
                    let submitted = false;
                    form.addEventListener('submit', function(e) {
                        const mulai = document.getElementById('mulai_jabatan').value;
                        const akhir = document.getElementById('akhir_jabatan').value;
                        if (akhir && new Date(akhir) < new Date(mulai)) {
                            e.preventDefault();
                            Swal.fire({
                                title: 'Tanggal tidak valid',
                                text: 'Akhir jabatan tidak boleh sebelum mulai jabatan.',
                                icon: 'warning',
                                confirmButtonColor: '#0F4C3A',
                                customClass: {
                                    popup: 'rounded-3xl',
                                    confirmButton: 'rounded-xl'
                                }
                            });
                            return;
                        }
                        if (submitted) {
                            e.preventDefault();
                            return;
                        }
                        submitted = true;
                        submitBtn.disabled = true;
                        submitBtn.classList.add('opacity-80', 'cursor-not-allowed');
                        submitBtn.innerHTML =
                            ` <span class="inline-block h-4 w-4 animate-spin rounded-full border-2 border-white border-t-transparent"></span> Menyimpan... `;
                    });
    </script>
@endpush
