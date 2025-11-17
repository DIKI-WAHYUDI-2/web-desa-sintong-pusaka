<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Aparat Desa - Kepenghuluan Sintong Pusaka</title>
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/5/5a/Lambang_Kabupaten_Rokan_Hilir.png"
        type="image/png">
    {{-- Lucide Icons --}}
    <script src="https://unpkg.com/lucide@latest"></script>

    {{-- Load Tailwind & Alpine (via Vite) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-900">
    <div class="flex min-h-screen">
        <!-- SIDEBAR -->
        @include('components.sidebar');

        {{-- Konten --}}
        <main class="flex-1 ml-64 p-6 space-y-6">
            {{-- Header --}}
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold">Kelola Aparat Desa</h1>
                    <p class="text-gray-600 mt-1">Kelola data aparat dan perangkat desa</p>
                </div>
                <a href="{{ route('aparat.create') }}"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-sm transition flex items-center gap-2">
                    <i data-lucide="user-plus" class="w-4 h-4"></i>
                    Tambah Aparat
                </a>
            </div>

            @if(session('success'))
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    Swal.fire({
                        title: 'Sukses!',
                        text: '{{ session('success') }}',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                </script>
            @endif

            @if($errors->any())
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    Swal.fire({
                        title: 'Terjadi Kesalahan!',
                        icon: 'error',
                        html: `
                                                                                  <ul style="text-align:left;">
                                                                                      @foreach ($errors->all() as $error)
                                                                                        <li>{{ $error }}</li>
                                                                                      @endforeach
                                                                                  </ul>
                                                                              `,
                        confirmButtonText: 'OK'
                    });
                </script>
            @endif

            {{-- Tabel --}}
            <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-100 text-sm font-medium text-gray-700">
                        <tr>
                            <th class="p-3">Foto</th>
                            <th class="p-3">Nama</th>
                            <th class="p-3">Jabatan</th>
                            <th class="p-3">Periode Jabatan</th>
                            <th class="p-3">Status</th>
                            <th class="p-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @forelse ($aparat as $item)
                            <tr class="border-t border-gray-200 hover:bg-gray-50 transition">
                                <td class="p-3 w-20">
                                    @if($item->foto)
                                        <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}"
                                            class="w-16 h-16 object-cover border-2 border-gray-300">
                                    @else
                                        <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center">
                                            <i data-lucide="user" class="w-8 h-8 text-gray-400"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="p-3 font-medium">{{ $item->nama }}</td>
                                <td class="p-3">{{ $item->jabatan }}</td>
                                <td class="p-3">
                                    {{ \Carbon\Carbon::parse($item->mulai_jabatan)->translatedFormat('d M Y') }}
                                    @if($item->akhir_jabatan)
                                        - {{ \Carbon\Carbon::parse($item->akhir_jabatan)->translatedFormat('d M Y') }}
                                    @else
                                        - Sekarang
                                    @endif
                                </td>
                                <td class="p-3">
                                    <span
                                        class="px-2 py-1 rounded-full text-xs font-medium 
                                                                    {{ $item->status_aktif ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $item->status_aktif ? 'Aktif' : 'Tidak Aktif' }}
                                    </span>
                                </td>
                                <td class="p-3 text-right space-x-2">
                                    <a href="{{ route('aparat.edit', $item->id) }}"
                                        class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg text-sm transition inline-flex items-center gap-1">
                                        <i data-lucide="edit" class="w-3 h-3"></i>
                                        Edit
                                    </a>
                                    <form id="delete-{{ $item->id }}" action="{{ route('aparat.destroy', $item->id) }}"
                                        method="POST" class="inline"
                                        onsubmit="event.preventDefault(); confirmDelete('{{ $item->id }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm transition inline-flex items-center gap-1">
                                            <i data-lucide="trash-2" class="w-3 h-3"></i>
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-8 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <i data-lucide="users" class="w-12 h-12 text-gray-300 mb-4"></i>
                                        <p class="text-lg font-medium">Belum ada data aparat desa</p>
                                        <p class="text-sm">Tambahkan data aparat desa terlebih dahulu</p>
                                        <a href="{{ route('aparat.create') }}"
                                            class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                            Tambah Aparat
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($aparat->hasPages())
                <div class="bg-white rounded-xl shadow-sm p-4">
                    {{ $aparat->links() }}
                </div>
            @endif
        </main>
    </div>

    <script>
        lucide.createIcons();
        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin mau hapus?',
                text: "Data ini akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
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
</body>

</html>