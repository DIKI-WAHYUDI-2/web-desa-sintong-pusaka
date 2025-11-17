<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Kepenghuluan Sintong Pusaka</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js" defer></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        [x-cloak] {
            display: none !important;
        }

        .aspect-square {
            aspect-ratio: 1/1;
        }

        .gallery-image {
            transition: transform 0.3s ease;
        }

        .gallery-image:hover {
            transform: scale(1.05);
        }
    </style>
</head>

<body class="bg-gray-100" x-data="{ previewOpen: false, previewImage: '' }">
    <!-- Galeri Section -->
    <section id="galeri" class="py-20 bg-gray-100 scroll-mt-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">
                    Galeri Kepenghuluan Sintong Pusaka
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Dokumentasi kehidupan sehari-hari, fasilitas, dan kegiatan masyarakat di Kepenghuluan Sintong Pusaka
                </p>
            </div>
            @php
                $selectedGaleriOrg = request('galeri_organisasi', 'Kepenghuluan');
            @endphp

            <div class="flex flex-wrap justify-center gap-3 mb-8">
                @foreach ($organisasi as $org)
                    <a href="{{ route('home', ['galeri_organisasi' => $org]) }}#galeri"
                        class="px-4 py-2 rounded-full border {{ $selectedGaleriOrg === $org ? 'bg-[#d4af37] text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }}">
                        {{ $org }}
                    </a>
                @endforeach
            </div>
            <!-- Grid Galeri -->
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                @foreach ($galeri as $g)
                    @if($g->fotos->isNotEmpty())
                        @foreach($g->fotos as $foto)
                            <div class="overflow-hidden rounded-lg shadow bg-white">
                                <img src="{{ asset($foto->gambar) }}" alt="{{ $g->judul }}"
                                    class="w-full h-48 object-cover hover:scale-105 transition-transform duration-300 cursor-pointer"
                                    @click="previewOpen = true; previewImage = '{{ asset($foto->gambar) }}'">
                            </div>
                        @endforeach
                    @endif
                @endforeach
            </div>

        </div>
    </section>
    <!-- Modal harus di luar foreach -->
    <div x-show="previewOpen" x-cloak class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50"
        @click="previewOpen = false">
        <img :src="previewImage" class="max-w-[90%] max-h-[90%] rounded-lg shadow-lg" @click.stop>
        <button class="absolute top-5 right-5 text-white text-3xl" @click="previewOpen = false">&times;</button>
    </div>

</body>

</html>