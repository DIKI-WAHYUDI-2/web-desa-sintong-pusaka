<!-- SIDEBAR -->
<aside class="fixed left-0 top-0 z-40 hidden h-full w-72 flex-col bg-[#123B26] text-white lg:flex">
    <!-- Logo & Title -->
    <div class="flex items-center gap-3 border-b border-white/10 px-6 py-6">
        <div
            class="flex h-12 w-12 shrink-0 items-center justify-center overflow-hidden rounded-full bg-white ring-2 ring-secondary/60">
            <img src="https://upload.wikimedia.org/wikipedia/commons/5/5a/Lambang_Kabupaten_Rokan_Hilir.png"
                alt="Logo Kabupaten Rokan Hilir" class="h-9 w-9 object-contain">
        </div>
        <div class="min-w-0">
            <p class="text-[10px] font-semibold uppercase tracking-[0.2em] text-secondary">Admin Panel</p>
            <h2 class="truncate font-serif text-base font-semibold text-white">Kep. Sintong Pusaka</h2>
        </div>
    </div>

    <!-- Nav Menu -->
    <nav class="flex-1 space-y-6 overflow-y-auto px-4 py-6">
        @php
            $groups = [
                'Utama' => [['route' => 'dashboard', 'icon' => 'layout-dashboard', 'label' => 'Dashboard']],
                'Konten' => [
                    ['route' => 'berita.index', 'icon' => 'newspaper', 'label' => 'Berita'],
                    ['route' => 'galeri.index', 'icon' => 'image', 'label' => 'Galeri'],
                ],
                'Data Desa' => [
                    ['route' => 'aparat_desa.index', 'icon' => 'users', 'label' => 'Aparat Desa'],
                    ['route' => 'demografis.index', 'icon' => 'globe-2', 'label' => 'Demografis'],
                ],
            ];
        @endphp

        @foreach ($groups as $label => $items)
            <div>
                <p class="mb-2 px-3 text-xs font-semibold uppercase tracking-[0.15em] text-white/40">
                    {{ $label }}
                </p>
                <div class="space-y-1.5">
                    @foreach ($items as $item)
                        @php $active = Request::routeIs($item['route']) || Request::routeIs($item['route'] . '.*'); @endphp
                        <a href="{{ route($item['route']) }}"
                            class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm transition
                                {{ $active ? 'bg-white/10 font-semibold text-white shadow-sm' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                            <i data-lucide="{{ $item['icon'] }}" class="h-5 w-5 shrink-0"></i>
                            <span>{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endforeach
    </nav>

    <!-- Logout -->
    <div class="border-t border-white/10 px-4 py-5">
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="button" onclick="logoutConfirm()"
                class="flex w-full items-center gap-3 rounded-xl bg-white/5 px-4 py-3 text-sm font-medium text-white/90 transition hover:bg-white/10">
                <i data-lucide="log-out" class="h-5 w-5"></i>
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
            confirmButtonColor: '#1F6B3D',
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
