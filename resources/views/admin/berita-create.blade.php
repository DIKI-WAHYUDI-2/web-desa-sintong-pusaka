@extends('layouts.admin')

@section('title', isset($berita) ? 'Edit Berita' : 'Tambah Berita')
@section('page-title', isset($berita) ? 'Edit Berita' : 'Tambah Berita Baru')
@section('page-subtitle', isset($berita) ? 'Perbarui data berita' : 'Buat artikel berita baru')

@section('content')
    <form action="{{ isset($berita) ? route('berita.update', $berita->id) : route('berita.store') }}" method="POST"
        enctype="multipart/form-data" class="admin-card space-y-6 p-6">
        @csrf
        @if(isset($berita))
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div>
                <label class="admin-label">Judul</label>
                <input type="text" name="judul" value="{{ old('judul', $berita->judul ?? '') }}" class="admin-input">
            </div>
            <div>
                <label class="admin-label">Kategori</label>
                <select name="kategori" class="admin-input">
                    @foreach($kategori as $kat)
                        <option value="{{ $kat }}" {{ old('kategori', $berita->kategori ?? '') == $kat ? 'selected' : '' }}>
                            {{ $kat }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="admin-label">Organisasi</label>
                <select name="organisasi" class="admin-input">
                    @foreach($organisasi as $org)
                        <option value="{{ $org }}" {{ old('organisasi', $berita->organisasi ?? '') == $org ? 'selected' : '' }}>
                            {{ $org }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="admin-label">Tanggal</label>
                <input type="date" name="tanggal" value="{{ old('tanggal', $berita->tanggal ?? '') }}"
                    class="admin-input">
            </div>
        </div>

        <div>
            <label class="admin-label">Isi</label>
            <textarea name="isi" rows="6" class="admin-input">{{ old('isi', $berita->isi ?? '') }}</textarea>
        </div>

        {{-- Gambar Utama --}}
        <div>
            <label class="admin-label">Gambar Utama</label>
            <input type="file" name="gambar" class="admin-input">
            @if(isset($berita) && $berita->gambar)
                <img src="{{ asset($berita->gambar) }}" alt="Preview Gambar Utama"
                    class="mt-3 h-24 w-32 rounded-sm border border-border object-cover">
            @endif
        </div>

        {{-- Gambar Pendukung 1 --}}
        <div>
            <label class="admin-label">Gambar Pendukung 1</label>
            <input type="file" name="gambar2" class="admin-input">
            @if(isset($berita) && $berita->gambar2)
                <img src="{{ asset($berita->gambar2) }}" alt="Preview Gambar Pendukung 1"
                    class="mt-3 h-24 w-32 rounded-sm border border-border object-cover">
            @endif
        </div>

        {{-- Gambar Pendukung 2 --}}
        <div>
            <label class="admin-label">Gambar Pendukung 2</label>
            <input type="file" name="gambar3" class="admin-input">
            @if(isset($berita) && $berita->gambar3)
                <img src="{{ asset($berita->gambar3) }}" alt="Preview Gambar Pendukung 2"
                    class="mt-3 h-24 w-32 rounded-sm border border-border object-cover">
            @endif
        </div>

        <div class="flex gap-3 border-t border-border pt-6">
            <button type="submit" class="btn-primary">
                <i data-lucide="save" class="h-4 w-4"></i>
                {{ isset($berita) ? 'Simpan Perubahan' : 'Buat Berita' }}
            </button>
            <a href="{{ route('berita') }}" class="btn-secondary">
                <i data-lucide="arrow-left" class="h-4 w-4"></i>
                Batal
            </a>
        </div>
    </form>
@endsection
