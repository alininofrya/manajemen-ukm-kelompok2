<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Event;
use App\Models\Ukm;
use App\Models\User;
use App\Models\Pendaftaran; // Pastikan nama model sesuai file (Pendaftar atau Pendaftaran)
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Wajib ada

class PengurusController extends Controller
{
    public function index()
    {
        $member = Member::where('user_id', Auth::id())->first();
        if (!$member) return redirect('/')->with('error', 'Akun Anda tidak terdaftar sebagai Pengurus UKM.');

        $ukm = Ukm::find($member->ukm_id);
        if (!$ukm) return redirect('/')->with('error', 'Data UKM tidak ditemukan.');

        $totalEvent = Event::where('ukm_id', $ukm->id)->count();
        $totalAnggota = Member::where('ukm_id', $ukm->id)->count();

        $pendaftarTerbaru = Pendaftaran::whereHas('event', function ($query) use ($ukm) {
            $query->where('ukm_id', $ukm->id);
        })->with(['user', 'event'])->latest()->take(5)->get();

        $events = Event::where('ukm_id', $ukm->id)->latest()->get();

        return view('pengurus.dashboard', compact('ukm', 'member', 'totalEvent', 'totalAnggota', 'events', 'pendaftarTerbaru'));
    }

    public function anggotaIndex(Request $request)
    {
        $member = Member::where('user_id', Auth::id())->first();
        if (!$member) return redirect()->back()->with('error', 'Akses ditolak.');

        $ukm = Ukm::find($member->ukm_id);

        $query = Member::where('ukm_id', $ukm->id)->with('user');

        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            })->orWhere('jabatan', 'LIKE', "%{$search}%")
              ->where('ukm_id', $ukm->id);
        }

        $anggota = $query->paginate(10)->appends(['search' => $request->search]);

        $users = User::where('role', 'mahasiswa')
            ->whereDoesntHave('member', function ($query) use ($ukm) {
                $query->where('ukm_id', $ukm->id);
            })->get();

        return view('pengurus.anggota.index', compact('ukm', 'anggota', 'users'));
    }

    public function anggotaStore(Request $request)
    {
        $admin = Member::where('user_id', Auth::id())->first();
        if (!$admin) return redirect()->back()->with('error', 'Akses Ditolak.');

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'jabatan' => 'required|string|max:255'
        ]);

        $exists = Member::where('user_id', $request->user_id)
            ->where('ukm_id', $admin->ukm_id)
            ->exists();

        if ($exists) return redirect()->back()->with('error', 'Mahasiswa ini sudah terdaftar.');

        Member::create([
            'user_id' => $request->user_id,
            'ukm_id' => $admin->ukm_id,
            'jabatan' => $request->jabatan,
        ]);

        return redirect()->back()->with('success', 'Anggota berhasil ditambahkan!');
    }

    public function anggotaUpdate(Request $request, $id)
    {
        $member = Member::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $member->user_id,
            'jabatan' => 'required|string|max:255',
        ]);

        $member->update(['jabatan' => $request->jabatan]);

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
        if (!$member) return redirect('/')->with('error', 'Akses Ditolak.');

        $pendaftarans = Pendaftaran::whereHas('event', function ($query) use ($member) {
            $query->where('ukm_id', $member->ukm_id);
        })->with(['user', 'event'])->latest()->get();

        return view('pengurus.pendaftar.index', compact('pendaftarans'));
    }

    public function updateStatus(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'Status berhasil diperbarui!');
    }

    // --- FUNGSI DOWNLOAD BERKAS (SUDAH DI TEMPAT YANG BENAR) ---
    public function downloadBerkas($id)
    {
        $pendaftar = Pendaftaran::findOrFail($id);

        if (!$pendaftar->berkas) {
            return back()->with('error', 'File tidak ditemukan di database.');
        }

        // Membersihkan path dari kata 'public/' jika ada
        $cleanPath = str_replace('public/', '', $pendaftar->berkas);

        if (Storage::disk('public')->exists($cleanPath)) {
            return Storage::disk('public')->download($cleanPath);
        }

        return back()->with('error', 'File fisik tidak ditemukan. Path: ' . $cleanPath);
    }
}
