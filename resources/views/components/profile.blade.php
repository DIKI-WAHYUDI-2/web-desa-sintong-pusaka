<section id="profil" class="py-20 bg-gray-100 scroll-mt-20">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">
                Profil Kepenghuluan Sintong Pusaka
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Mengenal lebih dekat desa penghasil kelapa sawit terbaik dengan
                sejarah, visi misi, dan struktur pemerintahan
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
            <!-- Sejarah -->
            <div class="bg-white rounded-lg shadow-md p-6 h-fit">
                <h3 class="text-xl font-semibold text-primary mb-4 flex items-center gap-2">
                    <i data-lucide="book-open" class="w-6 h-6 text-primary"></i>
                    Sejarah Singkat
                </h3>
                <div class="space-y-4">
                    <p class="text-gray-600 leading-relaxed">
                        Kabupaten Rokan Hilir resmi dimekarkan dari Kabupaten Bengkalis dan menjadi kabupaten definitif
                        pada awal tahun 2000-an. Sejak itu, pembangunan di berbagai bidang terus digesa, mulai dari
                        infrastruktur, pendidikan, kesehatan, hingga pelayanan masyarakat.
                    </p>
                    <p class="text-gray-600 leading-relaxed">
                        Sebagai bagian dari pemerataan pembangunan, pada Oktober 2010 dilakukan pemekaran
                        <strong>Kepenghuluan Sintong</strong> menjadi empat kepenghuluan. Dari pemekaran tersebut
                        lahirlah tiga kepenghuluan baru, yaitu:
                        <br>- Kepenghuluan Sintong Pusaka (Penghulu Afrizal),
                        <br>- Kepenghuluan Sintong Bakti (Penghulu Adi Hudri, S.Ag),
                        <br>- Kepenghuluan Sintong Makmur (Penghulu Jonprizal, A.Md).
                    </p>
                    <p class="text-gray-600 leading-relaxed">
                        Sebelum pemekaran, luas wilayah Kepenghuluan Sintong mencapai <strong>27.500 hektar</strong>
                        dengan batas wilayah: utara berbatasan dengan Kepenghuluan Teluk Mega, selatan dengan
                        Kepenghuluan Sekeladi, barat dengan Kecamatan Bangko, dan timur dengan Kecamatan Mandau. Setelah
                        pemekaran, batas wilayah berubah menyesuaikan dengan kepenghuluan baru yang terbentuk.
                    </p>
                    <p class="text-gray-600 leading-relaxed">
                        Pada tahun 2011, Kepenghuluan Sintong menyelenggarakan pemilihan penghulu pertama sejak
                        pemekaran. Sejak saat itu, roda pemerintahan desa terus berjalan dengan berbagai pembenahan
                        struktur dan lembaga yang mendukung pelayanan masyarakat.
                    </p>
                </div>
            </div>

            <!-- Visi Misi -->
            <div class="bg-white rounded-lg shadow-md p-6 h-fit">
                <h3 class="text-xl font-semibold text-primary mb-4 flex items-center gap-2">
                    <i data-lucide="target" class="w-6 h-6 text-primary"></i>
                    Visi & Misi
                </h3>
                <div class="space-y-6">
                    <div>
                        <h4 class="font-semibold text-primary mb-2">Visi</h4>
                        <p class="text-gray-600 italic">
                            "Mewujudkan Kepenghuluan Sintong Pusaka sebagai sentra kelapa sawit
                            berkelanjutan dan masyarakat yang sejahtera pada tahun 2030"
                        </p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-primary mb-2">Misi</h4>
                        <ul class="space-y-2 text-gray-600">
                            <li class="flex items-start gap-2">
                                <div class="w-2 h-2 bg-secondary rounded-full mt-2 flex-shrink-0"></div>
                                Meningkatkan produktivitas kelapa sawit melalui teknologi modern
                            </li>
                            <li class="flex items-start gap-2">
                                <div class="w-2 h-2 bg-secondary rounded-full mt-2 flex-shrink-0"></div>
                                Mengembangkan ekonomi kerakyatan berbasis kelapa sawit
                            </li>
                            <li class="flex items-start gap-2">
                                <div class="w-2 h-2 bg-secondary rounded-full mt-2 flex-shrink-0"></div>
                                Menerapkan praktik pertanian ramah lingkungan
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Struktur Pemerintah -->
        <div class="mb-16">
            <h3 class="text-2xl font-bold text-center mb-8">
                Struktur Pemerintahan Desa
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($aparat as $item)
                    <div class="bg-white rounded-lg shadow-md text-center p-6">
                        <div class="w-24 h-24 mx-auto mb-4 rounded-lg overflow-hidden">
                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}"
                                class="w-full h-full object-cover">
                        </div>
                        <h4 class="text-lg font-semibold">{{ $item->nama }}</h4>
                        <span
                            class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mt-2">
                            {{ $item->jabatan }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        lucide.createIcons();
    });
</script>