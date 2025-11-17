<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kepenghuluan Sintong Pusaka - Kabupaten Rokan Hilir</title>
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/5/5a/Lambang_Kabupaten_Rokan_Hilir.png"
        type="image/png">
    {{-- Lucide Icons --}}
    <script src="https://unpkg.com/lucide@latest"></script>

    {{-- Load Tailwind & Alpine (via Vite) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-background text-foreground">
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-200 flex items-center justify-center p-4">
        <div class="w-full max-w-md">
            {{-- Logo / Branding --}}
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-600 rounded-2xl mb-4 shadow-lg">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/5/5a/Lambang_Kabupaten_Rokan_Hilir.png"
                        alt="Logo Kabupaten Rokan Hilir">
                </div>
                <h1 class="text-2xl font-bold mb-2">Admin Dashboard</h1>
                <p class="text-gray-600">Masuk ke panel administrasi</p>
            </div>

            {{-- Login Card --}}
            <div class="bg-white rounded-2xl shadow-2xl p-8">
                <h2 class="text-center text-lg font-semibold mb-6">Masuk ke Akun Anda</h2>

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

                @if(session('error'))
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                        Swal.fire({
                            title: 'Terjadi Kesalahan!',
                            icon: 'error',
                            text: '{{ session('error') }}',
                            confirmButtonText: 'OK'
                        });
                    </script>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-medium">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            class="mt-1 w-full px-3 py-2 border rounded-lg focus:ring-indigo-500 focus:border-indigo-500 @error('email') border-red-500 @enderror"
                            placeholder="admin@example.com" required autofocus>
                        @error('email')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="relative">
                        <label for="password" class="block text-sm font-medium">Password</label>

                        <input type="password" name="password" id="password"
                            class="mt-1 w-full px-3 py-2 pr-10 border rounded-lg focus:ring-indigo-500 focus:border-indigo-500 @error('password') border-red-500 @enderror"
                            placeholder="Masukkan password" required>

                        <!-- Icon Mata -->
                        <button type="button" id="togglePassword"
                            class="absolute right-3 top-11 -translate-y-4 mt-1 text-gray-600 hover:text-gray-800"> <i
                                data-lucide="eye"></i>
                        </button>

                        @error('password')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                        class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">
                        Masuk ke Dashboard
                    </button>
                </form>
            </div>

            <p class="text-center mt-8 text-sm text-gray-500">Developed by KKN UIN Suska 2025 <br>
                © {{ date('Y') }} Kepenghuluan Sintong Pusaka. All Right Reserved</p>
        </div>
    </div>
</body>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        lucide.createIcons(); // render icon lucide

        const togglePassword = document.getElementById("togglePassword");
        const passwordInput = document.getElementById("password");

        togglePassword.addEventListener("click", () => {
            const type = passwordInput.type === "password" ? "text" : "password";
            passwordInput.type = type;

            togglePassword.innerHTML =
                type === "password"
                    ? `<i data-lucide="eye"></i>`
                    : `<i data-lucide="eye-off"></i>`;

            lucide.createIcons();
        });
    });
</script>

</html>