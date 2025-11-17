<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Demografis - Kepenghuluan Sintong Pusaka</title>
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
            <div class="bg-white shadow-md rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-6 flex items-center gap-2">
                    <i data-lucide="users" class="w-6 h-6"></i>
                    Data Demografis
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

                <form action="{{ route('demografis.update') }}" method="POST" class="space-y-4">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium">Jumlah Dusun</label>
                            <input type="number" name="jumlah_dusun"
                                value="{{ old('jumlah_dusun', $demografis->jumlah_dusun ?? 0) }}"
                                class="mt-1 block w-full border rounded-lg p-2">
                        </div>

                        <div>
                            <label class="block text-sm font-medium">Jumlah RW</label>
                            <input type="number" name="jumlah_rw"
                                value="{{ old('jumlah_rw', $demografis->jumlah_rw ?? 0) }}"
                                class="mt-1 block w-full border rounded-lg p-2">
                        </div>

                        <div>
                            <label class="block text-sm font-medium">Jumlah RT</label>
                            <input type="number" name="jumlah_rt"
                                value="{{ old('jumlah_rt', $demografis->jumlah_rt ?? 0) }}"
                                class="mt-1 block w-full border rounded-lg p-2">
                        </div>

                        <div>
                            <label class="block text-sm font-medium">Jumlah Keluarga</label>
                            <input type="number" name="jumlah_keluarga"
                                value="{{ old('jumlah_keluarga', $demografis->jumlah_keluarga ?? 0) }}"
                                class="mt-1 block w-full border rounded-lg p-2">
                        </div>

                        <div>
                            <label class="block text-sm font-medium">Jumlah Penduduk</label>
                            <input type="number" name="jumlah_penduduk"
                                value="{{ old('jumlah_penduduk', $demografis->jumlah_penduduk ?? 0) }}"
                                class="mt-1 block w-full border rounded-lg p-2">
                        </div>

                        <div>
                            <label class="block text-sm font-medium">Kepadatan Penduduk</label>
                            <input type="number" name="kepadatan_penduduk"
                                value="{{ old('kepadatan_penduduk', $demografis->kepadatan_penduduk ?? 0) }}"
                                class="mt-1 block w-full border rounded-lg p-2">
                        </div>

                        <div>
                            <label class="block text-sm font-medium">Jumlah Laki-laki</label>
                            <input type="number" name="jumlah_laki_laki"
                                value="{{ old('jumlah_laki_laki', $demografis->jumlah_laki_laki ?? 0) }}"
                                class="mt-1 block w-full border rounded-lg p-2">
                        </div>

                        <div>
                            <label class="block text-sm font-medium">Jumlah Perempuan</label>
                            <input type="number" name="jumlah_perempuan"
                                value="{{ old('jumlah_perempuan', $demografis->jumlah_perempuan ?? 0) }}"
                                class="mt-1 block w-full border rounded-lg p-2">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium">Luas Perkebunan Sawit (Ha)</label>
                            <input type="number" name="luas_perkebunan_sawit"
                                value="{{ old('luas_perkebunan_sawit', $demografis->luas_perkebunan_sawit ?? 0) }}"
                                class="mt-1 block w-full border rounded-lg p-2">
                        </div>
                    </div>

                    <div class="flex justify-end mt-6">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>