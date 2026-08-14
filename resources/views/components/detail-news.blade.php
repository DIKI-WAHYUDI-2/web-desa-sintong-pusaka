@extends('layouts.app')

@section('title', $berita->judul . ' - Kepenghuluan Sintong Pusaka')

@section('content')

    @php
        // Pisahkan isi berita jadi paragraf pertama & sisanya
        $paragraf = preg_split('/\r\n|\r|\n/', $berita->isi, 2);
        $paragrafPertama = $paragraf[0] ?? '';
        $paragrafLanjutan = $paragraf[1] ?? '';
    @endphp

    <main class="bg-gray-50">

        {{-- Breadcrumb --}}
        <div class="container mx-auto px-4 sm:px-6 pt-6">
            <nav class="flex items-center gap-2 text-sm text-gray-500">
                <a href="/" class="hover:text-green-700 transition-colors">Beranda</a>
                <i data-lucide="chevron-right" class="w-4 h-4"></i>
                <a href="/#berita" class="hover:text-green-700 transition-colors">Berita</a>
                <i data-lucide="chevron-right" class="w-4 h-4"></i>
                <span class="text-gray-400 truncate max-w-[180px] sm:max-w-xs">{{ $berita->judul }}</span>
            </nav>
        </div>

        {{-- Article --}}
        <article class="container mx-auto px-4 sm:px-6 py-6 sm:py-8">
            <div class="max-w-3xl mx-auto">

                {{-- Kategori & tanggal --}}
                <div class="flex items-center gap-3 mb-4">
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-800 text-xs font-semibold tracking-wide uppercase">
                        {{ $berita->kategori }}
                    </span>
                    <span class="flex items-center gap-1.5 text-sm text-gray-500">
                        <i data-lucide="calendar" class="w-4 h-4"></i>
                        {{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d F Y') }}
                    </span>
                </div>

                {{-- Judul --}}
                <h1 class="text-3xl sm:text-4xl md:text-[2.6rem] font-bold leading-tight text-gray-900 mb-6">
                    {{ $berita->judul }}
                </h1>

                {{-- Gambar utama --}}
                @if ($berita->gambar)
                    <figure class="w-full overflow-hidden rounded-2xl shadow-sm mb-8">
                        <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}"
                            class="w-full h-[240px] sm:h-[380px] md:h-[460px] object-cover object-center" loading="lazy">
                    </figure>
                @endif

                {{-- Paragraf pertama (lead) --}}
                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed mb-8">
                    <p class="text-lg sm:text-xl font-medium text-gray-800 leading-relaxed">
                        {{ $paragrafPertama }}
                    </p>
                </div>

                {{-- Gambar pendukung --}}
                @if ($berita->gambar2 || $berita->gambar3)
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
                        @if ($berita->gambar2)
                            <img src="{{ asset('storage/' . $berita->gambar2) }}" alt="Gambar pendukung 1"
                                class="w-full h-[200px] sm:h-[260px] object-cover rounded-xl shadow-sm">
                        @endif
                        @if ($berita->gambar3)
                            <img src="{{ asset('storage/' . $berita->gambar3) }}" alt="Gambar pendukung 2"
                                class="w-full h-[200px] sm:h-[260px] object-cover rounded-xl shadow-sm">
                        @endif
                    </div>
                @endif

                {{-- Paragraf lanjutan --}}
                @if ($paragrafLanjutan)
                    <div class="prose prose-base sm:prose-lg max-w-none text-gray-700 leading-relaxed">
                        {!! nl2br(e($paragrafLanjutan)) !!}
                    </div>
                @endif

                {{-- Tombol kembali --}}
                <div class="mt-10">
                    <a href="{{ url()->previous() }}"
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-700 text-sm font-medium hover:bg-gray-100 hover:border-gray-400 transition-colors">
                        <i data-lucide="arrow-left" class="w-4 h-4"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </article>

        {{-- Berita lainnya --}}
        @if ($beritaLain->count() > 0)
            <section class="border-t border-border bg-background py-14 sm:py-16">

                <div class="mx-auto max-w-6xl px-4 sm:px-6">

                    <div class="mb-8 flex items-center justify-between">

                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-primary">
                                Berita Lainnya
                            </p>

                            <h2 class="mt-2 text-3xl font-bold text-foreground">
                                Informasi Terkait
                            </h2>
                        </div>

                        <a href="/#berita"
                            class="hidden items-center gap-2 text-sm font-semibold text-primary transition hover:gap-3 sm:flex">
                            Lihat semua
                            <i data-lucide="arrow-right" class="h-4 w-4"></i>
                        </a>
                    </div>

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">

                        @foreach ($beritaLain->take(3) as $item)
                            <a href="{{ route('berita.show', $item->slug) }}"
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

                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/50 via-black/10 to-transparent">
                                    </div>

                                    <div class="absolute left-4 top-4">
                                        <span
                                            class="rounded-full bg-white/95 px-3 py-1 text-xs font-semibold text-primary shadow-sm backdrop-blur">
                                            {{ $item->kategori }}
                                        </span>
                                    </div>

                                    <div class="absolute bottom-4 left-4 flex items-center gap-2 text-sm text-white">
                                        <i data-lucide="calendar" class="h-4 w-4"></i>
                                        {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}
                                    </div>
                                </div>

                                <!-- Body -->
                                <div class="p-6">

                                    <p class="text-xs font-semibold uppercase tracking-wide text-primary/80">
                                        {{ $item->organisasi }}
                                    </p>

                                    <h3
                                        class="mt-2 line-clamp-2 text-xl font-bold leading-snug text-foreground transition group-hover:text-primary">
                                        {{ $item->judul }}
                                    </h3>

                                    <p class="mt-3 line-clamp-3 text-sm leading-7 text-muted-foreground">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($item->isi), 110) }}
                                    </p>

                                    <div class="mt-5 flex items-center justify-between">

                                        <span class="text-xs text-muted-foreground">
                                            {{ $item->updated_at->diffForHumans() }}
                                        </span>

                                        <span
                                            class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2 text-sm font-semibold text-white transition group-hover:bg-primary/90">
                                            Baca
                                            <i data-lucide="arrow-right"
                                                class="h-4 w-4 transition group-hover:translate-x-0.5"></i>
                                        </span>

                                    </div>
                                </div>
                            </a>
                        @endforeach

                    </div>
                </div>
            </section>
        @endif
    </main>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) lucide.createIcons();
        });
    </script>
@endpush
