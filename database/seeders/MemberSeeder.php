<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Member;
use App\Models\Ukm;
use Illuminate\Support\Facades\Hash;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun Mahasiswa (Pengurus)
        $mhs = User::create([
            'name' => 'Hanifa Nadya',
            'email' => 'hanifa@student.pcr.ac.id',
            'password' => Hash::make('password123'),
            'role' => 'mahasiswa', // Pastikan kolom role ada di tabel users
        ]);

        // 2. Ambil ID UKM Vollyball yang baru kamu buat
        $ukm = Ukm::where('nama_ukm', 'LIKE', '%Volly%')->first();

        // 3. Masukkan Budi sebagai Ketua di UKM tersebut
        if ($ukm) {
            Member::create([
                'ukm_id' => $ukm->id,
                'user_id' => $mhs->id,
                'jabatan' => 'Ketua Umum',
            ]);
        }
    }
}