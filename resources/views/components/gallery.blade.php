<div x-data="{ previewOpen: false, previewImage: '' }">

    <!-- Galeri Section -->
    <section id="galeri" class="scroll-mt-20 bg-muted/30 py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="mx-auto mb-12 max-w-3xl text-center">
                <p class="mb-4 text-xl font-semibold uppercase tracking-[0.28em] text-primary">
                    Dokumentasi
                </p>

                <h2 class="text-4xl font-semibold text-primary md:text-5xl">
                    Galeri Kegiatan
                </h2>

                <p class="mx-auto mt-6 max-w-2xl text-lg text-muted-foreground">
                    Dokumentasi kehidupan sehari-hari, fasilitas, dan kegiatan masyarakat di Kepenghuluan Sintong
                    Pusaka.
                </p>
            </div>

            <!-- Filter Organisasi -->
            <div class="mb-10 flex flex-wrap justify-center gap-2.5">
                @foreach ($organisasi as $org)
                    <a href="{{ route('home', ['galeri_organisasi' => $org]) }}#galeri"
                        class="rounded-sm border px-4 py-2 text-sm font-semibold transition
                        {{ $selectedGaleriOrg === $org
                            ? 'border-secondary bg-secondary text-secondary-foreground'
                            : 'border-border bg-background text-foreground hover:border-primary hover:text-primary' }}">
                        {{ $org }}
                    </a>
                @endforeach
            </div>

            <!-- Grid Galeri -->
            @forelse ($galeriFotos as $foto)
                @if ($loop->first)
                    <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4">
                @endif

                <div class="aspect-square overflow-hidden rounded-sm border border-border bg-muted">
                    <img src="{{ asset('storage/' . $foto->gambar) }}" alt="{{ $foto->galeri->judul ?? 'Galeri' }}"
                        class="h-full w-full cursor-pointer object-cover transition-transform duration-300 hover:scale-105"
                        @click="previewOpen = true; previewImage = '{{ asset($foto->gambar) }}'">
                </div>

                @if ($loop->last)
        </div>
        @endif
    @empty
        <div class="rounded-sm border border-border bg-background p-10 text-center text-muted-foreground">
            Belum ada foto untuk organisasi ini.
        </div>
        @endforelse

        <!-- Pagination -->
        {{ $galeriFotos->onEachSide(1)->links('vendor.pagination.village-theme') }}

</div>
</section>

<!-- Modal Preview -->
<div x-show="previewOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4"
    @click="previewOpen = false">
    <img :src="previewImage" class="max-h-[90vh] max-w-full rounded-sm shadow-lg" @click.stop>
    <button
        class="absolute right-5 top-5 flex h-10 w-10 items-center justify-center rounded-full border border-white/30 text-2xl text-white transition hover:bg-white/10"
        @click="previewOpen = false">
        &times;
    </button>
</div>

</div>
