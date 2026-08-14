@extends('layouts.admin')

@section('title', 'Kelola Demografis')
@section('page-title', 'Data Demografis')
@section('page-subtitle', 'Kelola data demografi dan wilayah desa')

@section('content')
    <form id="demografisForm" action="{{ route('demografis.update') }}" method="POST" class="space-y-6">
        @csrf

        {{-- Header --}}
        <div class="admin-card rounded-3xl p-6">
            <div class="flex items-start gap-4">

                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-primary/10 text-primary">
                    <i data-lucide="chart-column" class="h-7 w-7"></i>
                </div>

                <div class="flex-1">
                    <h2 class="text-xl font-semibold text-foreground">
                        Data Demografis Desa
                    </h2>

                    <p class="mt-1 text-sm text-muted-foreground">
                        Perbarui data wilayah, penduduk, dan potensi ekonomi Kepenghuluan Sintong Pusaka.
                    </p>
                </div>

            </div>
        </div>

        {{-- Statistik Wilayah --}}
        <div class="admin-card rounded-3xl p-6">

            <div class="mb-6 flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary/10 text-primary">
                    <i data-lucide="map" class="h-5 w-5"></i>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-foreground">Wilayah Administratif</h3>
                    <p class="text-sm text-muted-foreground">Data pembagian wilayah desa</p>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-4">

                <div class="rounded-2xl border border-border bg-muted/20 p-4">
                    <label class="mb-2 block text-sm font-semibold text-foreground">Jumlah Dusun</label>
                    <input type="number" name="jumlah_dusun"
                        value="{{ old('jumlah_dusun', $demografis->jumlah_dusun ?? 0) }}"
                        class="admin-input h-12 rounded-xl text-center text-lg font-semibold">
                </div>

                <div class="rounded-2xl border border-border bg-muted/20 p-4">
                    <label class="mb-2 block text-sm font-semibold text-foreground">Jumlah RW</label>
                    <input type="number" name="jumlah_rw" value="{{ old('jumlah_rw', $demografis->jumlah_rw ?? 0) }}"
                        class="admin-input h-12 rounded-xl text-center text-lg font-semibold">
                </div>

                <div class="rounded-2xl border border-border bg-muted/20 p-4">
                    <label class="mb-2 block text-sm font-semibold text-foreground">Jumlah RT</label>
                    <input type="number" name="jumlah_rt" value="{{ old('jumlah_rt', $demografis->jumlah_rt ?? 0) }}"
                        class="admin-input h-12 rounded-xl text-center text-lg font-semibold">
                </div>

                <div class="rounded-2xl border border-border bg-muted/20 p-4">
                    <label class="mb-2 block text-sm font-semibold text-foreground">Jumlah Keluarga</label>
                    <input type="number" name="jumlah_keluarga"
                        value="{{ old('jumlah_keluarga', $demografis->jumlah_keluarga ?? 0) }}"
                        class="admin-input h-12 rounded-xl text-center text-lg font-semibold">
                </div>

            </div>
        </div>

        {{-- Statistik Penduduk --}}
        <div class="admin-card rounded-3xl p-6">

            <div class="mb-6 flex items-center gap-3">
                <div
                    class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-100 text-blue-700 dark:bg-blue-500/20 dark:text-blue-300">
                    <i data-lucide="users" class="h-5 w-5"></i>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-foreground">Statistik Penduduk</h3>
                    <p class="text-sm text-muted-foreground">Data jumlah dan kepadatan penduduk</p>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-4">

                <div class="rounded-2xl border border-border bg-muted/20 p-4">
                    <label class="mb-2 block text-sm font-semibold text-foreground">Total Penduduk</label>
                    <input type="number" name="jumlah_penduduk"
                        value="{{ old('jumlah_penduduk', $demografis->jumlah_penduduk ?? 0) }}"
                        class="admin-input h-12 rounded-xl text-center text-lg font-semibold">
                </div>

                <div class="rounded-2xl border border-border bg-muted/20 p-4">
                    <label class="mb-2 block text-sm font-semibold text-foreground">Laki-laki</label>
                    <input type="number" name="jumlah_laki_laki"
                        value="{{ old('jumlah_laki_laki', $demografis->jumlah_laki_laki ?? 0) }}"
                        class="admin-input h-12 rounded-xl text-center text-lg font-semibold">
                </div>

                <div class="rounded-2xl border border-border bg-muted/20 p-4">
                    <label class="mb-2 block text-sm font-semibold text-foreground">Perempuan</label>
                    <input type="number" name="jumlah_perempuan"
                        value="{{ old('jumlah_perempuan', $demografis->jumlah_perempuan ?? 0) }}"
                        class="admin-input h-12 rounded-xl text-center text-lg font-semibold">
                </div>

                <div class="rounded-2xl border border-border bg-muted/20 p-4">
                    <label class="mb-2 block text-sm font-semibold text-foreground">Kepadatan</label>
                    <input type="number" name="kepadatan_penduduk"
                        value="{{ old('kepadatan_penduduk', $demografis->kepadatan_penduduk ?? 0) }}"
                        class="admin-input h-12 rounded-xl text-center text-lg font-semibold">
                </div>

            </div>
        </div>

        {{-- Potensi Ekonomi --}}
        <div class="admin-card rounded-3xl p-6">

            <div class="mb-6 flex items-center gap-3">
                <div
                    class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-300">
                    <i data-lucide="trees" class="h-5 w-5"></i>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-foreground">Potensi Ekonomi</h3>
                    <p class="text-sm text-muted-foreground">Data perkebunan dan potensi wilayah</p>
                </div>
            </div>

            <div class="rounded-2xl border border-border bg-muted/20 p-5">

                <label class="mb-2 block text-sm font-semibold text-foreground">
                    Luas Perkebunan Sawit (Hektare)
                </label>

                <input type="number" name="luas_perkebunan_sawit"
                    value="{{ old('luas_perkebunan_sawit', $demografis->luas_perkebunan_sawit ?? 0) }}"
                    class="admin-input h-12 rounded-xl text-lg font-semibold">

                <p class="mt-2 text-xs text-muted-foreground">
                    Masukkan total luas area perkebunan sawit dalam satuan hektare (Ha).
                </p>

            </div>
        </div>

        {{-- Action Bar --}}
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
                                Pastikan data sudah benar
                            </p>
                            <p class="text-xs text-muted-foreground">
                                Perubahan akan langsung memperbarui data demografis desa.
                            </p>
                        </div>
                    </div>

                    <button id="saveDemografisBtn" type="submit"
                        class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-primary/90 disabled:cursor-not-allowed disabled:opacity-60">
                        <i id="saveDemografisIcon" data-lucide="save" class="h-4 w-4"></i>
                        <span id="saveDemografisText">Simpan Perubahan</span>
                    </button>

                </div>
            </div>
        </div>

    </form>
@endsection

@push('scripts')
    <script>
        const demografisForm = document.getElementById('demografisForm');
        const saveBtn = document.getElementById('saveDemografisBtn');
        const saveText = document.getElementById('saveDemografisText');
        const saveIcon = document.getElementById('saveDemografisIcon');
        let saving = false;
        demografisForm.addEventListener('submit', function(
            e) {
            if (saving) {
                e.preventDefault();
                return;
            }
            saving = true;
            saveBtn.disabled = true;
            saveBtn.classList.add('opacity-80', 'cursor-not-allowed');
            saveText.textContent = 'Menyimpan...';
            saveIcon.outerHTML =
                ` <svg class="h-4 w-4 animate-spin" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"> <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle> <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path> </svg> `;
        });
    </script>
@endpush
