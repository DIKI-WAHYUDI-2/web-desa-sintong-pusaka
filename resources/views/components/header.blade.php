<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kepenghuluan Sintong Pusaka</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            // Initialize lucide icons
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

<body>
    <header class="sticky px-4 py-4 top-0 z-50 w-full border-b bg-white" x-data="{
        open: false,
        activeSection: 'beranda',
        init() {
            // Handle scroll to update active section
            window.addEventListener('scroll', this.handleScroll.bind(this));
        },
        handleScroll() {
            const sections = document.querySelectorAll('section[id]');
            let current = '';
            
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                
                if (pageYOffset >= (sectionTop - sectionHeight / 3)) {
                    current = section.getAttribute('id');
                }
            });
            
            this.activeSection = current;
        },
        handleNavClick(href) {
            const sectionId = href.replace('#', '');
            this.activeSection = sectionId;
            const element = document.getElementById(sectionId);
            
            if (element) {
                const offset = element.offsetTop - 80;
                window.scrollTo({ top: offset, behavior: 'smooth' });
            }
            
            this.open = false;
        },
        closeMenu() {
            this.open = false;
        }
    }">
        <div class="container mx-auto px-2">
            <div class="flex h-16 items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center space-x-2">
                    <div class="w-10 rounded-lg flex items-center justify-center">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/5/5a/Lambang_Kabupaten_Rokan_Hilir.png"
                            alt="Logo Kabupaten Rokan Hilir" class=" object-contain">
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
                    <?php
$navigation = [
    ['name' => 'Beranda', 'href' => '#beranda', 'icon' => 'home'],
    ['name' => 'Profil', 'href' => '#profil', 'icon' => 'user'],
    ['name' => 'Berita', 'href' => '#berita', 'icon' => 'calendar'],
    ['name' => 'Galeri', 'href' => '#galeri', 'icon' => 'image'],
    ['name' => 'Lokasi', 'href' => '#lokasi', 'icon' => 'map-pin'],
    ['name' => 'Kontak', 'href' => '#kontak', 'icon' => 'phone'],
];
                    ?>

                    <?php foreach ($navigation as $item): ?>
                    <a href="<?= $item['href'] ?>" class="flex items-center gap-2 text-gray-700 hover:text-green-600">
                        <i data-lucide="<?= $item['icon'] ?>" class="w-5 h-5"></i>
                        <?= $item['name'] ?>
                    </a>
                    <?php endforeach; ?>
                    <a href="/login"
                        class="ml-4 px-4 py-2 rounded-lg bg-green-600 text-white hover:bg-green-700 transition">
                        Admin
                    </a>
                </nav>

                <!-- Mobile Navigation -->
                <div class="md:hidden flex items-center">
                    <button x-on:click="open = !open" class="p-2 rounded-md text-gray-700">
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
                        <h3 class="font-semibold text-primary">
                            Kepenghuluan Sintong Pusaka
                        </h3>
                        <p class="text-xs text-gray-500">
                            Kabupaten Rokan Hilir
                        </p>
                    </div>
                </div>

                <div class="flex-1 overflow-y-auto py-4 px-4">
                    <nav class="space-y-2">
                        <?php foreach ($navigation as $item): ?>
                        <a href="<?= $item['href'] ?>" @click.prevent="handleNavClick('<?= $item['href'] ?>')" :class="{
                                    'bg-green-100 text-primary': activeSection === '<?= str_replace('#', '', $item['href']) ?>',
                                    'text-gray-700': activeSection !== '<?= str_replace('#', '', $item['href']) ?>'
                                }"
                            class="flex items-center space-x-3 p-3 rounded-lg transition-colors hover:bg-gray-100">
                            <i data-lucide="<?= $item['icon'] ?>" class="w-5 h-5"></i>
                            <span><?= $item['name'] ?></span>
                        </a>
                        <?php endforeach; ?>

                        <a href="/login"
                            class="flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors mt-4">
                            <i data-lucide="settings" class="w-5 h-5"></i>
                            <span>Admin</span>
                        </a>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Overlay -->
        <div x-show="open" x-cloak class="mobile-menu-overlay" @click="closeMenu()"></div>
    </header>

    <script>
        // Re-initialize icons after dynamic changes
        document.addEventListener('DOMContentLoaded', function () {
            lucide.createIcons();
        });
    </script>
</body>

</html>