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

    {{-- Berita Terbaru --}}
    <div class="rounded-3xl border border-border bg-white shadow-sm">
        <div class="flex flex-col gap-3 border-b border-border px-6 py-5 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="flex items-center gap-2 text-lg font-semibold text-foreground">
                    <i data-lucide="newspaper" class="h-5 w-5 text-primary"></i>
                    Berita Terbaru
                </h2>
                <p class="mt-1 text-sm text-muted-foreground">5 artikel yang terakhir ditambahkan</p>
            </div>
            <a href="{{ route('berita') }}"
                class="inline-flex items-center gap-1 rounded-full bg-muted px-3 py-1 text-xs font-medium text-primary">
                <i data-lucide="arrow-right" class="h-3.5 w-3.5"></i>
                Lihat semua
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-muted/60">
                    <tr class="text-left text-muted-foreground">
                        <th class="px-6 py-3 font-medium">Judul</th>
                        <th class="px-6 py-3 font-medium">Kategori</th>
                        <th class="px-6 py-3 font-medium">Organisasi</th>
                        <th class="px-6 py-3 text-right font-medium">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @forelse ($beritaTerbaru as $item)
                        <tr class="hover:bg-muted/40">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10 shrink-0 overflow-hidden rounded-full bg-muted">
                                        @if ($item->gambar)
                                            <img src="{{ asset($item->gambar) }}" alt=""
                                                class="h-full w-full object-cover">
                                        @else
                                            <div class="flex h-full w-full items-center justify-center text-xs font-semibold text-primary">
                                                {{ strtoupper(substr($item->judul, 0, 2)) }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="max-w-xs truncate font-medium text-foreground">{{ $item->judul }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-muted-foreground">{{ $item->kategori ?? '-' }}</td>
                            <td class="px-6 py-4 text-muted-foreground">{{ $item->organisasi ?? '-' }}</td>
                            <td class="px-6 py-4 text-right text-muted-foreground">
                                {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-muted-foreground">Belum ada berita.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Galeri Terbaru --}}
    <div class="rounded-3xl border border-border bg-white shadow-sm">
        <div class="flex flex-col gap-3 border-b border-border px-6 py-5 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="flex items-center gap-2 text-lg font-semibold text-foreground">
                    <i data-lucide="images" class="h-5 w-5 text-secondary"></i>
                    Galeri Terbaru
                </h2>
                <p class="mt-1 text-sm text-muted-foreground">5 album yang terakhir ditambahkan</p>
            </div>
            <a href="{{ route('galeri') }}"
                class="inline-flex items-center gap-1 rounded-full bg-muted px-3 py-1 text-xs font-medium text-primary">
                <i data-lucide="arrow-right" class="h-3.5 w-3.5"></i>
                Lihat semua
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-muted/60">
                    <tr class="text-left text-muted-foreground">
                        <th class="px-6 py-3 font-medium">Album</th>
                        <th class="px-6 py-3 font-medium">Kategori</th>
                        <th class="px-6 py-3 font-medium">Organisasi</th>
                        <th class="px-6 py-3 text-right font-medium">Jumlah Foto</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @forelse ($galeriTerbaru as $item)
                        <tr class="hover:bg-muted/40">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10 shrink-0 overflow-hidden rounded-xl bg-muted">
                                        @if ($item->fotos->first())
                                            <img src="{{ asset('storage/' . $item->fotos->first()->gambar) }}" alt=""
                                                class="h-full w-full object-cover">
                                        @else
                                            <div class="flex h-full w-full items-center justify-center text-xs font-semibold text-secondary">
                                                {{ strtoupper(substr($item->judul, 0, 2)) }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="max-w-xs truncate font-medium text-foreground">{{ $item->judul }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-muted-foreground">{{ $item->kategori ?? '-' }}</td>
                            <td class="px-6 py-4 text-muted-foreground">{{ $item->organisasi ?? '-' }}</td>
                            <td class="px-6 py-4 text-right">
                                <span class="rounded-full bg-[#FBEFD1] px-2.5 py-1 text-xs font-semibold text-[#8a6a1e]">
                                    {{ $item->fotos_count }} foto
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-muted-foreground">Belum ada galeri.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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
                    plugins: { legend: { display: false } },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { precision: 0 }
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
                    plugins: { legend: { display: false } },
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
@endpush
