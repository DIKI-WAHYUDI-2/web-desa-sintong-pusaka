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

<body class="bg-background text-foreground p-6">
    <!-- SIDEBAR -->
    @include('components.sidebar');

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

    <div class="space-y-6 ml-64"> {{-- tambahin ml-64 biar konten ga ketutup sidebar --}}
        <div>
            <h1 class="text-2xl font-bold">Tambah Gambar Baru</h1>
            <p class="text-gray-600 mt-1">Tambahkan gambar baru ke galeri</p>
        </div>

        <form action="{{ isset($galeri) ? route('galeri.update', $galeri->id) : route('galeri.store') }}" method="POST"
            enctype="multipart/form-data" class="bg-white p-6 rounded-2xl shadow space-y-6">
            @csrf
            @if(isset($galeri))
                @method('PUT')
            @endif
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium">Judul</label>
                    <input type="text" name="judul" value="{{ old('judul', $galeri->judul ?? '') }}"
                        class="w-full border rounded px-3 py-2 mt-1" required>
                </div>
                <div>
                    <label class="block text-sm font-medium">Kategori Album *</label>
                    <select name="kategori" class="w-full border rounded px-3 py-2 mt-1" required>
                        @foreach ($kategori as $cat)
                            <option value="{{ $cat }}" {{ old('kategori', $galeri->kategori ?? '') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium">Organisasi</label>
                    <select name="organisasi" class="w-full border rounded px-3 py-2 mt-1" required>
                        @foreach ($organisasi as $org)
                            <option value="{{ $org }}" {{ old('organisasi', $galeri->organisasi ?? '') == $org ? 'selected' : '' }}>{{ $org }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Multiple upload -->
            <input type="file" name="gambar[]" multiple class="border rounded w-full p-2">

            <div class="flex gap-3">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                    {{ isset($galeri) ? 'Simpan Perubahan' : 'Buat Galeri' }}
                </button> <a href="{{ route('galeri') }}" class="px-4 py-2 border rounded">Batal</a>
            </div>
        </form>
    </div>

    {{-- Inisialisasi Lucide --}}
    <script>
        lucide.createIcons();
    </script>
</body>

</html>