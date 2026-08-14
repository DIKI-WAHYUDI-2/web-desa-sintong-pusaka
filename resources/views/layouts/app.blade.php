<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kepenghuluan Sintong Pusaka - Kabupaten Rokan Hilir</title>

    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/5/5a/Lambang_Kabupaten_Rokan_Hilir.png"
        type="image/png">

    <script src="https://unpkg.com/lucide@latest"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="min-h-screen bg-background text-foreground antialiased">

    @php
        $navigation = [
            ['name' => 'Beranda', 'href' => url('/#beranda')],
            ['name' => 'Profil', 'href' => url('/#profil')],
            ['name' => 'Berita', 'href' => url('/#berita')],
            ['name' => 'Galeri', 'href' => url('/#galeri')],
            ['name' => 'Lokasi', 'href' => url('/#lokasi')],
        ];
    @endphp

    <!-- Header -->
    <header x-data="{ open: false, active: 'beranda' }" class="sticky top-0 z-50">

        <!-- Garis aksen emas -->
        <div class="h-1 bg-yellow-500"></div>

        <!-- Header utama -->
        <div class="bg-primary border-b border-white/10 shadow-md">

            <div class="w-full flex h-20 items-center justify-between px-4 sm:px-6 lg:px-10">

                <!-- Logo -->
                <a href="#beranda" class="flex items-center gap-4">

                    <div class="h-12 w-12 rounded-lg bg-white flex items-center justify-center p-1 shadow-sm">

                        <img src="https://upload.wikimedia.org/wikipedia/commons/5/5a/Lambang_Kabupaten_Rokan_Hilir.png"
                            alt="Logo" class="h-full w-full object-contain">
                    </div>

                    <div class="hidden sm:block leading-tight">
                        <div class="text-base font-bold text-white">
                            Kepenghuluan Sintong Pusaka
                        </div>

                        <div class="text-sm text-white/80">
                            Kabupaten Rokan Hilir
                        </div>
                    </div>
                </a>

                <!-- Desktop Menu -->
                <nav class="hidden lg:flex items-center gap-1">
                    @foreach ($navigation as $item)
                        @php
                            $id = str_replace('#', '', $item['href']);
                        @endphp

                        <a href="{{ $item['href'] }}" @click="active = '{{ $id }}'"
                            :class="active === '{{ $id }}'
                                ?
                                'bg-white/15 text-white' :
                                'text-white hover:bg-white/10'"
                            class="px-5 py-3 rounded-lg text-white font-semibold transition-colors">

                            {{ $item['name'] }}
                        </a>
                    @endforeach
                </nav>

                <!-- Mobile Button -->
                <button @click="open = !open" class="ml-auto lg:hidden text-white p-2 rounded-md hover:bg-white/10">

                    <i x-show="!open" data-lucide="menu" class="h-6 w-6"></i>
                    <i x-show="open" data-lucide="x" class="h-6 w-6" x-cloak></i>
                </button>

            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="open" x-transition x-cloak class="lg:hidden bg-primary border-t border-white/10">

            <nav class="px-4 py-4 space-y-2">

                @foreach ($navigation as $item)
                    @php
                        $id = str_replace('#', '', $item['href']);
                    @endphp

                    <a href="{{ $item['href'] }}" @click="open = false; active = '{{ $id }}'"
                        :class="active === '{{ $id }}'
                            ?
                            'bg-white/15 text-white' :
                            'text-white hover:bg-white/10'"
                        class="block px-4 py-3 rounded-lg text-base font-semibold transition-colors">

                        {{ $item['name'] }}
                    </a>
                @endforeach
            </nav>
        </div>

    </header>

    <!-- Main Content -->
    <main class="min-h-[calc(100vh-8rem)]">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('components.footer')

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();
        });
    </script>

</body>

</html>
