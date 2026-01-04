<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UKMController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        return view('UKM.ukm-question-respon',[
        'nama' => $request->nama,
        'kelas' => $request->kelas,
        'posisi' => $request->posisi,
        'posisi2' => $request->posisi2,
        'tujuan' => $request->tujuan
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $param1)
    {
        if($param1 == 'ukm'){
            return view('UKM');
        }elseif($param1 == 'basket'){
            return view('UKM.Basket');
        }elseif($param1 == 'musik'){
            return view('UKM.Musik');
        }elseif($param1 == 'seni_tari'){
            return view('UKM.seni_tari');
        }elseif($param1 == 'sepak_bola'){
            return view('UKM.Sepak_Bola');
        }elseif($param1 == 'voli'){
            return view('UKM.Voli');
        }elseif($param1 == 'Taekwondo'){
            return view('UKM.Taekwondo');
        }
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
