<section id="berita" class="py-20 scroll-mt-20">

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <!-- Header Section -->
        <div class="mx-auto mb-12 max-w-3xl text-center">

            <p class="mb-4 text-xl font-semibold uppercase tracking-[0.28em] text-primary">
                Informasi
            </p>

            <h2 class="text-4xl font-semibold text-primary md:text-5xl">
                Berita Terkini
            </h2>

            <p class="mx-auto mt-6 max-w-2xl text-lg text-muted-foreground">
                Kabar dan kegiatan terbaru dari Kepenghuluan Sintong Pusaka.
            </p>

        </div>

        <!-- Filter Organisasi -->
        <div class="mb-10 flex flex-wrap justify-center gap-2.5">

            @foreach ($organisasi as $org)
                <a href="{{ route('home', ['organisasi' => $org]) }}#berita"
                    class="rounded-sm border px-4 py-2 text-sm font-semibold transition
                    {{ $selectedBeritaOrg === $org
                        ? 'border-secondary bg-secondary text-secondary-foreground'
                        : 'border-border bg-background text-foreground hover:border-primary hover:text-primary' }}">
                    {{ $org }}
                </a>
            @endforeach

        </div>

        <!-- Grid Berita -->
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">

            @forelse ($beritas as $item)
                <article
                    class="group overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-black/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:ring-primary/10">

                    <!-- Thumbnail -->
                    <div class="relative overflow-hidden">

                        @if ($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}"
                                class="h-56 w-full object-cover transition duration-500 group-hover:scale-105">
                        @else
                            <div
                                class="flex h-56 w-full items-center justify-center bg-muted text-sm text-muted-foreground">
                                Tidak ada gambar
                            </div>
                        @endif

                        <!-- Overlay gradient -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-black/10 to-transparent"></div>

                        <!-- Badge kategori -->
                        <div class="absolute left-4 top-4">
                            <span
                                class="rounded-full bg-white/95 px-3 py-1 text-xs font-semibold text-primary shadow-sm backdrop-blur">
                                {{ $item->kategori }}
                            </span>
                        </div>

                        <!-- Tanggal -->
                        <div class="absolute bottom-4 left-4 flex items-center gap-2 text-sm text-white">
                            <i data-lucide="calendar" class="h-4 w-4"></i>
                            {{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') : '-' }}
                        </div>
                    </div>

                    <!-- Body -->
                    <div class="p-6">

                        <!-- Organisasi -->
                        <p class="text-xs font-semibold uppercase tracking-wide text-primary/80">
                            {{ $item->organisasi }}
                        </p>

                        <!-- Judul -->
                        <h3
                            class="mt-2 line-clamp-2 text-xl font-bold leading-snug text-foreground transition group-hover:text-primary">
                            {{ $item->judul }}
                        </h3>

                        <!-- Ringkasan -->
                        <p class="mt-3 line-clamp-3 text-sm leading-7 text-muted-foreground">
                            {{ Str::limit(strip_tags($item->isi), 120) }}
                        </p>

                        <!-- Footer -->
                        <div class="mt-6 flex items-center justify-between">

                            <span class="text-xs text-muted-foreground">
                                {{ $item->updated_at->diffForHumans() }}
                            </span>

                            <a href="{{ route('berita.show', $item->slug) }}"
                                class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2 text-sm font-semibold text-white transition hover:bg-primary/90">
                                Baca
                                <i data-lucide="arrow-right" class="h-4 w-4 transition group-hover:translate-x-0.5"></i>
                            </a>

                        </div>
                    </div>
                </article>

            @empty

                <div
                    class="col-span-full rounded-3xl border border-border bg-white p-12 text-center text-muted-foreground shadow-sm">

                    <div
                        class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-primary/10 text-primary">
                        <i data-lucide="newspaper" class="h-8 w-8"></i>
                    </div>

                    <p class="text-lg font-semibold text-foreground">
                        Belum ada berita
                    </p>

                    <p class="mt-1 text-sm text-muted-foreground">
                        Belum ada berita untuk organisasi ini.
                    </p>
                </div>
            @endforelse

        </div>

        <!-- Pagination -->
        {{ $beritas->onEachSide(1)->withQueryString()->fragment('berita')->links('vendor.pagination.village-theme') }}
    </div>

</section>
