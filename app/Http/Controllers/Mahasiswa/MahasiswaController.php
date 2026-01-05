<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Ukm;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    public function index()
    {
        // 1. Ambil semua UKM untuk pilihan mendaftar anggota
        $ukms = Ukm::all();

        // 2. Ambil pendaftaran event milik mahasiswa yang sedang login
        // Kita filter yang event_id-nya tidak null
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

        // 3. Redirect ke dashboard mahasiswa (Kaia Template)
        return redirect()->route('mahasiswa.dashboard')->with('success', 'Berhasil mendaftar event!');
    }

    public function showDaftarEvent($id)
    {
        // Cari data event yang diklik
        $event = \App\Models\Event::findOrFail($id);
        return view('mahasiswa.form_event', compact('event'));
    }

public function simpanPendaftaran(Request $request, $id)
    {
        // 1. Validasi: Sekarang yang dicek adalah TEKS, bukan File
        $request->validate([
            'alasan' => 'required|string|max:3000', // Wajib isi alasan
        ]);

        // 2. Cek duplikasi (biar gak daftar 2x)
        $exists = Pendaftaran::where('user_id', auth()->id())
            ->where('event_id', $id)
            ->exists();

        if ($exists) {
            return redirect()->route('mahasiswa.dashboard')->with('error', 'Kamu sudah mendaftar di event ini sebelumnya.');
        }

        // 3. Simpan ke Database
        // KITA AKALI: Kolom 'berkas' kita isi dengan Teks Alasan dari inputan user
        Pendaftaran::create([
            'user_id' => auth()->id(),
            'event_id' => $id,
            'berkas' => $request->alasan, // Teks alasan masuk ke kolom berkas
            'status' => 'pending',
        ]);

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Berhasil mendaftar event!');
    }
}
