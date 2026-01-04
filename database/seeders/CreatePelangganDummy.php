<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\DB;

class CreatePelangganDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(){
    $faker = \Faker\Factory::create();

    foreach (range(1, 100) as $index) {
        DB::table('mahasiswa')->insert([
            'nim'        => $faker->unique()->numerify('245530####'),
            'first_name' => $faker->firstName,
            'last_name'  => $faker->lastName,
            'birthday'   => $faker->dateTimeBetween('2005-12-31', '2007-10-11')->format('Y-m-d'),
            'gender'     => $faker->randomElement(['Male', 'Female']),
            'prodi'      => $faker->randomElement(['TI','SI','TRK','TET','Akuntansi','TM','TL','TRM','TE','TRJT']),
            'email'      => $faker->unique()->safeEmail,
            'password'   => $faker->password(10)
        ]);
    }
}
}
