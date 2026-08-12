<section id="berita" class="py-20 scroll-mt-20">

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <!-- Header Section -->
        <div class="mx-auto mb-12 max-w-3xl text-center">

            <p class="mb-4 text-xs font-semibold uppercase tracking-[0.28em] text-primary">
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
                <article class="overflow-hidden rounded-sm border border-border bg-background">

                    <!-- Thumbnail -->
                    <div class="relative h-[150px] bg-muted">

                        @if ($item->gambar)
                            <img src="{{ asset($item->gambar) }}" alt="{{ $item->judul }}"
                                class="h-full w-full object-cover">
                        @else
                            <div class="flex h-full w-full items-center justify-center text-sm text-muted-foreground">
                                Tidak ada gambar
                            </div>
                        @endif

                        <!-- Badge Tanggal -->
                        <div class="absolute bottom-3 left-3">
                            <span
                                class="rounded-sm bg-primary px-2.5 py-1 text-[11px] font-bold uppercase tracking-wide text-primary-foreground">
                                {{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') : '-' }}
                            </span>
                        </div>

                    </div>

                    <!-- Body -->
                    <div class="p-5">

                        <h3 class="line-clamp-2 text-base font-semibold leading-7 text-foreground">
                            {{ $item->judul }}
                        </h3>

                        <p class="mt-3 line-clamp-3 text-sm leading-7 text-muted-foreground">
                            {{ Str::limit(strip_tags($item->isi), 110) }}
                        </p>

                        <a href="{{ route('berita.show', $item->slug) }}"
                            class="mt-4 inline-flex items-center gap-1 text-[13px] font-semibold text-primary underline underline-offset-4 decoration-secondary hover:opacity-80">
                            Baca selengkapnya
                        </a>

                    </div>

                </article>

            @empty

                <div
                    class="col-span-full rounded-sm border border-border bg-background p-10 text-center text-muted-foreground">
                    Belum ada berita untuk organisasi ini.
                </div>
            @endforelse

        </div>

        <!-- Pagination -->
        {{ $beritas->onEachSide(1)->links('vendor.pagination.village-theme') }}

    </div>

</section>
