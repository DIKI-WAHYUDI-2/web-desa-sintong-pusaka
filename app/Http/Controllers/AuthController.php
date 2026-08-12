<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Session;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $akun = Pengguna::create([
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $throttleKey = Str::lower($credentials['email']) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return redirect()->route('login')
                ->with('error', "Terlalu banyak percobaan login. Coba lagi dalam {$seconds} detik.");
        }

        $akun = Pengguna::where('email', $credentials['email'])->first();

        if ($akun && Hash::check($credentials['password'], $akun->password)) {
            RateLimiter::clear($throttleKey);

            // Cegah session fixation: buat session id baru setelah login berhasil
            $request->session()->regenerate();

            Auth::login($akun);
            return redirect()->route('dashboard')->with('success', 'Login berhasil!');
        }

        RateLimiter::hit($throttleKey, 60);

        return redirect()->route('login')->with('error', 'Email atau password salah!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logout berhasil!');
    }

}