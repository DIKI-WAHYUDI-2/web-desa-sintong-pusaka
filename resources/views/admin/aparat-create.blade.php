@extends('layouts.admin')

@section('title', isset($aparat) ? 'Edit Aparat Desa' : 'Tambah Aparat Desa')
@section('page-title', isset($aparat) ? 'Edit Aparat Desa' : 'Tambah Aparat Desa Baru')
@section('page-subtitle', isset($aparat) ? 'Perbarui data aparat desa' : 'Tambahkan data aparat desa baru')

@section('content')
    <div class="mx-auto max-w-4xl">
        <form id="aparat-form"
            action="{{ isset($aparat) ? route('aparat_desa.update', $aparat->id) : route('aparat_desa.store') }}"
            method="POST" enctype="multipart/form-data" class="admin-card p-6">
            @csrf
            @if (isset($aparat))
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label for="nama" class="admin-label">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama', $aparat->nama ?? '') }}"
                        class="admin-input" required>
                    @error('nama')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="jabatan" class="admin-label">Jabatan</label>
                    <input type="text" id="jabatan" name="jabatan" value="{{ old('jabatan', $aparat->jabatan ?? '') }}"
                        class="admin-input" required>
                    @error('jabatan')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="mulai_jabatan" class="admin-label">Mulai Jabatan</label>
                    <input type="date" id="mulai_jabatan" name="mulai_jabatan"
                        value="{{ old('mulai_jabatan', isset($aparat) ? \Carbon\Carbon::parse($aparat->mulai_jabatan)->format('Y-m-d') : '') }}"
                        class="admin-input" required>
                    @error('mulai_jabatan')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="akhir_jabatan" class="admin-label">Akhir Jabatan</label>
                    <input type="date" id="akhir_jabatan" name="akhir_jabatan"
                        value="{{ old('akhir_jabatan', isset($aparat) && $aparat->akhir_jabatan ? \Carbon\Carbon::parse($aparat->akhir_jabatan)->format('Y-m-d') : '') }}"
                        class="admin-input">
                    @error('akhir_jabatan')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status_aktif" class="admin-label">Status Aktif</label>
                    <select id="status_aktif" name="status_aktif" class="admin-input" required>
                        <option value="1"
                            {{ old('status_aktif', $aparat->status_aktif ?? '') == 1 ? 'selected' : '' }}>Aktif</option>
                        <option value="0"
                            {{ old('status_aktif', $aparat->status_aktif ?? '') == 0 ? 'selected' : '' }}>Tidak Aktif
                        </option>
                    </select>
                    @error('status_aktif')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="foto" class="admin-label">Foto</label>
                    <input type="file" id="foto" name="foto" accept="image/*" class="admin-input">
                    @error('foto')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    @if (isset($aparat) && $aparat->foto)
                        <div class="mt-3">
                            <p class="mb-1 text-sm text-muted-foreground">Foto saat ini:</p>
                            <img src="{{ asset('storage/' . $aparat->foto) }}" alt="Foto {{ $aparat->nama }}"
                                class="h-32 w-32 rounded-sm border border-border object-cover">
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-8 flex gap-3 border-t border-border pt-6">
                <a href="{{ route('aparat_desa.index') }}" class="btn-secondary">
                    <i data-lucide="arrow-left" class="h-4 w-4"></i>
                    Kembali
                </a>
                <button type="submit" id="submit-btn" class="btn-primary disabled:opacity-60 disabled:cursor-not-allowed">
                    <i data-lucide="save" class="h-4 w-4"></i>
                    {{ isset($aparat) ? 'Simpan Perubahan' : 'Tambah Aparat' }}
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('aparat-form');
            const submitBtn = document.getElementById('submit-btn');
            let submitted = false;
            form.addEventListener('submit', function(
                e) {
                const mulaiJabatan = document.getElementById('mulai_jabatan').value;
                const akhirJabatan = document.getElementById('akhir_jabatan').value;
                if (akhirJabatan && new Date(akhirJabatan) < new Date(mulaiJabatan)) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Tanggal tidak valid',
                        text: 'Akhir jabatan tidak boleh sebelum mulai jabatan!',
                        icon: 'warning',
                        confirmButtonColor: '#1F6B3D'
                    });
                    return;
                }
                if (submitted) {
                    e.preventDefault();
                    return;
                }
                submitted = true;
                submitBtn.disabled = true;
                submitBtn.innerHTML =
                    ` <span class="inline-block h-4 w-4 animate-spin rounded-full border-2 border-white border-t-transparent mr-2"></span> {{ isset($aparat) ? 'Menyimpan...' : 'Menambahkan...' }} `;
            });
        });
    </script>
@endpush
