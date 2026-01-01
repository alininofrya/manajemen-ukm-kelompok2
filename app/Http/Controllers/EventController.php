<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $ukmId = auth()->user()->member->ukm_id;

        // Mengambil event milik UKM ini, beserta jumlah pendaftarnya (nanti jika sudah ada tabel pendaftar)
        $events = Event::where('ukm_id', $ukmId)->latest()->get();

        return view('pengurus.event.index', compact('events'));
    }

    public function create()
    {
        return view('pengurus.event.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_event' => 'required',
            'tanggal' => 'required|date',
            'lokasi' => 'required',
            'deskripsi' => 'required',
            'poster' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Ambil ukm_id
        $ukmId = auth()->user()->member->ukm_id;

        // Inisialisasi nama file
        $namaFile = null;

        if ($request->hasFile('poster')) {
            $file = $request->file('poster');
            // Gunakan format nama file yang bersih
            $namaFile = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());

            /** * PENTING: Simpan ke folder 'posters' di dalam disk 'public'
             * Ini akan otomatis masuk ke storage/app/public/posters
             */
            $file->storeAs('posters', $namaFile, 'public');
        }

        Event::create([
            'ukm_id' => $ukmId,
            'nama_event' => $request->nama_event,
            'tanggal' => $request->tanggal,
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->deskripsi,
            'poster' => $namaFile,
        ]);

        return redirect()->route('pengurus.dashboard')->with('success', 'Event Berhasil Ditambahkan!');
    }

    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);

        // Hapus file gambar dari storage agar tidak memenuhi memori
        if ($event->poster) {
            Storage::disk('public')->delete('posters/' . $event->poster);
        }

        $event->delete();

        return redirect()->back()->with('success', 'Event berhasil dihapus!');
    }

    public function show(string $id)
    {
        // Ambil data event berdasarkan ID beserta data UKM-nya
        $event = Event::with('ukm')->findOrFail($id);

        // Arahkan ke view detail (kita akan buat filenya setelah ini)
        return view('pengurus.event.show', compact('event'));
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('pengurus.event.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $request->validate([
            'nama_event' => 'required',
            'tanggal' => 'required|date',
            'lokasi' => 'required',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('poster')) {
            // Hapus poster lama
            Storage::disk('public')->delete('posters/' . $event->poster);

            // Upload poster baru
            $file = $request->file('poster');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('posters', $namaFile, 'public');
            $data['poster'] = $namaFile;
        }

        $event->update($data);

        return redirect()->route('pengurus.event.index')->with('success', 'Event berhasil diperbarui!');
    }
}