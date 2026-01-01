<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = ['ukm_id', 'user_id', 'jabatan'];

    // Relasi: Member ini miliknya siapa (User mana?)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Member ini di UKM mana?
    public function ukm()
    {
        return $this->belongsTo(Ukm::class);
    }
}