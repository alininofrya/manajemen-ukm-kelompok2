<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Event;
use App\Models\Ukm;
use App\Models\User;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengurusController extends Controller
{
    public function index()
    {
        // Mengambil data anggota dan UKM yang dikelola pengurus yang sedang login
        $member = Member::where('user_id', Auth::id())->first();

        // --- PERBAIKAN: Cek apakah user ini terdaftar sebagai member/pengurus ---
        if (!$member) {
            return redirect('/')->with('error', 'Akun Anda tidak terdaftar sebagai Pengurus UKM.');
        }

        $ukm = Ukm::find($member->ukm_id);

        // Cek jika UKM nya tidak ditemukan (misal terhapus)
        if (!$ukm) {
            return redirect('/')->with('error', 'Data UKM tidak ditemukan.');
        }

        // Menghitung total data untuk statistik di dashboard
        $totalEvent = Event::where('ukm_id', $ukm->id)->count();
        $totalAnggota = Member::where('ukm_id', $ukm->id)->count();

        // Mengambil 5 pendaftar terbaru yang mendaftar ke event milik UKM ini
        $pendaftarTerbaru = Pendaftaran::whereHas('event', function ($query) use ($ukm) {
            $query->where('ukm_id', $ukm->id);
        })->with(['user', 'event'])->latest()->take(5)->get();

        // Mengambil semua event untuk katalog di bagian bawah dashboard
        $events = Event::where('ukm_id', $ukm->id)->latest()->get();

        return view('pengurus.dashboard', compact('ukm', 'member', 'totalEvent', 'totalAnggota', 'events', 'pendaftarTerbaru'));
    }

public function anggotaIndex(Request $request)
{
    $member = Member::where('user_id', Auth::id())->first();

    if (!$member) {
        return redirect()->back()->with('error', 'Akses ditolak. Anda bukan pengurus.');
    }

    $ukm = Ukm::find($member->ukm_id);

    public function downloadBerkas($id)
{
    // Cari data pendaftar
    $pendaftar = \App\Models\Pendaftaran::findOrFail($id); // Sesuaikan nama Modelmu

    // Cek apakah kolom berkas ada isinya
    if (!$pendaftar->berkas) {
        return back()->with('error', 'File tidak ditemukan di database.');
    }

    // Cek fisik file di storage
    // Asumsi: file tersimpan langsung di dalam folder 'storage/app/public'
    // Jika ada di folder sub, misal 'uploads', ubah jadi: 'uploads/' . $pendaftar->berkas
    $path = $pendaftar->berkas;

    // Gunakan disk 'public'
    if (Storage::disk('public')->exists($path)) {
        return Storage::disk('public')->download($path);
    }

    return back()->with('error', 'File fisik tidak ditemukan di server.');
}

    // --- LOGIKA PENCARIAN & PAGINATION ---
    $query = Member::where('ukm_id', $ukm->id)->with('user');

    // Jika ada input pencarian
    if ($request->has('search')) {
        $search = $request->search;
        $query->whereHas('user', function($q) use ($search) {
            $q->where('name', 'LIKE', "%{$search}%")
              ->orWhere('email', 'LIKE', "%{$search}%");
        })->orWhere('jabatan', 'LIKE', "%{$search}%")
          ->where('ukm_id', $ukm->id); // Pastikan tetap di UKM yang sama
    }

    // Ambil data dengan pagination (10 data per halaman)
    // append(['search' => ...]) berguna agar saat pindah halaman, pencarian tidak hilang
    $anggota = $query->paginate(10)->appends(['search' => $request->search]);

    // Ambil user untuk modal tambah (tetap sama)
    $users = User::where('role', 'mahasiswa')
        ->whereDoesntHave('member', function ($query) use ($ukm) {
            $query->where('ukm_id', $ukm->id);
        })->get();

    return view('pengurus.anggota.index', compact('ukm', 'anggota', 'users'));
}

    public function anggotaStore(Request $request)
    {
        $admin = Member::where('user_id', Auth::id())->first();

        // --- PERBAIKAN: Validasi Member ---
        if (!$admin) {
            return redirect()->back()->with('error', 'Akses Ditolak.');
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'jabatan' => 'required|string|max:255'
        ]);

        // Cek apakah user sudah terdaftar di UKM ini (proteksi tambahan)
        $exists = Member::where('user_id', $request->user_id)
            ->where('ukm_id', $admin->ukm_id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Mahasiswa ini sudah terdaftar di UKM Anda.');
        }

        Member::create([
            'user_id' => $request->user_id,
            'ukm_id' => $admin->ukm_id,
            'jabatan' => $request->jabatan,
        ]);

        return redirect()->back()->with('success', 'Anggota berhasil ditambahkan!');
    }

    public function anggotaUpdate(Request $request, $id)
    {
        // Ambil member dulu untuk validasi email unik
        $member = Member::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            // Perbaikan validasi email: ignore email milik user yang sedang diedit
            'email' => 'required|email|unique:users,email,' . $member->user_id,
            'jabatan' => 'required|string|max:255',
        ]);

        $member->update([
            'jabatan' => $request->jabatan
        ]);

        $user = User::findOrFail($member->user_id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        return redirect()->back()->with('success', 'Data anggota berhasil diperbarui!');
    }

    public function anggotaDestroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();

        return redirect()->back()->with('success', 'Anggota berhasil dihapus!');
    }

    public function pendaftar()
    {
        $member = Member::where('user_id', Auth::id())->first();

        // --- PERBAIKAN: Validasi Member ---
        if (!$member) {
            return redirect('/')->with('error', 'Akses Ditolak.');
        }

        // Ambil semua pendaftaran yang masuk ke event-event milik UKM pengurus ini
        $pendaftarans = Pendaftaran::whereHas('event', function ($query) use ($member) {
            $query->where('ukm_id', $member->ukm_id);
        })->with(['user', 'event'])->latest()->get();

        return view('pengurus.pendaftar.index', compact('pendaftarans'));
    }

    public function updateStatus(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->update([
            'status' => $request->status // berisi 'diterima' atau 'ditolak'
        ]);

        return redirect()->back()->with('success', 'Status pendaftaran berhasil diperbarui!');
    }
}
