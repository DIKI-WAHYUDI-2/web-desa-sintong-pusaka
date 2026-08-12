@extends('layouts.admin')

@section('title', 'Kelola Aparat Desa')
@section('page-title', 'Kelola Aparat Desa')
@section('page-subtitle', 'Kelola data aparat dan perangkat desa')

@section('content')
    <div class="rounded-3xl border border-border bg-white shadow-sm">
        <div class="flex flex-col gap-3 border-b border-border px-6 py-5 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="flex items-center gap-2 text-lg font-semibold text-foreground">
                    <i data-lucide="users" class="h-5 w-5 text-primary"></i>
                    Daftar Aparat Desa
                </h2>
                <p class="mt-1 text-sm text-muted-foreground">Kelola perangkat dan struktur pemerintahan desa</p>
            </div>
            <a href="{{ route('aparat_desa.create') }}" class="btn-primary">
                <i data-lucide="user-plus" class="h-4 w-4"></i>
                Tambah Aparat
            </a>
        </div>

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-slate-700">
                    <thead class="bg-slate-50">
                        <tr class="text-xs font-semibold uppercase tracking-wide text-slate-500">
                            <th class="px-6 py-4 text-center">Nama</th>
                            <th class="px-6 py-4 text-center">Jabatan</th>
                            <th class="px-6 py-4 text-center">Periode Jabatan</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($aparat as $item)
                            <tr class="transition-colors duration-200 hover:bg-slate-50"> <!-- Nama + Foto -->
                                <td class="px-6 py-5 text-center">
                                    <div class="mx-auto flex w-36 flex-col items-center gap-3">
                                        <div
                                            class="h-14 w-14 overflow-hidden rounded-full border-2 border-slate-200 bg-slate-100 shadow-sm">
                                            @if ($item->foto)
                                                <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}"
                                                    class="h-full w-full object-cover">
                                            @else
                                                <div
                                                    class="flex h-full w-full items-center justify-center text-xs font-bold text-primary">
                                                    {{ strtoupper(substr($item->nama, 0, 2)) }} </div>
                                            @endif
                                        </div>
                                        <div class="text-center">
                                            <p class="text-sm font-semibold leading-tight text-slate-800">
                                                {{ $item->nama }} </p>
                                        </div>
                                    </div>
                                </td>

                                <!-- Jabatan -->
                                <td class="px-6 py-5 text-center">
                                    <span
                                        class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-1.5 text-xs font-semibold text-emerald-700">
                                        {{ $item->jabatan }}
                                    </span>
                                </td>

                                <!-- Periode Jabatan -->
                                <td class="px-6 py-5 text-center">
                                    <div class="space-y-1">
                                        <p class="font-medium text-slate-700">
                                            {{ \Carbon\Carbon::parse($item->mulai_jabatan)->translatedFormat('d M Y') }}
                                        </p>
                                        <p class="text-xs text-slate-400">
                                            @if ($item->akhir_jabatan)
                                                {{ \Carbon\Carbon::parse($item->akhir_jabatan)->translatedFormat('d M Y') }}
                                            @else
                                                Sekarang
                                            @endif
                                        </p>
                                    </div>
                                </td> <!-- Status -->
                                <td class="px-6 py-5 text-center"> <span
                                        class="inline-flex items-center gap-2 rounded-full px-3 py-1.5 text-xs font-semibold {{ $item->status_aktif ? 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200' : 'bg-slate-100 text-slate-600 ring-1 ring-slate-200' }}">
                                        <span
                                            class="h-2 w-2 rounded-full {{ $item->status_aktif ? 'bg-emerald-500' : 'bg-slate-400' }}"></span>
                                        {{ $item->status_aktif ? 'Aktif' : 'Tidak Aktif' }} </span> </td> <!-- Aksi -->
                                <td class="px-6 py-5 text-center">
                                    <div class="flex items-center justify-center gap-2"> <a
                                            href="{{ route('aparat_desa.edit', $item->id) }}"
                                            class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs font-medium text-slate-700 transition hover:border-primary/30 hover:text-primary hover:shadow-sm">
                                            <i data-lucide="pencil" class="h-3.5 w-3.5"></i> Edit </a>
                                        <form id="delete-{{ $item->id }}"
                                            action="{{ route('aparat_desa.destroy', $item->id) }}" method="POST"
                                            onsubmit="event.preventDefault(); confirmDelete('{{ $item->id }}')"> @csrf
                                            @method('DELETE') <button type="submit"
                                                class="inline-flex items-center gap-1.5 rounded-lg border border-red-200 bg-white px-3 py-2 text-xs font-medium text-red-600 transition hover:bg-red-50 hover:shadow-sm">
                                                <i data-lucide="trash-2" class="h-3.5 w-3.5"></i> Hapus </button> </form>
                                    </div>
                                </td>
                        </tr> @empty <tr>
                                <td colspan="5" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center">
                                        <div
                                            class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-slate-100">
                                            <i data-lucide="users" class="h-8 w-8 text-slate-400"></i>
                                        </div>
                                        <p class="text-base font-semibold text-slate-700"> Belum ada data aparat desa </p>
                                        <p class="mt-1 text-sm text-slate-500"> Tambahkan data aparat desa terlebih dahulu
                                        </p> <a href="{{ route('aparat_desa.create') }}"
                                            class="mt-4 inline-flex items-center gap-2 rounded-lg bg-primary px-4 py-2 text-sm font-medium text-white transition hover:bg-primary/90">
                                            Tambah Aparat </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if ($aparat->hasPages())
        <div class="rounded-3xl border border-border bg-white p-4 shadow-sm">
            {{ $aparat->links() }}
        </div>
    @endif
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
