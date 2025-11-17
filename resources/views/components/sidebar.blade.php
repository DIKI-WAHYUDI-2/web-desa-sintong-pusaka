<!-- SIDEBAR -->
<aside class="fixed top-0 left-0 h-full w-64 bg-slate-900 text-white shadow-lg flex flex-col">
    <!-- Logo & Title -->
    <div class="flex items-center gap-3 px-6 py-6 border-b border-slate-800">
        <div class="w-12 h-12 rounded-lg flex items-center justify-center">
            <img src="https://upload.wikimedia.org/wikipedia/commons/5/5a/Lambang_Kabupaten_Rokan_Hilir.png"
                alt="Logo Kabupaten Rokan Hilir" class="object-contain">
        </div>
        <div>
            <h2 class="text-sm font-bold">Kep. Sintong Pusaka</h2>
            <span class="text-xs text-gray-400">Admin Panel</span>
        </div>
    </div>

    @if(session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                title: 'Sukses!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    <!-- Nav Menu -->
    <nav class="flex-1 py-6 px-4 space-y-2">
        @if (Request::routeIs('dashboard'))
            <a href="{{ route('dashboard') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg bg-blue-600 text-white shadow">
                <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                <span class="font-medium">Dashboard</span>
            </a>
        @else
            <a href="{{ route('dashboard') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition">
                <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                <span class="font-medium">Dashboard</span>
            </a>
        @endif

        @if (Request::routeIs('berita'))
            <a href="{{ route('berita') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg bg-blue-600 text-white shadow">
                <i data-lucide="newspaper" class="w-5 h-5"></i>
                <span class="font-medium">Berita</span>
            </a>
        @else
            <a href="{{ route('berita') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition">
                <i data-lucide="newspaper" class="w-5 h-5"></i>
                <span class="font-medium">Berita</span>
            </a>
        @endif

        @if (Request::routeIs('galeri'))
            <a href="{{ route('galeri') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg bg-blue-600 text-white shadow">
                <i data-lucide="image" class="w-5 h-5"></i>
                <span class="font-medium">Galeri</span>
            </a>
        @else
            <a href="{{ route('galeri') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition">
                <i data-lucide="image" class="w-5 h-5"></i>
                <span class="font-medium">Galeri</span>
            </a>
        @endif

        @if (Request::routeIs('aparat'))
            <a href="{{ route('aparat') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg bg-blue-600 text-white shadow">
                <i data-lucide="users" class="w-5 h-5"></i>
                <span class="font-medium">Aparat Desa</span>
            </a>
        @else
            <a href="{{ route('aparat') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition">
                <i data-lucide="users" class="w-5 h-5"></i>
                <span class="font-medium">Aparat Desa</span>
            </a>
        @endif

        @if (Request::routeIs('demografis'))
            <a href="{{ route('demografis') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg bg-blue-600 text-white shadow">
                <i data-lucide="globe2" class="w-5 h-5"></i>
                <span class="font-medium">Demografis</span>
            </a>
        @else
            <a href="{{ route('demografis') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition">
                <i data-lucide="globe2" class="w-5 h-5"></i>
                <span class="font-medium">Demografis</span>
            </a>
        @endif
    </nav>

    <!-- Logout -->
    <div class="px-6 py-4 border-t border-slate-800">
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="button" onclick="logoutConfirm()"
                class="w-full flex items-center gap-3 px-4 py-3 rounded-lg bg-red-600 text-white font-medium hover:bg-red-700 transition">
                <i data-lucide="log-out" class="w-5 h-5"></i>
                Keluar
            </button>
        </form>
    </div>
</aside>

<script>
    function logoutConfirm() {
        Swal.fire({
            title: 'Yakin mau keluar?',
            text: "Anda akan keluar dari sistem.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, keluar!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    }
</script>