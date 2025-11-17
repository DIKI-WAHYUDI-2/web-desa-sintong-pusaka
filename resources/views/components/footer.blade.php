<footer class="bg-primary text-white">
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 px-8">
            <!-- Logo dan Deskripsi -->
            <div class="space-y-4">
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-secondary rounded-lg flex items-center justify-center">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/5/5a/Lambang_Kabupaten_Rokan_Hilir.png"
                            alt="Logo Kabupaten Rokan Hilir">
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold">Kepenghuluan Sintong Pusaka</h3>
                        <p class="text-sm opacity-80">Kabupaten Rokan Hilir</p>
                    </div>
                </div>
                <p class="text-sm opacity-90 leading-relaxed">
                    Desa yang damai, berbudaya, dan sejahtera. Bersama membangun masa depan yang lebih baik untuk
                    generasi mendatang.
                </p>
            </div>

            <!-- Tautan Cepat -->
            <div>
                <h4 class="font-semibold mb-4">Tautan Cepat</h4>
                <div class="space-y-2">
                    @php
                        $quickLinks = [
                            ['name' => 'Profil Desa', 'href' => '#profil'],
                            ['name' => 'Potensi & Wisata', 'href' => '#potensi'],
                            ['name' => 'Berita Terkini', 'href' => '#berita'],
                            ['name' => 'Galeri', 'href' => '#galeri'],
                            ['name' => 'Kontak Kami', 'href' => '#kontak'],
                        ];
                    @endphp

                    @foreach($quickLinks as $link)
                        <a href="{{ $link['href'] }}" class="block text-sm opacity-80 hover:opacity-100 transition-opacity">
                            {{ $link['name'] }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Kontak dan Media Sosial -->
            <div>
                <h4 class="font-semibold mb-4">Hubungi Kami</h4>
                <div class="space-y-3 mb-6">
                    <div class="flex items-center space-x-2 text-sm">
                        <i data-lucide="map-pin" class="w-4 h-4 opacity-80"></i>
                        <span class="opacity-90">Jl. H.Nukman, Sintong, Kec. Tanah Putih, Kab Rokan Hilir,
                            Riau</span>
                    </div>
                    <div class="flex items-center space-x-2 text-sm">
                        <i data-lucide="phone" class="w-4 h-4 opacity-80"></i>
                        <span class="opacity-90">(021) 1234-5678</span>
                    </div>
                    <div class="flex items-center space-x-2 text-sm">
                        <i data-lucide="mail" class="w-4 h-4 opacity-80"></i>
                        <span class="opacity-90">info@desasejahtera.go.id</span>
                    </div>
                </div>

                <div>
                    <h5 class="text-sm font-medium mb-3">Media Sosial</h5>
                    <div class="flex space-x-2">
                        <a href="#"
                            class="w-10 h-10 bg-secondary text-white rounded-full flex items-center justify-center hover:bg-secondary/90 transition-colors">
                            <i data-lucide="facebook" class="w-4 h-4"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-secondary text-white rounded-full flex items-center justify-center hover:bg-secondary/90 transition-colors">
                            <i data-lucide="instagram" class="w-4 h-4"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-secondary text-white rounded-full flex items-center justify-center hover:bg-secondary/90 transition-colors">
                            <i data-lucide="youtube" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="border-t border-white/20 mt-8 pt-6 text-center">
            <p class="text-sm opacity-80">
                Developed by KKN UIN Suska 2025 <br>
                © {{ date('Y') }} Kepenghuluan Sintong Pusaka. All Right Reserved
            </p>
        </div>
    </div>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        lucide.createIcons();
    });
</script>