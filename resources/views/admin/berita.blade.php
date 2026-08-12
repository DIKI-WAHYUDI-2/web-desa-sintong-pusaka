@extends('layouts.admin')

@section('title', 'Kelola Berita')
@section('page-title', 'Kelola Berita')
@section('page-subtitle', 'Kelola semua berita dan artikel')

@section('content')
    <div class="rounded-3xl border border-border bg-white shadow-sm">
        <div class="flex flex-col gap-3 border-b border-border px-6 py-5 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="flex items-center gap-2 text-lg font-semibold text-foreground">
                    <i data-lucide="newspaper" class="h-5 w-5 text-primary"></i>
                    Daftar Berita
                </h2>
                <p class="mt-1 text-sm text-muted-foreground">Kelola semua berita dan artikel yang dipublikasikan</p>
            </div>
            <a href="{{ route('berita.create') }}" class="btn-primary">
                <i data-lucide="plus" class="h-4 w-4"></i>
                Tambah Berita
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-muted/60">
                    <tr class="text-muted-foreground">
                        <th class="px-6 py-3 font-medium">Berita</th>
                        <th class="px-6 py-3 font-medium">Tanggal</th>
                        <th class="px-6 py-3 font-medium">Organisasi</th>
                        <th class="px-6 py-3 font-medium">Kategori</th>
                        <th class="px-6 py-3 text-right font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @forelse ($berita as $item)
                        <tr class="hover:bg-muted/40">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="h-14 w-20 shrink-0 overflow-hidden rounded-xl bg-muted">
                                        @if ($item->gambar)
                                            <img src="{{ asset($item->gambar) }}" alt="{{ $item->judul }}"
                                                class="h-full w-full object-cover">
                                        @else
                                            <div class="flex h-full w-full items-center justify-center text-xs font-semibold text-primary">
                                                {{ strtoupper(substr($item->judul, 0, 2)) }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="max-w-xs truncate font-medium text-foreground">{{ $item->judul }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-muted-foreground">
                                {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                            </td>
                            <td class="px-6 py-4 text-muted-foreground">{{ $item->organisasi }}</td>
                            <td class="px-6 py-4">
                                <span class="rounded-full bg-[#DCF3E3] px-2.5 py-1 text-xs font-semibold text-primary">
                                    {{ $item->kategori }}
                                </span>
                            </td>
                            <td class="space-x-2 px-6 py-4 text-right">
                                <a href="{{ route('berita.edit', $item->id) }}" class="btn-edit">
                                    <i data-lucide="pencil" class="h-3.5 w-3.5"></i>
                                    Edit
                                </a>
                                <form id="delete-{{ $item->id }}"
                                    onsubmit="event.preventDefault(); confirmDelete('{{ $item->id }}')"
                                    action="{{ route('berita.destroy', $item->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-danger">
                                        <i data-lucide="trash-2" class="h-3.5 w-3.5"></i>
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-14 text-center text-muted-foreground">
                                <i data-lucide="newspaper" class="mx-auto mb-3 h-10 w-10 text-muted-foreground/50"></i>
                                Belum ada berita yang ditambahkan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
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
