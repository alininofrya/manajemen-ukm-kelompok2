<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Ukm;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Tambahan library Storage

class MahasiswaController extends Controller
{
    public function index()
    {
        // 1. Ambil semua UKM untuk pilihan mendaftar anggota
        $ukms = Ukm::all();

        // 2. Ambil pendaftaran event milik mahasiswa yang sedang login
        $myEvents = Pendaftaran::where('user_id', auth()->id())
            ->whereNotNull('event_id')
            ->with('event.ukm')
            ->latest()
            ->get();

        return view('mahasiswa.dashboard', compact('ukms', 'myEvents'));
    }

    public function daftarUkm(Request $request, $id)
    {
        // Cek apakah mahasiswa sudah mendaftar di UKM ini sebelumnya
        $exists = Pendaftaran::where('user_id', Auth::id())
            ->where('ukm_id', $id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Kamu sudah mendaftar di UKM ini!');
        }

        // Simpan data pendaftaran
        Pendaftaran::create([
            'user_id' => Auth::id(),
            'ukm_id' => $id,
            'status' => 'pending', // Menunggu persetujuan pengurus
            'tanggal_daftar' => now(),
        ]);

        return redirect()->back()->with('success', 'Berhasil mendaftar! Tunggu konfirmasi pengurus.');
    }

    public function daftarEvent($id)
    {
        // 1. Validasi: Cek apakah mahasiswa sudah mendaftar di event ini
        $exists = Pendaftaran::where('user_id', auth()->id())
            ->where('event_id', $id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Kamu sudah terdaftar di event ini!');
        }

        // 2. Simpan ke tabel pendaftarans
        Pendaftaran::create([
            'user_id' => auth()->id(),
            'event_id' => $id,
            'ukm_id' => null,      // Pastikan ukm_id kosong karena ini pendaftaran EVENT
            'status' => 'pending', // Menunggu persetujuan
            'berkas' => null,      // Berkas opsional untuk event
        ]);

        // 3. Redirect ke dashboard mahasiswa
        return redirect()->route('mahasiswa.dashboard')->with('success', 'Berhasil mendaftar event!');
    }

    public function showDaftarEvent($id)
    {
        // Cari data event yang diklik
        $event = \App\Models\Event::findOrFail($id);
        return view('mahasiswa.form_event', compact('event'));
    }

    // --- BAGIAN INI YANG DIPERBAIKI (AGAR FILE TERBACA OLEH PENGURUS) ---
    public function simpanPendaftaran(Request $request, $id)
    {
        // 1. Validasi berkas
        $request->validate([
            'berkas' => 'required|mimes:pdf,jpg,png,jpeg|max:2048', // Maksimal 2MB
        ]);

        // 2. Cek duplikasi pendaftaran (Biar gak double)
        $exists = Pendaftaran::where('user_id', auth()->id())
            ->where('event_id', $id)
            ->exists();

        if ($exists) {
            return redirect()->route('mahasiswa.dashboard')->with('error', 'Kamu sudah mendaftar di event ini sebelumnya.');
        }

        // 3. SETUP NAMA FILE & PENYIMPANAN YANG BENAR
        // Kita pakai format nama: WAKTU_IDUSER.EXTENSI (Contoh: 1767598004_3.pdf)
        $fileName = time() . '_' . auth()->id() . '.' . $request->berkas->extension();

        // PENTING: Gunakan storeAs ke folder 'public/pendaftaran'
        // Ini akan otomatis masuk ke: storage/app/public/pendaftaran/
        $request->file('berkas')->storeAs('public/pendaftaran', $fileName);

        // 4. Simpan ke Database dengan Path Lengkap
        // Kita simpan string: "public/pendaftaran/namafile.pdf"
        // Nanti Controller Pengurus akan membersihkan kata "public/"-nya otomatis.
        Pendaftaran::create([
            'user_id' => auth()->id(),
            'event_id' => $id,
            'berkas' => 'public/pendaftaran/' . $fileName, // Format Path diperbaiki
            'status' => 'pending',
        ]);

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Berhasil mendaftar event! Berkas berhasil diupload.');
    }
}
