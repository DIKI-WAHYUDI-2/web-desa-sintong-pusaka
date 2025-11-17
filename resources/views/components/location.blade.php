<section id="lokasi" class="py-20 scroll-mt-20 ">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">
                Lokasi & Geografis
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Informasi lengkap mengenai lokasi, kondisi geografis, dan batas wilayah Kepenghuluan Sintong Pusaka
            </p>
        </div>

        @php
            $geographyData = [
                [
                    'label' => 'Luas Wilayah',
                    'value' => '253,21 Km²',
                    'icon' => 'ruler',
                    'description' => 'Total luas wilayah desa',
                ],
                [
                    'label' => 'Ketinggian',
                    'value' => '24 mdpl',
                    'icon' => 'mountain',
                    'description' => 'Ketinggian rata-rata dari permukaan laut',
                ],
                [
                    'label' => 'Suhu Rata-rata',
                    'value' => '24-31°C',
                    'icon' => 'thermometer',
                    'description' => 'Suhu harian sepanjang tahun',
                ],
                [
                    'label' => 'Koordinat',
                    'value' => '1°31\'14"N, 100°58\'56"E',
                    'icon' => 'compass',
                    'description' => 'Posisi geografis desa',
                ],
            ];

            $boundaries = [
                [
                    'direction' => 'Utara',
                    'boundary' => 'Kep. Teluk Mega',
                    'color' => 'bg-blue-100 text-blue-800',
                ],
                [
                    'direction' => 'Selatan',
                    'boundary' => 'Kep. Sintong',
                    'color' => 'bg-green-100 text-green-800',
                ],
                [
                    'direction' => 'Timur',
                    'boundary' => 'Kep. Rantau Bais',
                    'color' => 'bg-cyan-100 text-cyan-800',
                ],
                [
                    'direction' => 'Barat',
                    'boundary' => 'Kep. Sintong Bakti',
                    'color' => 'bg-emerald-100 text-emerald-800',
                ],
            ];

            $demographics = [
                ['label' => 'Jumlah Dusun', 'value' => '4 Dusun'],
                ['label' => 'Jumlah RW', 'value' => '8 RW'],
                ['label' => 'Jumlah RT', 'value' => '20 RT'],
                ['label' => 'Jumlah KK', 'value' => '620 keluarga', 'icon' => 'user-round'],
                ['label' => 'Total Penduduk', 'value' => '2.720 jiwa', 'icon' => 'users'],
                ['label' => 'Kepadatan', 'value' => '161 jiwa/km²'],
                ['label' => 'Laki-Laki', 'value' => '1.235 jiwa', 'icon' => 'mars'],
                ['label' => 'Perempuan', 'value' => '1.485 jiwa', 'icon' => 'venus'],
                ['label' => 'Luas Perkebunan Sawit', 'value' => '7.000 Ha', 'icon' => 'tree-palm'],
            ];
        @endphp

        <!-- Peta dan Info Lokasi -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
            <!-- Peta -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6 border-b">
                    <h3 class="text-xl font-semibold text-primary flex items-center gap-2">
                        <i data-lucide="map-pin" class="w-6 h-6 text-primary"></i>
                        Peta Wilayah Kepenghuluan
                    </h3>
                </div>
                <div class="p-0">
                    <iframe src="https://desa-sintongpusaka.my.id/Peta/" width="100%" height="500" frameborder="0"
                        style="border: none; border-radius: 0 0 8px 8px;" allowfullscreen>
                    </iframe>
                </div>
            </div>

            <!-- Info Geografis -->
            <div class="space-y-6">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-semibold mb-4">Data Geografis</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($geographyData as $item)
                            <div class="flex items-start gap-3 p-3 rounded-lg bg-gray-50">
                                <i data-lucide="{{ $item['icon'] }}" class="w-6 h-6 text-primary mt-1 flex-shrink-0"></i>
                                <div>
                                    <div class="font-semibold">{{ $item['value'] }}</div>
                                    <div class="text-sm text-gray-600">
                                        {{ $item['label'] }}
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1">
                                        {{ $item['description'] }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Batas Wilayah -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-semibold mb-4">Batas Wilayah</h3>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($boundaries as $item)
                            <div class="text-center p-3 rounded-lg border">
                                <span
                                    class="{{ $item['color'] }} px-3 py-1 rounded-full text-xs font-medium mb-2 inline-block">
                                    {{ $item['direction'] }}
                                </span>
                                <div class="text-sm font-medium">{{ $item['boundary'] }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md mb-16">
            <!-- Header -->
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-xl font-semibold text-primary flex items-center gap-2">
                    <i data-lucide="users" class="w-6 h-6 text-primary"></i>
                    Data Administrasi & Demografi
                </h3>
                <p class="text-gray-600 mt-1">
                    Pembagian wilayah administratif dan data kependudukan
                </p>
            </div>

            <!-- Isi -->
            <div class="p-6">
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
                    @foreach($data  as $item)
                        <div class="text-center">
                            <div class="text-2xl font-bold text-primary mb-1">
                                {{ number_format($item['value'], 0, ',', '.') }}
                            </div>
                            <div class="text-sm text-gray-600">
                                {{ $item['label'] }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Akses dan Transportasi -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-semibold mb-4">Akses Transportasi</h3>
                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="w-2 h-2 bg-primary rounded-full mt-2"></div>
                        <div>
                            <h4 class="font-medium">Jalan Desa</h4>
                            <p class="text-sm text-gray-600">
                                Jalan utama desa sudah beraspal dan bisa dilalui kendaraan roda dua maupun roda empat.
                            </p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-2 h-2 bg-primary rounded-full mt-2"></div>
                        <div>
                            <h4 class="font-medium">Akses Sungai</h4>
                            <p class="text-sm text-gray-600">
                                Terdapat sungai yang melintasi desa, namun sudah tersedia jembatan permanen untuk akses
                                darat.
                            </p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-2 h-2 bg-primary rounded-full mt-2"></div>
                        <div>
                            <h4 class="font-medium">Transportasi Warga</h4>
                            <p class="text-sm text-gray-600">
                                Mobilitas warga sehari-hari umumnya menggunakan kendaraan pribadi seperti sepeda motor.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-semibold mb-4">Jarak ke Pusat Pemerintahan</h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center py-2 border-b">
                        <span>Pusat Pemerintahan Kecamatan</span>
                        <span class="font-medium">8 km</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b">
                        <span>Pusat Pemerintahan Kabupaten</span>
                        <span class="font-medium">90 km</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b">
                        <span>Pusat Pemerintahan Provinsi</span>
                        <span class="font-medium">170 km</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        lucide.createIcons();
    });
</script>