<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($aparat) ? 'Edit Aparat Desa' : 'Tambah Aparat Desa' }} - Kepenghuluan Sintong Pusaka</title>
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/5/5a/Lambang_Kabupaten_Rokan_Hilir.png"
        type="image/png">

    {{-- Lucide Icons --}}
    <script src="https://unpkg.com/lucide@latest"></script>

    {{-- Load Tailwind & Alpine (via Vite) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-900">
    <div class="flex">
        <!-- SIDEBAR -->
        @include('components.sidebar');

        <!-- MAIN CONTENT -->
        <main class="ml-64 flex-1 p-6">
            <div class="max-w-4xl mx-auto">
                <!-- Header -->
                <div class="mb-6">
                    <h1 class="text-2xl font-bold">
                        {{ isset($aparat) ? 'Edit Aparat Desa' : 'Tambah Aparat Desa Baru' }}
                    </h1>
                    <p class="text-gray-600 mt-1">
                        {{ isset($aparat) ? 'Perbarui data aparat desa' : 'Tambahkan data aparat desa baru' }}
                    </p>
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

                <!-- Form -->
                <form action="{{ isset($aparat) ? route('aparat.update', $aparat->id) : route('aparat.store') }}"
                    method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6">
                    @csrf
                    @if(isset($aparat))
                        @method('PUT')
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama -->
                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" id="nama" name="nama" value="{{ old('nama', $aparat->nama ?? '') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required>
                            @error('nama')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jabatan -->
                        <div>
                            <label for="jabatan" class="block text-sm font-medium text-gray-700 mb-1">Jabatan</label>
                            <input type="text" id="jabatan" name="jabatan"
                                value="{{ old('jabatan', $aparat->jabatan ?? '') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required>
                            @error('jabatan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Mulai Jabatan -->
                        <div>
                            <label for="mulai_jabatan" class="block text-sm font-medium text-gray-700 mb-1">Mulai
                                Jabatan</label>
                            <input type="date" id="mulai_jabatan" name="mulai_jabatan"
                                value="{{ old('mulai_jabatan', isset($aparat) ? \Carbon\Carbon::parse($aparat->mulai_jabatan)->format('Y-m-d') : '') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required>
                            @error('mulai_jabatan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Akhir Jabatan -->
                        <div>
                            <label for="akhir_jabatan" class="block text-sm font-medium text-gray-700 mb-1">Akhir
                                Jabatan</label>
                            <input type="date" id="akhir_jabatan" name="akhir_jabatan"
                                value="{{ old('akhir_jabatan', isset($aparat) && $aparat->akhir_jabatan ? \Carbon\Carbon::parse($aparat->akhir_jabatan)->format('Y-m-d') : '') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('akhir_jabatan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status Aktif -->
                        <div>
                            <label for="status_aktif" class="block text-sm font-medium text-gray-700 mb-1">Status
                                Aktif</label>
                            <select id="status_aktif" name="status_aktif"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required>
                                <option value="1" {{ old('status_aktif', $aparat->status_aktif ?? '') == 1 ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ old('status_aktif', $aparat->status_aktif ?? '') == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                            @error('status_aktif')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Foto -->
                        <div class="md:col-span-2">
                            <label for="foto" class="block text-sm font-medium text-gray-700 mb-1">Foto</label>
                            <input type="file" id="foto" name="foto" accept="image/*"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('foto')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                            <!-- Preview Foto -->
                            @if(isset($aparat) && $aparat->foto)
                                <div class="mt-3">
                                    <p class="text-sm text-gray-600 mb-1">Foto Saat Ini:</p>
                                    <img src="{{ asset('storage/' . $aparat->foto) }}" alt="Foto {{ $aparat->nama }}"
                                        class="w-32 h-32 object-cover rounded-md border">
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-3 mt-8 pt-6 border-t border-gray-200">
                        <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 flex items-center gap-2">
                            <i data-lucide="save" class="w-4 h-4"></i>
                            {{ isset($aparat) ? 'Simpan Perubahan' : 'Tambah Aparat' }}
                        </button>
                        <a href="{{ route('aparat') }}"
                            class="px-6 py-2 border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 flex items-center gap-2">
                            <i data-lucide="arrow-left" class="w-4 h-4"></i>
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        // Inisialisasi Lucide Icons
        lucide.createIcons();

        // Validasi form sederhana
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('form');
            form.addEventListener('submit', function (e) {
                const mulaiJabatan = document.getElementById('mulai_jabatan').value;
                const akhirJabatan = document.getElementById('akhir_jabatan').value;

                if (akhirJabatan && new Date(akhirJabatan) < new Date(mulaiJabatan)) {
                    e.preventDefault();
                    alert('Akhir jabatan tidak boleh sebelum mulai jabatan!');
                }
            });
        });
    </script>
</body>

</html>