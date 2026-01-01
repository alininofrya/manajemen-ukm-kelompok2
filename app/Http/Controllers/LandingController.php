<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $events = Event::with('ukm')->latest()->get();
        return view('landing', compact('events'));
    }

    public function showEvent($id)
    {
        // Jika belum login, arahkan ke login
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk melihat detail event.');
        }

        $event = Event::findOrFail($id);
        return view('mahasiswa.event_detail', compact('event'));
    }
}