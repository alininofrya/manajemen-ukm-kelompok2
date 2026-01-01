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
        $ukm = Ukm::find($member->ukm_id);

        // Menghitung total data untuk statistik di dashboard
        $totalEvent = Event::where('ukm_id', $ukm->id)->count();
        $totalAnggota = Member::where('ukm_id', $ukm->id)->count();

        // PERBAIKAN: Mengambil 5 pendaftar terbaru yang mendaftar ke event milik UKM ini
        $pendaftarTerbaru = Pendaftaran::whereHas('event', function ($query) use ($ukm) {
            $query->where('ukm_id', $ukm->id);
        })->with(['user', 'event'])->latest()->take(5)->get();

        // Mengambil semua event untuk katalog di bagian bawah dashboard
        $events = Event::where('ukm_id', $ukm->id)->latest()->get();

        return view('pengurus.dashboard', compact('ukm', 'member', 'totalEvent', 'totalAnggota', 'events', 'pendaftarTerbaru'));
    }

    public function anggotaIndex()
    {
        $member = Member::where('user_id', Auth::id())->first();
        if (!$member)
            return redirect()->back()->with('error', 'Data tidak ditemukan.');

        $ukm = Ukm::find($member->ukm_id);

        // Ambil daftar anggota UKM saat ini
        $anggota = Member::where('ukm_id', $ukm->id)->with('user')->get();

        // OPSI A: Ambil semua mahasiswa agar bisa ditambah secara bebas
        // Namun, kita filter agar mahasiswa yang SUDAH jadi anggota di UKM ini tidak muncul lagi di pilihan
        $users = User::where('role', 'mahasiswa')
            ->whereDoesntHave('member', function ($query) use ($ukm) {
                $query->where('ukm_id', $ukm->id);
            })->get();

        return view('pengurus.anggota.index', compact('ukm', 'anggota', 'users'));
    }

    public function anggotaStore(Request $request)
    {
        $admin = Member::where('user_id', Auth::id())->first();

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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Member::find($id)->user_id,
            'jabatan' => 'required|string|max:255',
        ]);

        $member = Member::findOrFail($id);
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