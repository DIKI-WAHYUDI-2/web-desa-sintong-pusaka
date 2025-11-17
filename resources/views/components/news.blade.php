<section id="berita" class="py-20 scroll-mt-20 ">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">
                Berita Terkini
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Ikuti perkembangan terbaru dan pencapaian terkini dari Kepenghuluan Sintong Pusaka
            </p>
        </div>

        @php
            $selectedBeritaOrg = request('organisasi', 'Kepenghuluan');
        @endphp

        <div class="flex flex-wrap justify-center gap-3 mb-8">
            @foreach ($organisasi as $org)
                <a href="{{ route('home', ['organisasi' => $org]) }}#berita"
                    class="px-4 py-2 rounded-full border {{ $selectedBeritaOrg === $org ? 'bg-[#d4af37] text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }}">
                    {{ $org }}
                </a>
            @endforeach
        </div>

        <!-- Berita Utama -->
        @if($berita)
            <div class="mb-12">
                <div
                    class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 border border-gray-300">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
                        <div class="relative h-80">
                            @if($berita->gambar)
                                <img src="{{ asset($berita->gambar) }}" alt="{{ $berita->judul }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                    Tidak ada gambar
                                </div>
                            @endif
                            <div class="absolute top-4 left-4">
                                <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-xs font-medium">
                                    {{ $berita->kategori ?? '-' }}
                                </span>
                            </div>
                        </div>
                        <div class="p-8 flex flex-col justify-center">
                            <div class="flex items-center gap-2 text-sm text-gray-500 mb-4">
                                <i data-lucide="calendar" class="w-4 h-4"></i>
                                <span>{{ $berita->tanggal ? \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d F Y') : '-' }}</span>
                            </div>
                            <h3 class="text-2xl font-bold mb-4 leading-tight">{{ $berita->judul ?? 'Belum ada judul' }}</h3>
                            <p class="text-gray-600 mb-6 leading-relaxed">{{ Str::limit($berita->isi ?? '-', 200) }}</p>
                            @if($berita->id)
                                <a href="{{ route('berita.show', $berita->slug) }}"
                                    class="self-start border border-gray-300 rounded-lg px-4 py-2 text-sm font-medium hover:bg-[#d4af37] transition-colors flex items-center">
                                    Baca Selengkapnya
                                    <i data-lucide="chevron-right" class="w-4 h-4 ml-2"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif


        <div class="mb-12 hidden md:block">
            @if($beritaLain->count() > 0)
                <div class="relative w-full overflow-hidden">

                    <!-- Arrow kiri -->
                    <button onclick="prevSlide2()" class="absolute left-0 top-1/2 -translate-y-1/2 z-10
                                                           bg-white shadow-lg rounded-full
                                                           flex items-center justify-center
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
                    <button onclick="nextSlide2()" class="absolute right-0 top-1/2 -translate-y-1/2 z-10
                                                               bg-white shadow-lg rounded-full
                                                               flex items-center justify-center
                                                               w-10 h-10">
                        <i data-lucide="chevron-right" class="w-5 h-5"></i>
                    </button>

                </div>
            @endif
        </div>

        <!-- MOBILE CAROUSEL (1 item) -->
        <div class="mb-12 md:hidden">
            @if($beritaLain->count() > 0)
                <div class="relative w-full overflow-hidden">

                    <!-- Arrow kiri -->
                    <button onclick="prevSlideMobile()" class="absolute right-0 top-1/2 -translate-y-1/2 z-10
                                                           bg-white shadow-lg rounded-full
                                                           flex items-center justify-center
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
                    <button onclick="nextSlideMobile()" class="absolute right-0 top-1/2 -translate-y-1/2 z-10
                                                               bg-white shadow-lg rounded-full
                                                               flex items-center justify-center
                                                               w-10 h-10">
                        <i data-lucide="chevron-right" class="w-5 h-5"></i>
                    </button>

                </div>
            @endif
        </div>

    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
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