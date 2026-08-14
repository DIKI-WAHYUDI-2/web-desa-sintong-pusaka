<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Admin - Kepenghuluan Sintong Pusaka</title>
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/5/5a/Lambang_Kabupaten_Rokan_Hilir.png"
        type="image/png">
    {{-- Lucide Icons --}}
    <script src="https://unpkg.com/lucide@latest"></script>

    {{-- Load Tailwind & Alpine (via Vite) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-background text-foreground antialiased">
    <div class="flex min-h-screen items-center justify-center px-4 py-10">
        <div class="w-full max-w-4xl overflow-hidden rounded-sm border border-border bg-white shadow-sm">
            <div class="grid grid-cols-1 md:grid-cols-2">

                {{-- Brand Panel --}}
                <div class="flex flex-col justify-between bg-[#123B26] p-8 text-white md:p-10">
                    <div>
                        <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-full bg-white shadow-sm">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/5/5a/Lambang_Kabupaten_Rokan_Hilir.png"
                                alt="Kabupaten Rokan Hilir" class="h-9 w-9 object-contain">
                        </div>
                        <p class="mb-2 text-xs font-semibold uppercase tracking-[0.24em] text-secondary">
                            Portal Pemerintahan Desa
                        </p>
                        <h1 class="text-2xl font-semibold leading-snug text-white md:text-3xl">
                            Kepenghuluan Sintong Pusaka
                        </h1>
                    </div>
                </div>

                {{-- Form Panel --}}
                <div class="flex flex-col justify-center p-8 md:p-10">
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold text-foreground">Masuk ke akun Anda</h2>
                        <p class="mt-2 text-sm text-muted-foreground">
                            Gunakan email dan password yang telah diberikan
                        </p>
                    </div>

                    @if (session('success'))
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <script>
                            document.addEventListener('DOMContentLoaded', () => {
                                Swal.fire({
                                    title: 'Sukses!',
                                    text: @json(session('success')),
                                    icon: 'success',
                                    confirmButtonColor: '#1F6B3D'
                                });
                            });
                        </script>
                    @endif
                    @if (session('error'))
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <script>
                            document.addEventListener('DOMContentLoaded', () => {
                                Swal.fire({
                                    title: 'Terjadi kesalahan',
                                    text: @json(session('error')),
                                    icon: 'error',
                                    confirmButtonColor: '#1F6B3D'
                                });
                            });
                        </script>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="space-y-5">
                        @csrf
                        {{-- Email --}}
                        <div>
                            <label for="email" class="admin-label">Email</label>
                            <div class="relative">
                                <span
                                    class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-muted-foreground">
                                    <i data-lucide="mail" class="h-4 w-4"></i>
                                </span>
                                <input type="email" name="email" id="email" value="{{ old('email') }}"
                                    placeholder="admin@sintongpusaka.desa.id" required autofocus
                                    class="admin-input pl-10 @error('email') border-red-500 focus:ring-red-500/20 @enderror">
                            </div>
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div>
                            <label for="password" class="admin-label">Password</label>
                            <div class="relative">
                                <span
                                    class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-muted-foreground">
                                    <i data-lucide="lock" class="h-4 w-4"></i>
                                </span>
                                <input type="password" name="password" id="password" placeholder="Masukkan password"
                                    required
                                    class="admin-input pl-10 pr-11 @error('password') border-red-500 focus:ring-red-500/20 @enderror">
                                <button type="button" id="togglePassword"
                                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-muted-foreground transition hover:text-primary">
                                    <i data-lucide="eye" class="h-4 w-4"></i>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Submit --}}
                        <button type="submit"
                            class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-primary/90 disabled:cursor-not-allowed disabled:opacity-60">
                            Masuk ke dashboard
                        </button>
                    </form>

                    <div class="mt-6 flex items-center gap-2 text-xs text-muted-foreground">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <p class="pb-8 text-center text-xs text-muted-foreground">
        © {{ date('Y') }} Pemerintah Kepenghuluan Sintong Pusaka
    </p>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.lucide) {
                lucide.createIcons();
            }
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', () => {
                    const type = passwordInput.type === 'password' ? 'text' : 'password';
                    passwordInput.type = type;
                    togglePassword.innerHTML = type === 'password' ?
                        '<i data-lucide="eye" class="h-4 w-4"></i>' :
                        '<i data-lucide="eye-off" class="h-4 w-4"></i>';
                    lucide.createIcons();
                });
            }
        });
    </script>
</body>

</html>
