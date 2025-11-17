<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $berita->judul }} - Kepenghuluan Sintong Pusaka</title>

    @vite('resources/css/app.css')

    <!-- Alpine.js & Lucide -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            lucide.createIcons();
        });
    </script>
    <style>
        [x-cloak] {
            display: none !important;
        }

        body {
            margin: 0;
            font-family: system-ui, -apple-system, sans-serif;
        }

        .mobile-menu-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 40;
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-900">

    <!-- Header -->
    <header class="sticky px-4 py-4 top-0 z-50 w-full border-b bg-white" x-data="{
        open: false,
        activeSection: '',
        closeMenu() { this.open = false }
    }">
        <div class="container mx-auto px-2">
            <div class="flex h-16 items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center space-x-2">
                    <div class="w-10 rounded-lg flex items-center justify-center">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/5/5a/Lambang_Kabupaten_Rokan_Hilir.png"
                            alt="Logo Kabupaten Rokan Hilir" class="object-contain">
                    </div>
                    <div class="hidden sm:block">
                        <h2 class="text-xl font-bold text-primary">
                            Kepenghuluan Sintong Pusaka
                        </h2>
                        <p class="text-sm text-gray-500">
                            Kabupaten Rokan Hilir
                        </p>
                    </div>
                </div>

                <!-- Desktop Navigation -->
                <nav class="hidden md:flex items-center gap-6">
                    <a href="/" class="flex items-center gap-2 text-gray-700 hover:text-green-600">
                        <i data-lucide="home" class="w-5 h-5"></i> Beranda
                    </a>
                    <a href="/#profil" class="flex items-center gap-2 text-gray-700 hover:text-green-600">
                        <i data-lucide="user" class="w-5 h-5"></i> Profil
                    </a>
                    <a href="/#berita" class="flex items-center gap-2 text-gray-700 hover:text-green-600">
                        <i data-lucide="calendar" class="w-5 h-5"></i> Berita
                    </a>
                    <a href="/#galeri" class="flex items-center gap-2 text-gray-700 hover:text-green-600">
                        <i data-lucide="image" class="w-5 h-5"></i> Galeri
                    </a>
                    <a href="/#lokasi" class="flex items-center gap-2 text-gray-700 hover:text-green-600">
                        <i data-lucide="map-pin" class="w-5 h-5"></i> Lokasi
                    </a>
                    <a href="/#kontak" class="flex items-center gap-2 text-gray-700 hover:text-green-600">
                        <i data-lucide="phone" class="w-5 h-5"></i> Kontak
                    </a>
                    <a href="/login"
                        class="ml-4 px-4 py-2 rounded-lg bg-green-600 text-white hover:bg-green-700 transition">
                        Admin
                    </a>
                </nav>

                <!-- Mobile Navigation -->
                <div class="md:hidden flex items-center">
                    <button @click="open = !open" class="p-2 rounded-md text-gray-700">
                        <i x-show="!open" data-lucide="menu" class="w-6 h-6"></i>
                        <i x-show="open" data-lucide="x" class="w-6 h-6" x-cloak></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-x-full" x-transition:enter-end="opacity-100 translate-x-0"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-x-0"
            x-transition:leave-end="opacity-0 -translate-x-full"
            class="fixed inset-y-0 left-0 w-64 bg-white shadow-lg z-50">
            <div class="flex flex-col h-full">
                <div class="flex items-center space-x-2 p-6 border-b">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/5/5a/Lambang_Kabupaten_Rokan_Hilir.png"
                            alt="Logo Kabupaten Rokan Hilir" class="object-contain">
                    </div>
                    <div>
                        <h3 class="font-semibold text-primary">Kepenghuluan Sintong Pusaka</h3>
                        <p class="text-xs text-gray-500">Kabupaten Rokan Hilir</p>
                    </div>
                </div>

                <div class="flex-1 overflow-y-auto py-4 px-4">
                    <nav class="space-y-2">
                        <a href="/" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100">
                            <i data-lucide="home" class="w-5 h-5"></i><span>Beranda</span>
                        </a>
                        <a href="/#profil" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100">
                            <i data-lucide="user" class="w-5 h-5"></i><span>Profil</span>
                        </a>
                        <a href="/#berita" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100">
                            <i data-lucide="calendar" class="w-5 h-5"></i><span>Berita</span>
                        </a>
                        <a href="/#galeri" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100">
                            <i data-lucide="image" class="w-5 h-5"></i><span>Galeri</span>
                        </a>
                        <a href="/#lokasi" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100">
                            <i data-lucide="map-pin" class="w-5 h-5"></i><span>Lokasi</span>
                        </a>
                        <a href="/#kontak" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100">
                            <i data-lucide="phone" class="w-5 h-5"></i><span>Kontak</span>
                        </a>
                        <a href="/login" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100 mt-4">
                            <i data-lucide="settings" class="w-5 h-5"></i><span>Admin</span>
                        </a>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Overlay -->
        <div x-show="open" x-cloak class="mobile-menu-overlay" @click="closeMenu()"></div>
    </header>

    <!-- Konten Berita -->
    <main class="container mx-auto py-6 px-4 sm:px-6 ">
        <div class="bg-white rounded-2xl shadow p-4 sm:p-6">
            <h1 class="text-2xl sm:text-3xl font-bold mb-3 sm:mb-4">{{ $berita->judul }}</h1>
            <div class="text-xs sm:text-sm text-gray-500 mb-4 sm:mb-6 flex flex-wrap gap-2 sm:gap-4">
                <span>{{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d F Y') }}</span>
                <span class="px-2 py-1 bg-gray-100 rounded text-xs sm:text-sm">{{ $berita->kategori }}</span>
            </div>

            @php
                // Pisahkan isi berita jadi paragraf pertama & sisanya
                $paragraf = preg_split('/\r\n|\r|\n/', $berita->isi, 2);
                $paragrafPertama = $paragraf[0] ?? '';
                $paragrafLanjutan = $paragraf[1] ?? '';
            @endphp

            {{-- Gambar Utama --}}
            @if($berita->gambar)
                <figure class="w-full overflow-hidden rounded-xl mb-4 sm:mb-6">
                    <img src="{{ asset($berita->gambar) }}" alt="{{ $berita->judul }}"
                        class="w-full h-[220px] sm:h-[320px] md:h-[clamp(320px,55vh,640px)] object-cover object-center rounded"
                        loading="lazy">
                </figure>
            @endif

            {{-- Paragraf Pertama --}}
            <div class="prose max-w-full leading-relaxed text-gray-700 text-sm sm:text-base mb-6">
                <p>{{ $paragrafPertama }}</p>
            </div>

            {{-- Gambar Pendukung --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 my-6">
                @if($berita->gambar2)
                    <img src="{{ asset('storage/' . $berita->gambar2) }}" alt="Gambar pendukung 1"
                        class="w-full h-[200px] sm:h-[280px] object-cover rounded-lg">
                @endif
                @if($berita->gambar3)
                    <img src="{{ asset('storage/' . $berita->gambar3) }}" alt="Gambar pendukung 2"
                        class="w-full h-[200px] sm:h-[280px] object-cover rounded-lg">
                @endif
            </div>

            {{-- Paragraf Lanjutan --}}
            @if($paragrafLanjutan)
                <div class="prose max-w-full leading-relaxed text-gray-700 text-sm sm:text-base">
                    {!! nl2br(e($paragrafLanjutan)) !!}
                </div>
            @endif
        </div>

        {{-- Berita Lainnya --}}

        <div class="mt-12 mb-12 hidden md:block">
            @if($beritaLain->count() > 0)
                <div class="relative w-full overflow-hidden">

                    <!-- Arrow kiri -->
                    <button onclick="prevSlide2()" class="absolute left-2 top-1/2 -translate-y-1/2 z-10
                                    bg-white shadow-lg rounded-full flex items-center justify-center
                                    w-10 h-10">
                        <i data-lucide="chevron-left" class="w-5 h-5"></i>
                    </button>

                    <!-- Carousel wrapper -->
                    <div id="beritaCarousel" class="flex transition-transform duration-500">

                        @foreach($beritaLain->chunk(3) as $chunk)
                            <div class="flex min-w-full gap-8">

                                @foreach($chunk as $item)
                                    <div class="w-1/3 bg-white rounded-lg shadow border overflow-hidden">
                                        <div class="h-48 bg-gray-200">
                                            @if($item->gambar)
                                                <img src="{{ asset($item->gambar) }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center">Tidak ada gambar</div>
                                            @endif
                                        </div>

                                        <div class="p-4">
                                            <h3 class="font-bold line-clamp-2">{{ $item->judul }}</h3>
                                            <p class="text-gray-600 line-clamp-3">{{ Str::limit($item->isi, 120) }}</p>
                                            <a href="{{ route('berita.show', $item->slug) }}"
                                                class="self-start border border-gray-300 rounded-lg my-2 px-4 py-3 text-sm font-medium hover:bg-[#d4af37] transition-colors flex items-center w-fit">
                                                Baca Selengkapnya
                                                <i data-lucide="chevron-right" class="w-4 h-4 ml-2"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        @endforeach

                    </div>
                    <!-- Arrow kanan -->
                    <button onclick="nextSlide2()" class="absolute right-2 top-1/2 -translate-y-1/2 z-10
                                                bg-white shadow-lg rounded-full flex items-center justify-center
                                                w-10 h-10">
                        <i data-lucide="chevron-right" class="w-5 h-5"></i>
                    </button>

                </div>
            @endif
        </div>

        <!-- MOBILE CAROUSEL (1 item) -->
        <div class="mt-12 mb-12 md:hidden">
            @if($beritaLain->count() > 0)
                <div class="relative w-full overflow-hidden">

                    <!-- Arrow kiri -->
                    <button onclick="prevSlideMobile()" class="absolute left-2 top-1/2 -translate-y-1/2 z-10
                                        bg-white shadow-lg rounded-full flex items-center justify-center
                                        w-10 h-10">
                        <i data-lucide="chevron-left" class="w-5 h-5"></i>
                    </button>

                    <!-- Wrapper -->
                    <div id="beritaCarouselMobile" class="flex transition-transform duration-500">

                        @foreach($beritaLain as $item)
                            <div class="min-w-full px-2">
                                <div class="bg-white rounded-lg shadow border overflow-hidden">
                                    <div class="h-48 bg-gray-200">
                                        @if($item->gambar)
                                            <img src="{{ asset($item->gambar) }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">Tidak ada gambar</div>
                                        @endif
                                    </div>

                                    <div class="p-4">
                                        <h3 class="font-bold line-clamp-2">{{ $item->judul }}</h3>
                                        <p class="text-gray-600 line-clamp-3">{{ Str::limit($item->isi, 120) }}</p>
                                        <a href="{{ route('berita.show', $item->slug) }}"
                                            class="self-start border border-gray-300 rounded-lg my-2 px-4 py-3 text-sm font-medium hover:bg-[#d4af37] transition-colors flex items-center w-fit">
                                            Baca Selengkapnya
                                            <i data-lucide="chevron-right" class="w-4 h-4 ml-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                    <!-- Arrow kanan -->
                    <button onclick="nextSlideMobile()" class="absolute right-2 top-1/2 -translate-y-1/2 z-10
                            bg-white shadow-lg rounded-full flex items-center justify-center
                            w-10 h-10">
                        <i data-lucide="chevron-right" class="w-5 h-5"></i>
                    </button>

                </div>
            @endif
        </div>

        <div class="mt-6 sm:mt-8 w-fit">
            <a href="{{ url()->previous() }}" class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 
              rounded-lg px-3 py-2 sm:px-4 sm:py-2 
              text-sm sm:text-base text-white">
                <i data-lucide="chevron-left" class="w-5 h-5"></i>
                Kembali
            </a>
        </div>


    </main>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();
        });

        let currentSlide2 = 0;
        const totalSlides2 = {{ $beritaLain->chunk(3)->count() }};

        function updateCarousel2() {
            const carousel = document.getElementById('beritaCarousel');
            carousel.style.transform = `translateX(-${currentSlide2 * 100}%)`;
        }

        function nextSlide2() {
            currentSlide2 = (currentSlide2 + 1) % totalSlides2;
            updateCarousel2();
        }

        function prevSlide2() {
            currentSlide2 = (currentSlide2 - 1 + totalSlides2) % totalSlides2;
            updateCarousel2();
        }

        let mobileIndex = 0;

        function nextSlideMobile() {
            const carousel = document.getElementById('beritaCarouselMobile');
            const total = carousel.children.length;
            mobileIndex = (mobileIndex + 1) % total;
            carousel.style.transform = `translateX(-${mobileIndex * 100}%)`;
        }

        function prevSlideMobile() {
            const carousel = document.getElementById('beritaCarouselMobile');
            const total = carousel.children.length;
            mobileIndex = (mobileIndex - 1 + total) % total;
            carousel.style.transform = `translateX(-${mobileIndex * 100}%)`;
        }
    </script>
</body>

</html>