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

<body class="bg-background text-foreground">

    <!-- SIDEBAR -->
    @include('components.sidebar');

    <!-- MAIN CONTENT -->
    <main class="ml-64 p-6 space-y-6">
        <h1 class="text-2xl font-bold">
            {{ isset($berita) ? 'Edit Berita' : 'Tambah Berita Baru' }}
        </h1>

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

        <form action="{{ isset($berita) ? route('berita.update', $berita->id) : route('berita.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @if(isset($berita))
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block mb-1 font-medium">Judul</label>
                    <input type="text" name="judul" value="{{ old('judul', $berita->judul ?? '') }}"
                        class="w-full border p-2 rounded">
                </div>
                <div>
                    <label class="block mb-1 font-medium">Kategori</label>
                    <select name="kategori" class="w-full border p-2 rounded">
                        @foreach($kategori as $kat)
                            <option value="{{ $kat }}" {{ old('kategori', $berita->kategori ?? '') == $kat ? 'selected' : '' }}>
                                {{ $kat }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block mb-1 font-medium">Organisasi</label>
                    <select name="organisasi" class="w-full border p-2 rounded">
                        @foreach($organisasi as $org)
                            <option value="{{ $org }}" {{ old('organisasi', $berita->organisasi ?? '') == $org ? 'selected' : '' }}>
                                {{ $org }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mt-4">
                <label class="block mb-1 font-medium">Isi</label>
                <textarea name="isi" rows="6"
                    class="w-full border p-2 rounded">{{ old('isi', $berita->isi ?? '') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
                <div>
                    <label class="block mb-1 font-medium">Tanggal</label>
                    <input type="date" name="tanggal" value="{{ old('tanggal', $berita->tanggal ?? '') }}"
                        class="w-full border p-2 rounded">
                </div>
            </div>

            {{-- Gambar Utama --}}
            <div class="mt-4">
                <label class="block mb-1 font-medium">Gambar Utama</label>
                <input type="file" name="gambar" class="w-full border p-2 rounded">

                @if(isset($berita) && $berita->gambar)
                    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Preview Gambar Utama"
                        class="w-32 h-24 object-cover mt-2 rounded">
                @endif
            </div>

            {{-- Gambar Pendukung 1 --}}
            <div class="mt-4">
                <label class="block mb-1 font-medium">Gambar Pendukung 1</label>
                <input type="file" name="gambar2" class="w-full border p-2 rounded">

                @if(isset($berita) && $berita->gambar2)
                    <img src="{{ asset('storage/' . $berita->gambar2) }}" alt="Preview Gambar Pendukung 1"
                        class="w-32 h-24 object-cover mt-2 rounded">
                @endif
            </div>

            {{-- Gambar Pendukung 2 --}}
            <div class="mt-4">
                <label class="block mb-1 font-medium">Gambar Pendukung 2</label>
                <input type="file" name="gambar3" class="w-full border p-2 rounded">

                @if(isset($berita) && $berita->gambar3)
                    <img src="{{ asset('storage/' . $berita->gambar3) }}" alt="Preview Gambar Pendukung 2"
                        class="w-32 h-24 object-cover mt-2 rounded">
                @endif
            </div>

            <div class="flex gap-3 mt-6">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                    {{ isset($berita) ? 'Simpan Perubahan' : 'Buat Berita' }}
                </button>
                <a href="{{ route('berita') }}" class="px-4 py-2 border rounded">Batal</a>
            </div>
        </form>
    </main>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>