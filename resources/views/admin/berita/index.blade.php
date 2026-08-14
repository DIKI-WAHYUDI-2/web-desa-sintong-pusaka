@extends('layouts.admin')

@section('title', 'Kelola Berita')
@section('page-title', 'Kelola Berita')
@section('page-subtitle', 'Kelola semua berita dan artikel')

@section('content')
    @php
        $kategoriColors = [
            'Politik' => 'bg-red-100 text-red-700 dark:bg-red-500/20 dark:text-red-300',
            'Ekonomi' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-300',
            'Sosial' => 'bg-blue-100 text-blue-700 dark:bg-blue-500/20 dark:text-blue-300',
            'Budaya' => 'bg-purple-100 text-purple-700 dark:bg-purple-500/20 dark:text-purple-300',
            'Olahraga' => 'bg-orange-100 text-orange-700 dark:bg-orange-500/20 dark:text-orange-300',
            'Teknologi' => 'bg-cyan-100 text-cyan-700 dark:bg-cyan-500/20 dark:text-cyan-300',
            'Lingkungan' => 'bg-green-100 text-green-700 dark:bg-green-500/20 dark:text-green-300',
        ];
    @endphp

    {{-- Statistik --}}
    <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <div class="admin-card rounded-3xl p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-muted-foreground">Total Berita</p>
                    <p class="mt-2 text-3xl font-bold text-foreground">{{ $berita->total() }}</p>
                </div>
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-primary/10 text-primary">
                    <i data-lucide="newspaper" class="h-6 w-6"></i>
                </div>
            </div>
        </div>

        <div class="admin-card rounded-3xl p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-muted-foreground">Bulan Ini</p>
                    <p class="mt-2 text-3xl font-bold text-foreground">
                        {{ $berita->where('tanggal', '>=', now()->startOfMonth())->count() }}
                    </p>
                </div>
                <div
                    class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-blue-700 dark:bg-blue-500/20 dark:text-blue-300">
                    <i data-lucide="calendar-days" class="h-6 w-6"></i>
                </div>
            </div>
        </div>

        <div class="admin-card rounded-3xl p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-muted-foreground">Kategori Aktif</p>
                    <p class="mt-2 text-3xl font-bold text-foreground">
                        {{ $berita->pluck('kategori')->unique()->count() }}
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
                    <p class="text-sm text-muted-foreground">Organisasi Aktif</p>
                    <p class="mt-2 text-3xl font-bold text-foreground">
                        {{ $berita->pluck('organisasi')->unique()->count() }}
                    </p>
                </div>
                <div
                    class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-300">
                    <i data-lucide="building-2" class="h-6 w-6"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel --}}
    <div class="admin-card overflow-hidden rounded-3xl">

        {{-- Header --}}
        <div class="flex flex-col gap-4 border-b border-border px-6 py-5 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h2 class="flex items-center gap-2 text-lg font-semibold text-foreground">
                    <i data-lucide="newspaper" class="h-5 w-5 text-primary"></i>
                    Daftar Berita
                </h2>
                <p class="mt-1 text-sm text-muted-foreground">
                    Kelola semua berita dan artikel yang dipublikasikan
                </p>
            </div>

            <a href="{{ route('berita.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-primary/25 transition hover:bg-primary/90">
                <i data-lucide="plus" class="h-4 w-4"></i>
                Tambah Berita
            </a>
        </div>

        {{-- Toolbar --}}
        <div class="flex flex-col gap-4 border-b border-border px-6 py-4 lg:flex-row lg:items-center lg:justify-between">

            {{-- Search --}}
            <form method="GET" action="{{ route('berita.index') }}" class="relative w-full lg:max-w-sm">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex w-10 items-center justify-center">
                    <i data-lucide="search" class="h-4 w-4 text-muted-foreground"></i>
                </div>

                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul berita..."
                    class="admin-input h-11 w-full rounded-xl pl-10 {{ request('search') ? 'pr-20' : 'pr-16' }}">

                <div class="absolute inset-y-0 right-1 flex items-center gap-1">
                    @if (request('search'))
                        <a href="{{ route('berita.index') }}"
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

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">

                <thead class="bg-muted/40">
                    <tr class="text-muted-foreground">
                        <th class="px-6 py-4 font-medium">Berita</th>
                        <th class="px-6 py-4 font-medium">Tanggal</th>
                        <th class="px-6 py-4 font-medium">Organisasi</th>
                        <th class="px-6 py-4 font-medium">Kategori</th>
                        <th class="px-6 py-4 text-right font-medium">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-border">

                    @forelse ($berita as $index => $item)
                        <tr
                            class="transition-colors hover:bg-muted/30 {{ $index % 2 == 0 ? 'bg-background' : 'bg-muted/5' }}">

                            {{-- Berita --}}
                            <td class="px-6 py-5">
                                <div class="flex items-start gap-4">

                                    {{-- Thumbnail --}}
                                    <div
                                        class="h-16 w-24 shrink-0 overflow-hidden rounded-2xl border border-border bg-muted">
                                        @if ($item->gambar)
                                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}"
                                                class="h-full w-full object-cover">
                                        @else
                                            <div
                                                class="flex h-full w-full items-center justify-center bg-primary/5 text-primary">
                                                <span class="text-sm font-bold">
                                                    {{ strtoupper(substr($item->judul, 0, 2)) }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Content --}}
                                    <div class="min-w-0 flex-1">

                                        <div class="flex items-center gap-2">
                                            <h3 class="line-clamp-1 max-w-[470px] font-semibold text-foreground">
                                                {{ \Illuminate\Support\Str::limit($item->judul, 90) }} </h3>

                                            <span class="h-2 w-2 rounded-full bg-green-500"></span>
                                        </div>

                                        <p class="mt-1 line-clamp-2 text-sm text-muted-foreground">
                                            {{ \Illuminate\Support\Str::limit(strip_tags($item->isi), 80) }}
                                        </p>

                                        <div class="mt-2 flex items-center gap-3 text-xs text-muted-foreground">
                                            <span class="flex items-center gap-1">
                                                <i data-lucide="clock-3" class="h-3 w-3"></i>
                                                {{ $item->updated_at?->diffForHumans() }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            {{-- Tanggal --}}
                            <td class="px-6 py-5">
                                <div class="flex flex-col">
                                    <span class="font-medium text-foreground">
                                        {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}
                                    </span>
                                    <span class="text-xs text-muted-foreground">
                                        {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l') }}
                                    </span>
                                </div>
                            </td>

                            {{-- Organisasi --}}
                            <td class="px-6 py-5">
                                <div
                                    class="inline-flex items-center gap-2 rounded-xl bg-muted px-3 py-2 text-sm text-foreground">
                                    <i data-lucide="building-2" class="h-4 w-4 text-primary"></i>
                                    <span class="line-clamp-1 max-w-[160px]">
                                        {{ $item->organisasi }}
                                    </span>
                                </div>
                            </td>

                            {{-- Kategori --}}
                            <td class="px-6 py-5">
                                <span
                                    class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $kategoriColors[$item->kategori] ?? 'bg-muted text-muted-foreground' }}">
                                    {{ $item->kategori }}
                                </span>
                            </td>

                            {{-- Aksi --}}
                            <td class="px-6 py-5">
                                <div class="flex items-center justify-end gap-2">

                                    {{-- View --}}
                                    <a href="#"
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-xl border border-border text-muted-foreground transition hover:bg-muted hover:text-foreground"
                                        title="Lihat">
                                        <i data-lucide="eye" class="h-4 w-4"></i>
                                    </a>

                                    {{-- Edit --}}
                                    <a href="{{ route('berita.edit', $item->id) }}"
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-xl border border-border text-muted-foreground transition hover:bg-muted hover:text-foreground"
                                        title="Edit">
                                        <i data-lucide="pencil" class="h-4 w-4"></i>
                                    </a>

                                    {{-- Delete --}}
                                    <form id="delete-{{ $item->id }}"
                                        onsubmit="event.preventDefault(); confirmDelete('{{ $item->id }}')"
                                        action="{{ route('berita.destroy', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-xl border border-red-200 text-red-600 transition hover:bg-red-50 dark:border-red-500/30 dark:hover:bg-red-500/10"
                                            title="Hapus">
                                            <i data-lucide="trash-2" class="h-4 w-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-20 text-center">

                                <div class="mx-auto flex max-w-sm flex-col items-center">

                                    <div
                                        class="flex h-20 w-20 items-center justify-center rounded-full bg-primary/10 text-primary">
                                        <i data-lucide="newspaper" class="h-10 w-10"></i>
                                    </div>

                                    <h3 class="mt-6 text-lg font-semibold text-foreground">
                                        Belum ada berita
                                    </h3>

                                    <p class="mt-2 text-sm text-muted-foreground">
                                        Mulai tambahkan berita pertama untuk ditampilkan kepada masyarakat.
                                    </p>

                                    <a href="{{ route('berita.create') }}"
                                        class="mt-6 inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-primary/25 transition hover:bg-primary/90">
                                        <i data-lucide="plus" class="h-4 w-4"></i>
                                        Tambah Berita
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        {{-- Footer --}}
        @if ($berita->hasPages())
            <div
                class="flex flex-col gap-4 border-t border-border px-6 py-4 sm:flex-row sm:items-center sm:justify-between">

                <p class="text-sm text-muted-foreground">
                    Menampilkan
                    <span class="font-medium text-foreground">{{ $berita->firstItem() }}</span>
                    -
                    <span class="font-medium text-foreground">{{ $berita->lastItem() }}</span>
                    dari
                    <span class="font-medium text-foreground">{{ $berita->total() }}</span>
                    berita
                </p>

                {{ $berita->links() }}
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin mau hapus?',
                text: 'Berita yang dihapus tidak dapat dikembalikan.',
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
