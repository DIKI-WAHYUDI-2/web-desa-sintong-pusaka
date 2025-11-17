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

    {{-- Tailwind & Alpine via Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body class="bg-gray-50 text-gray-900">
    <div class="flex">
        <!-- SIDEBAR -->
        @include('components.sidebar');

        <!-- CONTENT -->
        <main class="flex-1 p-6 ml-64 space-y-6">
            <!-- Dashboard Title -->
            <div>
                <h1 class="text-2xl font-bold">Dashboard</h1>
                <p class="text-gray-600 mt-1">Selamat datang di admin dashboard</p>
            </div>

            <!-- Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Berita -->
                <div class="p-6 bg-white rounded-2xl shadow flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Total Berita</p>
                        <p class="text-2xl font-bold mt-2">{{ $totalBerita }}</p>
                    </div>
                    <!-- Heroicon: DocumentText -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-blue-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 4H7a2 2 0 01-2-2V6a2 2 0 012-2h7l5 5v11a2 2 0 01-2 2z" />
                    </svg>
                </div>

                <!-- Total Galeri -->
                <div class="p-6 bg-white rounded-2xl shadow flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Total Galeri</p>
                        <p class="text-2xl font-bold mt-2">{{ $totalGaleri }}</p>
                    </div>
                    <!-- Heroicon: Photo -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6a2 2 0 012-2h12a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm16 0l-8 8-4-4-4 4" />
                    </svg>
                </div>

                <!-- Total Aparat -->
                <div class="p-6 bg-white rounded-2xl shadow flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Total Aparat</p>
                        <p class="text-2xl font-bold mt-2">{{ $totalAparat }}</p>
                    </div>
                    <!-- Heroicon: User Solid (warna hijau) -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-600" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M12 2a5 5 0 100 10 5 5 0 000-10zm-7 16a7 7 0 1114 0v2a1 1 0 01-1 1H6a1 1 0 01-1-1v-2z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </div>

            <!-- Berita & Galeri Terbaru -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Berita -->
                <div class="p-6 bg-white rounded-2xl shadow">
                    <h3 class="mb-4 font-semibold">Statistik Berita</h3>
                    <canvas id="chartBerita" class="w-full h-64"></canvas>
                </div>

                <!-- Galeri (diganti grafik) -->
                <div class="p-6 bg-white rounded-2xl shadow">
                    <h3 class="mb-4 font-semibold">Statistik Galeri</h3>
                    <canvas id="chartGaleri" class="w-full h-64"></canvas>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();

            // Data untuk chart
            const chartData = {
                berita: {
                    labels: @json($bulanBerita ?? []),
                    data: @json($jumlahBerita ?? [])
                },
                galeri: {
                    labels: @json($bulanGaleri ?? []),
                    data: @json($jumlahGaleri ?? [])
                }
            };

            // Jika data kosong, gunakan default
            if (chartData.berita.labels.length === 0) {
                chartData.berita.labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei'];
                chartData.berita.data = [0, 0, 0, 0, 0];
                chartData.galeri.labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei'];
                chartData.galeri.data = [10, 15, 8, 20, 12];
            }

            // === Grafik Berita per Bulan ===
            const ctxBerita = document.getElementById('chartBerita').getContext('2d');
            new Chart(ctxBerita, {
                type: 'bar',
                data: {
                    labels: chartData.berita.labels,
                    datasets: [{
                        label: 'Jumlah Berita',
                        data: chartData.berita.data,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true, // aktifkan
                    aspectRatio: 2, // 2 artinya lebar : tinggi = 2:1
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });

            // === Grafik Galeri per Bulan ===
            const ctxGaleri = document.getElementById('chartGaleri').getContext('2d');

            if (chartData.galeri.labels.length === 0) {
                chartData.galeri.labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei'];
                chartData.galeri.data = [10, 15, 8, 20, 12];
            }

            window.chartGaleri = new Chart(ctxGaleri, {
                type: 'line',
                data: {
                    labels: chartData.galeri.labels,
                    datasets: [{
                        label: 'Jumlah Foto',
                        data: chartData.galeri.data,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.1)',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true, // Ubah ke true
                    aspectRatio: 2, // Rasio lebar:tinggi
                    scales: {
                        y: {
                            beginAtZero: true,
                            suggestedMax: chartData.galeri.data.length > 0
                                ? Math.max(...chartData.galeri.data) * 1.2
                                : 10,
                            ticks: { precision: 0 }
                        }
                    }
                }
            });
        });
    </script>
</body>

</html>