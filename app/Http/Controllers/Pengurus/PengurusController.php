<?php

namespace App\Http\Controllers\Pengurus;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    // =========================
    // LIST EVENT
    // =========================
    public function index()
    {
        $member = Member::where('user_id', Auth::id())->firstOrFail();

        $events = Event::where('ukm_id', $member->ukm_id)->latest()->get();

        return view('pengurus.event.index', compact('events'));
    }

    // =========================
    // FORM EDIT EVENT
    // =========================
    public function edit($id)
    {
        $member = Member::where('user_id', Auth::id())->firstOrFail();

        $event = Event::where('id', $id)
            ->where('ukm_id', $member->ukm_id)
            ->firstOrFail();

        return view('pengurus.event.edit', compact('event'));
    }

    // =========================
    // UPDATE EVENT (UPLOAD POSTER JPG / PNG)
    // =========================
    public function update(Request $request, $id)
    {
        $member = Member::where('user_id', Auth::id())->firstOrFail();

        $event = Event::where('id', $id)
            ->where('ukm_id', $member->ukm_id)
            ->firstOrFail();

        // 🔐 VALIDASI
        $request->validate([
            'nama_event' => 'required|string|max:255',
            'tanggal'    => 'required|date',
            'lokasi'     => 'required|string|max:255',
            'deskripsi'  => 'required|string',

            // HANYA JPG & PNG
            'poster'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // =========================
        // UPDATE DATA EVENT
        // =========================
        $event->update([
            'nama_event' => $request->nama_event,
            'tanggal'    => $request->tanggal,
            'lokasi'     => $request->lokasi,
            'deskripsi'  => $request->deskripsi,
        ]);

        // =========================
        // UPLOAD POSTER BARU (JIKA ADA)
        // =========================
        if ($request->hasFile('poster')) {

            // Hapus poster lama
            if ($event->poster && Storage::disk('public')->exists('poster_event/' . $event->poster)) {
                Storage::disk('public')->delete('poster_event/' . $event->poster);
            }

            // Simpan poster baru
            $file = $request->file('poster');
            $namaFile = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $file->storeAs('poster_event', $namaFile, 'public');

            $event->poster = $namaFile;
            $event->save();
        }

        return redirect()
            ->route('pengurus.event.index')
            ->with('success', 'Event berhasil diperbarui!');
    }

    // =========================
    // HAPUS EVENT + POSTER
    // =========================
    public function destroy($id)
    {
        $member = Member::where('user_id', Auth::id())->firstOrFail();

        $event = Event::where('id', $id)
            ->where('ukm_id', $member->ukm_id)
            ->firstOrFail();

        // Hapus poster
        if ($event->poster && Storage::disk('public')->exists('poster_event/' . $event->poster)) {
            Storage::disk('public')->delete('poster_event/' . $event->poster);
        }

        $event->delete();

        return redirect()->back()->with('success', 'Event berhasil dihapus!');
    }
}
