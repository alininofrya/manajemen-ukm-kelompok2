<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingController; // Controller baru untuk Landing Page
use App\Http\Controllers\Admin\UkmController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Pengurus\PengurusController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Mahasiswa\MahasiswaController;
use Illuminate\Support\Facades\Route;

// --- PUBLIC ROUTES (Tanpa Login) ---
// Halaman Utama dengan template Medinova
Route::get('/', [LandingController::class, 'index'])->name('landing');
// Detail event yang nantinya akan mencegat user jika belum login
Route::get('/event/{id}', [LandingController::class, 'showEvent'])->name('event.public.show');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// --- AUTHENTICATED ROUTES (Wajib Login) ---
Route::middleware(['auth'])->group(function () {

    // --- ROLE: ADMIN ---
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::resource('admin/ukm', UkmController::class)->names('admin.ukm');
        Route::resource('admin/users', UserController::class)->names('admin.users');
    });

    // --- ROLE: PENGURUS ---
    Route::middleware(['role:pengurus'])->group(function () {
        Route::get('/pengurus/dashboard', [PengurusController::class, 'index'])->name('pengurus.dashboard');

        // Route Event
        Route::get('/pengurus/event', [EventController::class, 'index'])->name('pengurus.event.index');
        Route::get('/pengurus/event/create', [EventController::class, 'create'])->name('pengurus.event.create');
        Route::post('/pengurus/event/store', [EventController::class, 'store'])->name('pengurus.event.store');
        Route::get('/pengurus/event/{id}', [EventController::class, 'show'])->name('pengurus.event.show');
        Route::get('/pengurus/event/{id}/edit', [EventController::class, 'edit'])->name('pengurus.event.edit');
        Route::put('/pengurus/event/{id}', [EventController::class, 'update'])->name('pengurus.event.update');
        Route::delete('/pengurus/event/{id}', [EventController::class, 'destroy'])->name('pengurus.event.destroy');

        // Manajemen Anggota UKM
        Route::get('/pengurus/anggota', [PengurusController::class, 'anggotaIndex'])->name('pengurus.anggota.index');
        Route::post('/pengurus/anggota/store', [PengurusController::class, 'anggotaStore'])->name('pengurus.anggota.store');
        Route::put('/pengurus/anggota/{id}', [PengurusController::class, 'anggotaUpdate'])->name('pengurus.anggota.update');
        Route::delete('/pengurus/anggota/{id}', [PengurusController::class, 'anggotaDestroy'])->name('pengurus.anggota.destroy');

        // Manajemen Pendaftar Event
        // Pastikan tulisannya 'checkRole', bukan 'role'
        Route::middleware(['auth', 'checkRole:pengurus'])->group(function () {
            Route::get('/pengurus/pendaftar', [PengurusController::class, 'pendaftar'])->name('pengurus.pendaftar.index');
            Route::post('/pengurus/pendaftar/{id}/update-status', [PengurusController::class, 'updateStatus'])->name('pengurus.pendaftar.update');
            // ... rute lainnya milik pengurus
        });
    });

    // --- ROLE: MAHASISWA ---
    Route::middleware(['role:mahasiswa'])->group(function () {
        // Halaman Dashboard Utama Kaia
        Route::get('/mahasiswa/dashboard', [MahasiswaController::class, 'index'])->name('mahasiswa.dashboard');

        // Fitur 1: Daftar jadi anggota organisasi (UKM)
        Route::post('/mahasiswa/daftar-ukm/{id}', [MahasiswaController::class, 'daftarUkm'])->name('mahasiswa.daftar');

        // Fitur 2: Daftar jadi peserta kegiatan (Event)
        // Tambahkan rute ini agar tidak "Not Found" saat klik daftar di detail event
        Route::post('/mahasiswa/event/daftar/{id}', [MahasiswaController::class, 'daftarEvent'])->name('event.daftar');

        // Halaman Form Pendaftaran
        Route::get('/mahasiswa/event/{id}/daftar', [MahasiswaController::class, 'showDaftarEvent'])->name('mahasiswa.event.form');

        // Proses Simpan Pendaftaran & File
        Route::post('/mahasiswa/event/{id}/simpan', [MahasiswaController::class, 'simpanPendaftaran'])->name('mahasiswa.event.simpan');
    });

});