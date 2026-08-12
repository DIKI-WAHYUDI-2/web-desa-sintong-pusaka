@extends('layouts.admin')

@section('title', isset($galeri) ? 'Edit Galeri' : 'Tambah Galeri')
@section('page-title', isset($galeri) ? 'Edit Gambar' : 'Tambah Gambar Baru')
@section('page-subtitle', isset($galeri) ? 'Perbarui gambar galeri' : 'Tambahkan gambar baru ke galeri')

@section('content')
    <form action="{{ isset($galeri) ? route('galeri.update', $galeri->id) : route('galeri.store') }}" method="POST"
        enctype="multipart/form-data" class="admin-card space-y-6 p-6">
        @csrf
        @if(isset($galeri))
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div>
                <label class="admin-label">Judul</label>
                <input type="text" name="judul" value="{{ old('judul', $galeri->judul ?? '') }}" class="admin-input"
                    required>
            </div>
            <div>
                <label class="admin-label">Kategori album *</label>
                <select name="kategori" class="admin-input" required>
                    @foreach ($kategori as $cat)
                        <option value="{{ $cat }}" {{ old('kategori', $galeri->kategori ?? '') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="admin-label">Organisasi</label>
                <select name="organisasi" class="admin-input" required>
                    @foreach ($organisasi as $org)
                        <option value="{{ $org }}" {{ old('organisasi', $galeri->organisasi ?? '') == $org ? 'selected' : '' }}>{{ $org }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div>
            <label class="admin-label">Gambar (bisa pilih beberapa)</label>
            <input type="file" name="gambar[]" multiple class="admin-input">
        </div>

        <div class="flex gap-3 border-t border-border pt-6">
            <button type="submit" class="btn-primary">
                <i data-lucide="save" class="h-4 w-4"></i>
                {{ isset($galeri) ? 'Simpan Perubahan' : 'Buat Galeri' }}
            </button>
            <a href="{{ route('galeri') }}" class="btn-secondary">
                <i data-lucide="arrow-left" class="h-4 w-4"></i>
                Batal
            </a>
        </div>
    </form>
@endsection
