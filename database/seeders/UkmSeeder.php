<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ukm;

class UkmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

public function run(): void
{
    Ukm::create([
        'nama_ukm' => 'Vollyball',
        'kategori' => 'Olahraga',
        'pembina' => 'Alini Nofry',
        'status' => 'Aktif'
    ]);

    Ukm::create([
        'nama_ukm' => 'Futsal',
        'kategori' => 'Olahraga',
        'pembina' => 'Reginald Ricky',
        'status' => 'Aktif'
    ]);
}
}
