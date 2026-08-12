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

    {{-- Load Tailwind & Alpine (via Vite) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="min-h-screen bg-background text-foreground antialiased">

    {{-- Header --}}
    <header x-data="{ open: false }"
        class="sticky top-0 z-50 border-b border-border bg-background/95 backdrop-blur supports-[backdrop-filter]:bg-background/80">
        <div class="flex h-20 items-center px-4 sm:px-6 lg:px-8">
            {{-- Logo --}}
            <a href="#beranda" class="flex items-center gap-2 shrink-0">
                <img src="https://upload.wikimedia.org/wikipedia/commons/5/5a/Lambang_Kabupaten_Rokan_Hilir.png"
                    alt="Logo Kepenghuluan Sintong Pusaka" class="h-10 w-10 object-contain">
                <span class="hidden sm:block text-sm font-bold leading-tight text-foreground">
                    Kepenghuluan<br>Sintong Pusaka
                </span>
            </a>

            {{-- Desktop Navigation --}}
            <nav class="ml-auto
            hidden items-center gap-2 lg:flex">
                <a href="#beranda"
                    class="rounded-md px-4 py-3 text-base font-semibold text-foreground transition hover:bg-accent hover:text-primary">
                    Beranda
                </a>
                <a href="#profil"
                    class="rounded-md px-4 py-3 text-base font-semibold text-foreground transition hover:bg-accent hover:text-primary">
                    Profil
                </a>
                <a href="#berita"
                    class="rounded-md px-4 py-3 text-base font-semibold text-foreground transition hover:bg-accent hover:text-primary">
                    Berita
                </a>
                <a href="#galeri"
                    class="rounded-md px-4 py-3 text-base font-semibold text-foreground transition hover:bg-accent hover:text-primary">
                    Galeri
                </a>
                <a href="#lokasi"
                    class="rounded-md px-4 py-3 text-base font-semibold text-foreground transition hover:bg-accent hover:text-primary">
                    Lokasi
                </a>
            </nav>

            {{-- Mobile Menu Button --}}
            <button @click="open = !open"
                class="ml-auto inline-flex items-center justify-center rounded-md border border-border p-2 text-muted-foreground transition hover:bg-accent hover:text-accent-foreground lg:hidden">
                <i data-lucide="menu" class="h-5 w-5"></i>
            </button>
        </div>

        {{-- Mobile Menu --}}
        <div x-show="open" x-transition x-cloak class="border-t border-border bg-background lg:hidden">
            <nav class="mx-auto flex max-w-7xl flex-col gap-1 px-4 py-4 sm:px-6 lg:px-8">
                <a href="#beranda" class="rounded-md px-3 py-2 text-sm font-medium hover:bg-accent">Beranda</a>
                <a href="#profil" class="rounded-md px-3 py-2 text-sm font-medium hover:bg-accent">Profil</a>
                <a href="#berita" class="rounded-md px-3 py-2 text-sm font-medium hover:bg-accent">Berita</a>
                <a href="#galeri" class="rounded-md px-3 py-2 text-sm font-medium hover:bg-accent">Galeri</a>
                <a href="#lokasi" class="rounded-md px-3 py-2 text-sm font-medium hover:bg-accent">Lokasi</a>
            </nav>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="min-h-[calc(100vh-8rem)]">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('components.footer')

    {{-- Lucide Icons --}}
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();
        });
    </script>

</body>

</html>
