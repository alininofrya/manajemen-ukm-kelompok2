<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses login manual
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cek email dan password di database
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Ambil role user yang login
            $role = Auth::user()->role;

            // Redirect otomatis berdasarkan role
            if ($role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            } elseif ($role === 'pengurus') {
                return redirect()->intended('/pengurus/dashboard');
            } else {
                // UBAH DARI /mahasiswa/home MENJADI /mahasiswa/dashboard
                // Ini disesuaikan dengan ->name('mahasiswa.dashboard') di web.php
                return redirect()->intended('/mahasiswa/dashboard');
            }
        }

        // Jika gagal, kembali ke login dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password yang kamu masukkan salah.',
        ])->onlyInput('email');
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}