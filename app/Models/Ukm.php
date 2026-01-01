<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ukm extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_ukm',
        'kategori',
        'deskripsi',
        'pembina',
        'status'
    ];

    // Relasi: Satu UKM punya banyak Event
    public function events()
    {
        return $this->hasMany(Event::class);
    }

    // TAMBAHKAN INI: Agar Admin bisa melihat anggota/pengurus UKM
    public function members()
    {
        return $this->hasMany(Member::class, 'ukm_id');
    }
}