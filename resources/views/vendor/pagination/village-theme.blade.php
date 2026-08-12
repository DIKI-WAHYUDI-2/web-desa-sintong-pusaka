{{--
    Custom pagination — gaya tabel data resmi (bukan default Laravel/Tailwind).
    Dipakai lewat: {{ $data->onEachSide(1)->links('vendor.pagination.village-theme') }}
--}}
@if ($paginator->hasPages())
    <nav class="mt-12 flex flex-wrap items-center justify-between gap-4" aria-label="Navigasi halaman">

        <p class="text-sm text-muted-foreground">
            Menampilkan {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }} dari {{ $paginator->total() }} data
        </p>

        <div class="flex items-center gap-1.5">

            {{-- Sebelumnya --}}
            @if ($paginator->onFirstPage())
                <span
                    class="flex h-9 items-center justify-center rounded-sm border border-border px-3 text-sm font-semibold text-muted-foreground opacity-40">
                    ‹ Sebelumnya
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="flex h-9 items-center justify-center rounded-sm border border-border px-3 text-sm font-semibold text-muted-foreground transition hover:border-primary hover:text-primary">
                    ‹ Sebelumnya
                </a>
            @endif

            {{-- Nomor halaman --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span
                        class="flex h-9 min-w-[36px] items-center justify-center rounded-sm border border-border px-2 text-sm font-semibold text-muted-foreground">
                        {{ $element }}
                    </span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span
                                class="flex h-9 min-w-[36px] items-center justify-center rounded-sm border border-primary bg-primary px-2 text-sm font-semibold text-primary-foreground">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                                class="flex h-9 min-w-[36px] items-center justify-center rounded-sm border border-border px-2 text-sm font-semibold text-foreground transition hover:border-primary hover:text-primary">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Berikutnya --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="flex h-9 items-center justify-center rounded-sm border border-border px-3 text-sm font-semibold text-muted-foreground transition hover:border-primary hover:text-primary">
                    Berikutnya ›
                </a>
            @else
                <span
                    class="flex h-9 items-center justify-center rounded-sm border border-border px-3 text-sm font-semibold text-muted-foreground opacity-40">
                    Berikutnya ›
                </span>
            @endif

        </div>
    </nav>
@endif
