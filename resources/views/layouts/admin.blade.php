<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - Kepenghuluan Sintong Pusaka</title>
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/5/5a/Lambang_Kabupaten_Rokan_Hilir.png"
        type="image/png">
    {{-- Lucide Icons --}}
    <script src="https://unpkg.com/lucide@latest"></script>
    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Load Tailwind & Alpine (via Vite) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>

<body class="min-h-screen bg-background text-foreground antialiased">
    <div class="flex min-h-screen">
        {{-- SIDEBAR --}}
        @include('components.sidebar')

        {{-- CONTENT --}}
        <div class="flex min-w-0 flex-1 flex-col bg-[#F3F6F2] lg:ml-72">

            <main class="flex-1 space-y-6 p-6">
                {{-- PAGE BANNER --}}
                <div class="relative overflow-hidden rounded-3xl bg-[#123B26] px-6 py-6 text-white shadow-lg sm:px-8">
                    <div class="pointer-events-none absolute -right-10 -top-10 h-40 w-40 rounded-full bg-white/5"></div>
                    <div
                        class="pointer-events-none absolute -bottom-16 right-24 h-32 w-32 rounded-full bg-secondary/10">
                    </div>
                    <p class="relative text-xs font-semibold uppercase tracking-[0.2em] text-secondary">
                        @yield('page-eyebrow', 'Admin')</p>
                    <h1 class="relative mt-1 font-serif text-2xl font-semibold">@yield('page-title', 'Dashboard')</h1>
                    @hasSection('page-subtitle')
                        <p class="relative mt-1 text-sm text-white/70">@yield('page-subtitle')</p>
                    @endif
                </div>

                @yield('content')
            </main>
        </div>
    </div>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                Swal.fire({
                    title: 'Sukses!',
                    text: @json(session('success')),
                    icon: 'success',
                    confirmButtonColor: '#1F6B3D',
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                Swal.fire({
                    title: 'Terjadi kesalahan!',
                    icon: 'error',
                    confirmButtonColor: '#1F6B3D',
                    html: `<ul style="text-align:left;">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>`,
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) lucide.createIcons();
        });
    </script>

    @stack('scripts')
</body>

</html>
