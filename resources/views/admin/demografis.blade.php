@extends('layouts.admin')

@section('title', 'Kelola Demografis')
@section('page-title', 'Data Demografis')
@section('page-subtitle', 'Kelola data demografi dan wilayah desa')

@section('content')
    <div class="admin-card p-6">
        <form action="{{ route('demografis.update') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label class="admin-label">Jumlah Dusun</label>
                    <input type="number" name="jumlah_dusun"
                        value="{{ old('jumlah_dusun', $demografis->jumlah_dusun ?? 0) }}" class="admin-input">
                </div>

                <div>
                    <label class="admin-label">Jumlah RW</label>
                    <input type="number" name="jumlah_rw" value="{{ old('jumlah_rw', $demografis->jumlah_rw ?? 0) }}"
                        class="admin-input">
                </div>

                <div>
                    <label class="admin-label">Jumlah RT</label>
                    <input type="number" name="jumlah_rt" value="{{ old('jumlah_rt', $demografis->jumlah_rt ?? 0) }}"
                        class="admin-input">
                </div>

                <div>
                    <label class="admin-label">Jumlah Keluarga</label>
                    <input type="number" name="jumlah_keluarga"
                        value="{{ old('jumlah_keluarga', $demografis->jumlah_keluarga ?? 0) }}" class="admin-input">
                </div>

                <div>
                    <label class="admin-label">Jumlah Penduduk</label>
                    <input type="number" name="jumlah_penduduk"
                        value="{{ old('jumlah_penduduk', $demografis->jumlah_penduduk ?? 0) }}" class="admin-input">
                </div>

                <div>
                    <label class="admin-label">Kepadatan Penduduk</label>
                    <input type="number" name="kepadatan_penduduk"
                        value="{{ old('kepadatan_penduduk', $demografis->kepadatan_penduduk ?? 0) }}"
                        class="admin-input">
                </div>

                <div>
                    <label class="admin-label">Jumlah Laki-laki</label>
                    <input type="number" name="jumlah_laki_laki"
                        value="{{ old('jumlah_laki_laki', $demografis->jumlah_laki_laki ?? 0) }}" class="admin-input">
                </div>

                <div>
                    <label class="admin-label">Jumlah Perempuan</label>
                    <input type="number" name="jumlah_perempuan"
                        value="{{ old('jumlah_perempuan', $demografis->jumlah_perempuan ?? 0) }}" class="admin-input">
                </div>

                <div class="md:col-span-2">
                    <label class="admin-label">Luas Perkebunan Sawit (Ha)</label>
                    <input type="number" name="luas_perkebunan_sawit"
                        value="{{ old('luas_perkebunan_sawit', $demografis->luas_perkebunan_sawit ?? 0) }}"
                        class="admin-input">
                </div>
            </div>

            <div class="flex justify-end border-t border-border pt-6">
                <button type="submit" class="btn-primary">
                    <i data-lucide="save" class="h-4 w-4"></i>
                    Simpan
                </button>
            </div>
        </form>
    </div>
@endsection
