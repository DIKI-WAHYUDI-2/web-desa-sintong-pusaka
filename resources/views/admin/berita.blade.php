<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kepenghuluan Sintong Pusaka - Kabupaten Rokan Hilir</title>
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
                    <h1 class="text-2xl font-bold">Kelola Berita</h1>
                    <p class="text-gray-600 mt-1">Kelola semua berita dan artikel</p>
                </div>
                <a href="{{ route('berita.create') }}"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-sm transition">
                    + Tambah Berita
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
                            <th class="p-3">Gambar</th>
                            <th class="p-3">Tanggal</th>
                            <th class="p-3">Judul</th>
                            <th class="p-3">Organisasi</th>
                            <th class="p-3">Kategori</th>
                            <th class="p-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @foreach ($berita as $item)
                            <tr class="border-t border-gray-200 hover:bg-gray-50 transition">
                                <td class="p-3 w-32">
                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}"
                                        class="w-full h-20 object-cover rounded">
                                </td>
                                <td class="p-3 font-medium">{{ $item->judul }}</td>
                                <td class="p-3">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</td>
                                <td class="p-3">{{ $item->organisasi }}</td>
                                <td class="p-3">{{ $item->kategori }}</td>
                                <td class="p-3 text-right space-x-2">
                                    <a href="{{ route('berita.edit', $item->id) }}"
                                        class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg text-sm transition">
                                        Edit
                                    </a>
                                    <form id="delete-{{ $item->id }}"
                                        onsubmit="event.preventDefault(); confirmDelete('{{ $item->id }}')"
                                        action="{{ route('berita.destroy', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm transition">
                                            >
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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