<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    // Tambahkan 'berkas' agar data nama file bisa disimpan ke database
    protected $fillable = ['user_id', 'event_id', 'status', 'berkas'];

    // Relasi ke User (Siapa yang daftar?)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Event (Daftar event apa?)
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}