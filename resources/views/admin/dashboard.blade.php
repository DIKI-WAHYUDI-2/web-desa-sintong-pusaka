@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-eyebrow', 'Dashboard')
@section('page-title', 'Selamat datang, Admin')
@section('page-subtitle', 'Ringkasan aktivitas admin panel')

@push('head')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@section('content')
    {{-- Statistik --}}
    <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
        <div class="rounded-3xl border border-border bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-muted-foreground">Total Berita</p>
                    <h3 class="mt-2 text-2xl font-bold text-foreground">{{ $totalBerita }}</h3>
                </div>
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#DCF3E3] text-primary">
                    <i data-lucide="file-text" class="h-6 w-6"></i>
                </div>
            </div>
            <p class="mt-4 text-sm text-muted-foreground">Artikel yang telah dipublikasikan</p>
        </div>

        <div class="rounded-3xl border border-border bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-muted-foreground">Total Galeri</p>
                    <h3 class="mt-2 text-2xl font-bold text-foreground">{{ $totalGaleri }}</h3>
                </div>
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#FBEFD1] text-[#8a6a1e]">
                    <i data-lucide="image" class="h-6 w-6"></i>
                </div>
            </div>
            <p class="mt-4 text-sm text-muted-foreground">Album foto kegiatan desa</p>
        </div>

        <div class="rounded-3xl border border-border bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-muted-foreground">Total Aparat</p>
                    <h3 class="mt-2 text-2xl font-bold text-foreground">{{ $totalAparat }}</h3>
                </div>
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-600">
                    <i data-lucide="users" class="h-6 w-6"></i>
                </div>
            </div>
            <p class="mt-4 text-sm text-muted-foreground">Perangkat pemerintahan terdaftar</p>
        </div>
    </div>

    {{-- Grafik --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <div class="rounded-3xl border border-border bg-white p-6 shadow-sm">
            <h3 class="mb-4 flex items-center gap-2 font-serif text-sm font-semibold text-[#123B26]">
                <i data-lucide="bar-chart-3" class="h-4 w-4 text-primary"></i>
                Statistik Berita
            </h3>
            <canvas id="chartBerita" class="h-64 w-full"></canvas>
        </div>

        <div class="rounded-3xl border border-border bg-white p-6 shadow-sm">
            <h3 class="mb-4 flex items-center gap-2 font-serif text-sm font-semibold text-[#123B26]">
                <i data-lucide="line-chart" class="h-4 w-4 text-secondary"></i>
                Statistik Galeri
            </h3>
            <canvas id="chartGaleri" class="h-64 w-full"></canvas>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
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

            if (chartData.berita.labels.length === 0) {
                chartData.berita.labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei'];
                chartData.berita.data = [0, 0, 0, 0, 0];
                chartData.galeri.labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei'];
                chartData.galeri.data = [10, 15, 8, 20, 12];
            }

            const ctxBerita = document.getElementById('chartBerita').getContext('2d');
            new Chart(ctxBerita, {
                type: 'bar',
                data: {
                    labels: chartData.berita.labels,
                    datasets: [{
                        label: 'Jumlah Berita',
                        data: chartData.berita.data,
                        backgroundColor: 'rgba(31, 107, 61, 0.5)',
                        borderColor: 'rgba(31, 107, 61, 1)',
                        borderWidth: 1,
                        borderRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    aspectRatio: 2,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
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

            const ctxGaleri = document.getElementById('chartGaleri').getContext('2d');
            if (chartData.galeri.labels.length === 0) {
                chartData.galeri.labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei'];
                chartData.galeri.data = [10, 15, 8, 20, 12];
            }

            new Chart(ctxGaleri, {
                type: 'line',
                data: {
                    labels: chartData.galeri.labels,
                    datasets: [{
                        label: 'Jumlah Foto',
                        data: chartData.galeri.data,
                        borderColor: 'rgba(217, 174, 62, 1)',
                        backgroundColor: 'rgba(217, 174, 62, 0.15)',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    aspectRatio: 2,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            suggestedMax: chartData.galeri.data.length > 0 ?
                                Math.max(...chartData.galeri.data) * 1.2 : 10,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });
        });
    </script>
@endpush
