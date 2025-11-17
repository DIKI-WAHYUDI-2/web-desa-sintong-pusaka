<section id="beranda" class="relative min-h-[70vh] md:min-h-screen flex items-center">
    <!-- Background Image -->
    <div class="absolute inset-0 z-0">
        <img src="https://media.istockphoto.com/id/1418054291/id/foto/bibit-kelapa-sawit-atau-pembibitan.jpg?s=612x612&w=0&k=20&c=PO6VhJzriR5Z34AwJ3uVT3X_4n2MK8M-1_gMcRZqHKk="
            alt="Perkebunan kelapa sawit dengan barisan pohon yang teratur dan hijau"
            class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/40"></div>
    </div>

    <!-- Content -->
    <div class="relative z-10 container mx-auto px-4">
        <div class="max-w-3xl text-center md:text-left">
            <h1
                class="text-3xl sm:text-4xl md:text-5xl font-bold text-white mb-4 sm:mb-6 leading-snug md:leading-tight">
                Selamat Datang di
                <span class="block text-secondary">Kepenghuluan Sintong Pusaka</span>
            </h1>
            <p class="text-lg sm:text-xl md:text-2xl text-white/90 mb-6 sm:mb-8 leading-relaxed">
                Desa penghasil kelapa sawit terbaik dengan pertanian berkelanjutan.
                Bersama membangun ekonomi rakyat yang sejahtera.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 mb-8 sm:mb-12 justify-center md:justify-start">
                <a href="#profil"
                    class="bg-secondary hover:bg-secondary/90 text-white px-6 py-3 rounded-lg flex items-center justify-center">
                    Jelajahi Desa
                    <i data-lucide="chevron-right" class="w-5 h-5 ml-2"></i>
                </a>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6">
                <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 sm:p-6 text-center">
                    <i data-lucide="users" class="w-8 h-8 text-secondary mx-auto mb-2"></i>
                    <div class="text-xl sm:text-2xl font-bold text-white">2.720</div>
                    <div class="text-white/80 text-sm sm:text-base">Penduduk</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 sm:p-6 text-center">
                    <i data-lucide="tree-pine" class="w-8 h-8 text-secondary mx-auto mb-2"></i>
                    <div class="text-xl sm:text-2xl font-bold text-white">7.000</div>
                    <div class="text-white/80 text-sm sm:text-base">Ha Sawit</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 sm:p-6 text-center">
                    <i data-lucide="map-pin" class="w-8 h-8 text-secondary mx-auto mb-2"></i>
                    <div class="text-xl sm:text-2xl font-bold text-white">253,21</div>
                    <div class="text-white/80 text-sm sm:text-base">Km² Luas Wilayah</div>
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