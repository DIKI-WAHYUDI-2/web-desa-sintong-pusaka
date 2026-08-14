@extends('layouts.admin')

@section('title', 'Kelola Aparat Desa')
@section('page-title', 'Kelola Aparat Desa')
@section('page-subtitle', 'Kelola data aparat dan perangkat desa')

@section('content')

    {{-- Statistik --}}
    <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

        <div class="admin-card rounded-3xl p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-muted-foreground">Total Aparat</p>
                    <p class="mt-2 text-3xl font-bold text-foreground">{{ $aparat_desa->total() }}</p>
                </div>

                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-primary/10 text-primary">
                    <i data-lucide="users" class="h-6 w-6"></i>
                </div>
            </div>
        </div>

        <div class="admin-card rounded-3xl p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-muted-foreground">Aparat Aktif</p>
                    <p class="mt-2 text-3xl font-bold text-foreground">
                        {{ $aparat_desa->where('status_aktif', 1)->count() }}
                    </p>
                </div>

                <div
                    class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-300">
                    <i data-lucide="check-circle-2" class="h-6 w-6"></i>
                </div>
            </div>
        </div>

        <div class="admin-card rounded-3xl p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-muted-foreground">Tidak Aktif</p>
                    <p class="mt-2 text-3xl font-bold text-foreground">
                        {{ $aparat_desa->where('status_aktif', 0)->count() }}
                    </p>
                </div>

                <div
                    class="flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-100 text-slate-700 dark:bg-slate-500/20 dark:text-slate-300">
                    <i data-lucide="x-circle" class="h-6 w-6"></i>
                </div>
            </div>
        </div>

        <div class="admin-card rounded-3xl p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-muted-foreground">Jabatan Aktif</p>
                    <p class="mt-2 text-3xl font-bold text-foreground">
                        {{ $aparat_desa->pluck('jabatan')->unique()->count() }}
                    </p>
                </div>

                <div
                    class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-blue-700 dark:bg-blue-500/20 dark:text-blue-300">
                    <i data-lucide="briefcase" class="h-6 w-6"></i>
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
                    <i data-lucide="users" class="h-5 w-5 text-primary"></i>
                    Daftar Aparat Desa
                </h2>

                <p class="mt-1 text-sm text-muted-foreground">
                    Kelola perangkat dan struktur pemerintahan desa
                </p>
            </div>

            <a href="{{ route('aparat_desa.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-primary/25 transition hover:bg-primary/90">
                <i data-lucide="user-plus" class="h-4 w-4"></i>
                Tambah Aparat
            </a>
        </div>

        {{-- Toolbar --}}
        <div class="flex flex-col gap-4 border-b border-border px-6 py-4 lg:flex-row lg:items-center lg:justify-between">

            {{-- Search --}}
            <form method="GET" action="{{ route('aparat_desa.index') }}" class="relative w-full lg:max-w-sm">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex w-10 items-center justify-center">
                    <i data-lucide="search" class="h-4 w-4 text-muted-foreground"></i>
                </div>

                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama aparat..."
                    class="admin-input h-11 w-full rounded-xl pl-10 {{ request('search') ? 'pr-20' : 'pr-16' }}">

                <div class="absolute inset-y-0 right-1 flex items-center gap-1">
                    @if (request('search'))
                        <a href="{{ route('aparat_desa.index') }}"
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
                        <th class="px-6 py-4 font-medium">Aparat</th>
                        <th class="px-6 py-4 font-medium">Jabatan</th>
                        <th class="px-6 py-4 font-medium">Masa Jabatan</th>
                        <th class="px-6 py-4 font-medium">Status</th>
                        <th class="px-6 py-4 text-right font-medium">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-border">

                    @forelse ($aparat_desa as $index => $item)
                        <tr
                            class="transition-colors hover:bg-muted/30 {{ $index % 2 == 0 ? 'bg-background' : 'bg-muted/5' }}">

                            {{-- Aparat --}}
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-4">

                                    <div
                                        class="h-14 w-14 shrink-0 overflow-hidden rounded-2xl border border-border bg-muted shadow-sm">

                                        @if ($item->foto)
                                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}"
                                                class="h-full w-full object-cover">
                                        @else
                                            <div
                                                class="flex h-full w-full items-center justify-center bg-primary/10 text-primary">
                                                <span class="text-sm font-bold">
                                                    {{ strtoupper(substr($item->nama, 0, 2)) }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="min-w-0 flex-1">

                                        <div class="flex items-center gap-2">
                                            <h3 class="line-clamp-1 max-w-[220px] font-semibold text-foreground">
                                                {{ \Illuminate\Support\Str::limit($item->nama, 28) }}
                                            </h3>

                                            @if ($item->status_aktif)
                                                <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                                            @endif
                                        </div>

                                        <p class="mt-1 text-sm text-muted-foreground">
                                            {{ $item->jabatan }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            {{-- Jabatan --}}
                            <td class="px-6 py-5">
                                <span
                                    class="inline-flex items-center gap-2 rounded-full border border-primary/20 bg-primary/5 px-3 py-1.5 text-xs font-semibold text-primary">
                                    <i data-lucide="briefcase" class="h-3.5 w-3.5"></i>
                                    {{ $item->jabatan }}
                                </span>
                            </td>

                            {{-- Masa Jabatan --}}
                            <td class="px-6 py-5">
                                <div class="space-y-1">

                                    <div class="flex items-center gap-2 text-foreground">
                                        <i data-lucide="calendar" class="h-4 w-4 text-primary"></i>
                                        <span class="font-medium">
                                            {{ \Carbon\Carbon::parse($item->mulai_jabatan)->translatedFormat('d M Y') }}
                                        </span>
                                    </div>

                                    <div class="pl-6 text-sm text-muted-foreground">
                                        @if ($item->akhir_jabatan)
                                            s/d
                                            {{ \Carbon\Carbon::parse($item->akhir_jabatan)->translatedFormat('d M Y') }}
                                        @else
                                            Masih menjabat
                                        @endif
                                    </div>
                                </div>
                            </td>

                            {{-- Status --}}
                            <td class="px-6 py-5">
                                <span
                                    class="inline-flex items-center gap-2 rounded-full px-3 py-1.5 text-xs font-semibold {{ $item->status_aktif ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-300' : 'bg-slate-100 text-slate-700 dark:bg-slate-500/20 dark:text-slate-300' }}">

                                    <span
                                        class="h-2 w-2 rounded-full {{ $item->status_aktif ? 'bg-emerald-500' : 'bg-slate-400' }}"></span>

                                    {{ $item->status_aktif ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </td>

                            {{-- Aksi --}}
                            <td class="px-6 py-5">
                                <div class="flex items-center justify-end gap-2">

                                    <a href="{{ route('aparat_desa.edit', $item->id) }}"
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-xl border border-border text-muted-foreground transition hover:bg-muted hover:text-foreground"
                                        title="Edit">
                                        <i data-lucide="pencil" class="h-4 w-4"></i>
                                    </a>

                                    <form id="delete-{{ $item->id }}"
                                        action="{{ route('aparat_desa.destroy', $item->id) }}" method="POST"
                                        onsubmit="event.preventDefault(); confirmDelete('{{ $item->id }}')"
                                        class="inline">
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
                                        <i data-lucide="users" class="h-10 w-10"></i>
                                    </div>

                                    <h3 class="mt-6 text-lg font-semibold text-foreground">
                                        Belum ada data aparat desa
                                    </h3>

                                    <p class="mt-2 text-sm text-muted-foreground">
                                        Tambahkan data aparat desa terlebih dahulu untuk ditampilkan pada struktur
                                        pemerintahan desa.
                                    </p>

                                    <a href="{{ route('aparat_desa.create') }}"
                                        class="mt-6 inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-primary/25 transition hover:bg-primary/90">
                                        <i data-lucide="user-plus" class="h-4 w-4"></i>
                                        Tambah Aparat
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        {{-- Footer --}}
        @if ($aparat_desa->hasPages())
            <div
                class="flex flex-col gap-4 border-t border-border px-6 py-4 sm:flex-row sm:items-center sm:justify-between">

                <p class="text-sm text-muted-foreground">
                    Menampilkan
                    <span class="font-medium text-foreground">{{ $aparat_desa->firstItem() }}</span>
                    -
                    <span class="font-medium text-foreground">{{ $aparat_desa->lastItem() }}</span>
                    dari
                    <span class="font-medium text-foreground">{{ $aparat_desa->total() }}</span>
                    data aparat
                </p>

                {{ $aparat_desa->links() }}
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin mau hapus?',
                text: 'Data aparat desa yang dihapus tidak dapat dikembalikan.',
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
