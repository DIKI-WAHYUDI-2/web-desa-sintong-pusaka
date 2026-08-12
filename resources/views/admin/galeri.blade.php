@extends('layouts.admin')

@section('title', 'Kelola Galeri')
@section('page-title', 'Kelola Galeri')
@section('page-subtitle', 'Kelola semua gambar dan dokumentasi')

@section('content')
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="flex items-center gap-2 text-lg font-semibold text-foreground">
                <i data-lucide="image" class="h-5 w-5 text-secondary"></i>
                Daftar Galeri
            </h2>
            <p class="mt-1 text-sm text-muted-foreground">Kelola semua album foto kegiatan desa</p>
        </div>
        <a href="{{ route('galeri.create') }}" class="btn-primary">
            <i data-lucide="plus" class="h-4 w-4"></i>
            Tambah Gambar
        </a>
    </div>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        @forelse ($galeri as $item)
            <div class="overflow-hidden rounded-3xl border border-border bg-white shadow-sm">
                <div class="relative">
                    @if($item->fotos->isNotEmpty())
                        <img src="{{ asset('storage/' . $item->fotos->first()->gambar) }}" alt="Foto {{ $item->judul }}"
                            class="h-48 w-full object-cover">
                    @else
                        <div class="flex h-48 w-full items-center justify-center bg-muted text-sm text-muted-foreground">
                            Tidak ada foto
                        </div>
                    @endif
                    <span class="absolute left-3 top-3 rounded-full bg-white/95 px-2.5 py-1 text-xs font-semibold text-[#8a6a1e] shadow-sm">
                        {{ $item->kategori }}
                    </span>
                </div>
                <div class="flex items-center justify-between gap-2 p-5">
                    <div class="min-w-0">
                        <h3 class="truncate text-sm font-semibold text-foreground">{{ $item->judul }}</h3>
                        <p class="mt-0.5 truncate text-xs text-muted-foreground">{{ $item->organisasi }}</p>
                    </div>
                    <div class="flex shrink-0 gap-2">
                        <a href="{{ route('galeri.edit', $item->id) }}" class="btn-edit">
                            <i data-lucide="pencil" class="h-3.5 w-3.5"></i>
                        </a>
                        <form action="{{ route('galeri.destroy', $item->id) }}" method="POST"
                            id="delete-{{ $item->id }}" onsubmit="event.preventDefault(); confirmDelete('{{ $item->id }}')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger">
                                <i data-lucide="trash-2" class="h-3.5 w-3.5"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full rounded-3xl border border-border bg-white py-20 text-center shadow-sm">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-[#FBEFD1]">
                    <i data-lucide="upload" class="h-8 w-8 text-[#8a6a1e]"></i>
                </div>
                <p class="mt-4 text-muted-foreground">Belum ada gambar yang ditambahkan.</p>
            </div>
        @endforelse
    </div>
@endsection

@push('scripts')
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin mau hapus?',
                text: "Data ini akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1F6B3D',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-' + id).submit();
                }
            });
        }
    </script>
@endpush
