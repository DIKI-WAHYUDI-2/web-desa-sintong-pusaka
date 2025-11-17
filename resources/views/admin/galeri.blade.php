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

<body class="bg-gray-100 text-gray-900">
    <div class="flex">
        {{-- Sidebar --}}
        @include('components.sidebar');

        {{-- Main Content --}}
        <main class="ml-64 flex-1 p-6 space-y-6">
            <!-- Header -->
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold">Kelola Galeri</h1>
                    <p class="text-gray-600 mt-1">Kelola semua gambar dan dokumentasi</p>
                </div>
                <a href="{{ route('galeri.create') }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center gap-2 hover:bg-blue-700">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    Tambah Gambar
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

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($galeri as $item)
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        @if($item->fotos->isNotEmpty())
                            <img src="{{ asset('storage/' . $item->fotos->first()->gambar) }}" alt="Foto {{ $item->judul }}"
                                class="w-full h-48 object-cover rounded">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center rounded">
                                Tidak ada foto
                            </div>
                        @endif
                        <div class="p-4 flex items-center justify-between gap-2">
                            <h3 class="font-medium text-gray-800 truncate max-w-[70%]">
                                {{$item->judul}} || {{ $item->kategori }} || {{ $item->organisasi }}
                            </h3>
                            <div class="flex gap-2 shrink-0">
                                <a href="{{ route('galeri.edit', $item->id) }}"
                                    class="px-2 py-1 border rounded hover:bg-gray-100">
                                    <i data-lucide="edit" class="w-4 h-4"></i>
                                </a>
                                <form action="{{ route('galeri.destroy', $item->id) }}" method="POST"
                                    id="delete-{{ $item->id }}"
                                    onsubmit="event.preventDefault(); confirmDelete('{{ $item->id }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2 py-1 border rounded text-red-600 hover:bg-red-50">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    {{-- Kalau kosong --}}
                    <div class="col-span-full text-center py-20 bg-white rounded-lg shadow">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto">
                            <i data-lucide="upload" class="w-8 h-8 text-gray-400"></i>
                        </div>
                        <p class="mt-4 text-gray-600">Belum ada gambar yang ditambahkan.</p>
                    </div>
                @endforelse
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