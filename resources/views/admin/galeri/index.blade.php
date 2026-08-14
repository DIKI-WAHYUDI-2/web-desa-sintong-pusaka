@extends('layouts.admin')

@section('title', 'Kelola Galeri')
@section('page-title', 'Kelola Galeri')
@section('page-subtitle', 'Kelola semua gambar dan dokumentasi kegiatan desa')

@section('content')

    {{-- Statistik --}}
    <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

        <div class="admin-card rounded-3xl p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-muted-foreground">Total Album</p>
                    <p class="mt-2 text-3xl font-bold text-foreground">{{ $galeri->total() }}</p>
                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-primary/10 text-primary">
                    <i data-lucide="images" class="h-6 w-6"></i>
                </div>
            </div>
        </div>

        <div class="admin-card rounded-3xl p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-muted-foreground">Total Foto</p>
                    <p class="mt-2 text-3xl font-bold text-foreground">
                        {{ $galeri->sum(fn($g) => $g->fotos->count()) }}
                    </p>
                </div>

                <div
                    class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-blue-700 dark:bg-blue-500/20 dark:text-blue-300">
                    <i data-lucide="image" class="h-6 w-6"></i>
                </div>
            </div>
        </div>

        <div class="admin-card rounded-3xl p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-muted-foreground">Kategori Aktif</p>
                    <p class="mt-2 text-3xl font-bold text-foreground">
                        {{ $galeri->pluck('kategori')->unique()->count() }}
                    </p>
                </div>

                <div
                    class="flex h-12 w-12 items-center justify-center rounded-2xl bg-purple-100 text-purple-700 dark:bg-purple-500/20 dark:text-purple-300">
                    <i data-lucide="tags" class="h-6 w-6"></i>
                </div>
            </div>
        </div>

        <div class="admin-card rounded-3xl p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-muted-foreground">Organisasi</p>
                    <p class="mt-2 text-3xl font-bold text-foreground">
                        {{ $galeri->pluck('organisasi')->unique()->count() }}
                    </p>
                </div>

                <div
                    class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-300">
                    <i data-lucide="building-2" class="h-6 w-6"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Header + Toolbar --}}
    <div class="admin-card mb-6 rounded-3xl overflow-hidden">

        {{-- Header --}}
        <div class="flex flex-col gap-4 border-b border-border px-6 py-5 lg:flex-row lg:items-center lg:justify-between">

            <div>
                <h2 class="flex items-center gap-2 text-lg font-semibold text-foreground">
                    <i data-lucide="images" class="h-5 w-5 text-primary"></i>
                    Daftar Galeri
                </h2>

                <p class="mt-1 text-sm text-muted-foreground">
                    Kelola album foto kegiatan dan dokumentasi desa
                </p>
            </div>

            <a href="{{ route('galeri.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-primary/25 transition hover:bg-primary/90">
                <i data-lucide="plus" class="h-4 w-4"></i>
                Tambah Album
            </a>
        </div>

        {{-- Toolbar --}}
        <div class="flex flex-col gap-4 px-6 py-4 lg:flex-row lg:items-center lg:justify-between">

            {{-- Search --}}
            <form method="GET" action="{{ route('galeri.index') }}" class="relative w-full lg:max-w-sm">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex w-10 items-center justify-center">
                    <i data-lucide="search" class="h-4 w-4 text-muted-foreground"></i>
                </div>

                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul berita..."
                    class="admin-input h-11 w-full rounded-xl pl-10 {{ request('search') ? 'pr-20' : 'pr-16' }}">

                <div class="absolute inset-y-0 right-1 flex items-center gap-1">
                    @if (request('search'))
                        <a href="{{ route('galeri.index') }}"
                            class="flex h-8 w-8 items-center justify-center rounded-lg text-muted-foreground transition hover:bg-muted hover:text-destructive">
                            <i data-lucide="x" class="h-4 w-4"></i>
                        </a>
                    @endif

                    <button type="submit"
                        class="inline-flex h-8 items-center justify-center rounded-lg bg-primary px-3 text-sm font-medium text-white transition hover:opacity-90">
                        Cari
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Grid Galeri --}}
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">

        @forelse ($galeri as $item)
            <div
                class="group overflow-hidden rounded-3xl border border-border bg-background shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">

                {{-- Cover --}}
                <div class="relative overflow-hidden">

                    @if ($item->fotos->isNotEmpty())
                        <img src="{{ asset('storage/' . $item->fotos->first()->gambar) }}" alt="{{ $item->judul }}"
                            class="h-56 w-full object-cover transition-transform duration-500 group-hover:scale-105">
                    @else
                        <div class="flex h-56 w-full items-center justify-center bg-muted text-muted-foreground">
                            <div class="text-center">
                                <i data-lucide="image-off" class="mx-auto h-10 w-10"></i>
                                <p class="mt-2 text-sm">Belum ada foto</p>
                            </div>
                        </div>
                    @endif

                    {{-- Gradient overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent"></div>

                    {{-- Kategori --}}
                    <div class="absolute left-4 top-4">
                        <span
                            class="inline-flex items-center rounded-full bg-white/95 px-3 py-1 text-xs font-semibold text-primary shadow-sm backdrop-blur">
                            {{ $item->kategori }}
                        </span>
                    </div>

                    {{-- Jumlah foto --}}
                    <div class="absolute right-4 top-4">
                        <span
                            class="inline-flex items-center gap-1 rounded-full bg-black/55 px-2.5 py-1 text-xs font-medium text-white backdrop-blur">
                            <i data-lucide="image" class="h-3.5 w-3.5"></i>
                            {{ $item->fotos->count() }}
                        </span>
                    </div>

                    {{-- Quick actions --}}
                    <div
                        class="absolute bottom-4 right-4 flex gap-2 opacity-0 transition-opacity duration-300 group-hover:opacity-100">

                        <a href="{{ route('galeri.edit', $item->id) }}"
                            class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-white/90 text-foreground shadow-lg backdrop-blur transition hover:bg-white"
                            title="Edit">
                            <i data-lucide="pencil" class="h-4 w-4"></i>
                        </a>

                        <form action="{{ route('galeri.destroy', $item->id) }}" method="POST"
                            id="delete-{{ $item->id }}"
                            onsubmit="event.preventDefault(); confirmDelete('{{ $item->id }}')">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-red-500/90 text-white shadow-lg backdrop-blur transition hover:bg-red-500"
                                title="Hapus">
                                <i data-lucide="trash-2" class="h-4 w-4"></i>
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Content --}}
                <div class="p-5">

                    <div class="flex items-start justify-between gap-3">

                        <div class="min-w-0 flex-1">

                            <h3 class="line-clamp-2 text-base font-semibold text-foreground">
                                {{ $item->judul }}
                            </h3>

                            <div class="mt-2 flex items-center gap-2 text-sm text-muted-foreground">
                                <i data-lucide="building-2" class="h-4 w-4 text-primary"></i>
                                <span class="line-clamp-1">{{ $item->organisasi }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Footer --}}
                    <div
                        class="mt-4 flex items-center justify-between border-t border-border pt-4 text-sm text-muted-foreground">

                        <span class="flex items-center gap-1">
                            <i data-lucide="calendar-days" class="h-4 w-4"></i>
                            {{ $item->created_at?->translatedFormat('d M Y') ?? '-' }}
                        </span>

                        <span class="font-medium text-foreground">
                            {{ $item->fotos->count() }} foto
                        </span>
                    </div>
                </div>
            </div>

        @empty
            <div class="col-span-full">
                <div class="admin-card rounded-3xl py-20 text-center">

                    <div
                        class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-primary/10 text-primary">
                        <i data-lucide="images" class="h-10 w-10"></i>
                    </div>

                    <h3 class="mt-6 text-lg font-semibold text-foreground">
                        Belum ada album galeri
                    </h3>

                    <p class="mt-2 text-sm text-muted-foreground">
                        Tambahkan album pertama untuk mulai mendokumentasikan kegiatan desa.
                    </p>

                    <a href="{{ route('galeri.create') }}"
                        class="mt-6 inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-primary/25 transition hover:bg-primary/90">
                        <i data-lucide="plus" class="h-4 w-4"></i>
                        Tambah Album
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if ($galeri->hasPages())
        <div class="admin-card mt-6 rounded-3xl px-6 py-4">

            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                <p class="text-sm text-muted-foreground">
                    Menampilkan
                    <span class="font-medium text-foreground">{{ $galeri->firstItem() }}</span>
                    -
                    <span class="font-medium text-foreground">{{ $galeri->lastItem() }}</span>
                    dari
                    <span class="font-medium text-foreground">{{ $galeri->total() }}</span>
                    album
                </p>

                {{ $galeri->links() }}
            </div>
        </div>
    @endif

@endsection

@push('scripts')
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Hapus album galeri?',
                text: 'Semua foto di dalam album ini akan ikut terhapus.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0F4C3A',
                cancelButtonColor: '#DC2626',
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-3xl',
                    confirmButton: 'rounded-xl',
                    cancelButton: 'rounded-xl'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-' + id).submit();
                }
            });
        }
    </script>
@endpush
