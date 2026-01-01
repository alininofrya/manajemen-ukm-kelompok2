<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['ukm_id', 'nama_event', 'tanggal', 'lokasi', 'deskripsi', 'poster'];

    // Relasi: Event ini milik UKM mana?
    public function ukm()
    {
        return $this->belongsTo(Ukm::class);
    }
}
