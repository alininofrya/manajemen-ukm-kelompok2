<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ukm;
use App\Models\Event;
use App\Models\Pendaftaran;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        // 1. Menghitung data untuk kotak statistik
        $totalUkm = Ukm::count();
        $totalEvent = Event::count();

        // PERBAIKAN: Gunakan variabel yang sudah disaring agar sinkron dengan tabel bawah
        $totalPendaftar = Pendaftaran::has('event')->count();

        // Menghitung total mahasiswa & pengurus
        $totalMahasiswa = User::whereIn('role', ['mahasiswa', 'pengurus'])->count();

        // 2. Mengambil 5 aktivitas pendaftaran terbaru (Sudah Benar)
        $pendaftarTerbaru = Pendaftaran::has('event')
            ->has('user')
            ->with(['user', 'event'])
            ->latest()
            ->take(5)
            ->get();

        // 3. Mengambil 5 UKM baru (Sudah Benar)
        $ukmBaru = Ukm::latest()->take(5)->get();

        // 4. Mengirim data ke view
        return view('admin.dashboard', compact(
            'totalUkm',
            'totalEvent',
            'totalPendaftar', // Sekarang isinya sudah pasti 0 jika tidak ada event aktif
            'totalMahasiswa',
            'pendaftarTerbaru',
            'ukmBaru'
        ));
    }
}