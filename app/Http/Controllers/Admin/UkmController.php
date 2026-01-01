<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ukm;
use Illuminate\Http\Request;

class UkmController extends Controller
{
    public function index()
    {
        // Mengambil semua data UKM
        $ukms = Ukm::latest()->get();
        return view('admin.ukm.index', compact('ukms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ukm' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'pembina' => 'required|string|max:255',
        ]);

        Ukm::create([
            'nama_ukm' => $request->nama_ukm,
            'kategori' => $request->kategori,
            'pembina' => $request->pembina,
        ]);

        // KOREKSI: Mengarahkan ke admin.ukm.index (sesuai routes/web.php)
        return redirect()->route('admin.ukm.index')->with('success', 'UKM berhasil ditambahkan!');
    }

    public function show($id)
    {
        // Mengambil data UKM beserta anggota dan user-nya
        $ukm = Ukm::with('members.user')->findOrFail($id);
        return view('admin.ukm.show', compact('ukm'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_ukm' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'pembina' => 'required|string|max:255',
        ]);

        $ukm = Ukm::findOrFail($id);
        $ukm->update([
            'nama_ukm' => $request->nama_ukm,
            'kategori' => $request->kategori,
            'pembina' => $request->pembina,
        ]);

        // KOREKSI: Mengarahkan ke admin.ukm.index
        return redirect()->route('admin.ukm.index')->with('success', 'Data UKM berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $ukm = Ukm::findOrFail($id);
        $ukm->delete();

        // KOREKSI: Mengarahkan ke admin.ukm.index
        return redirect()->route('admin.ukm.index')->with('success', 'Data UKM berhasil dihapus!');
    }
}