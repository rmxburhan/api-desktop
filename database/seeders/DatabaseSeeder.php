<?php

namespace Database\Seeders;

use App\Models\Obat;
use App\Models\Profil;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'username' => 'user' 
        ]);
        Obat::create([
            'kode_obat' => 'OBT1',
            'nama_obat' => 'Obat1',
            'exp_date' => '2022-09-09',
            'jumlah' => '90',
            'harga' => '90000',
        ]);
        Obat::create([
            'kode_obat' => 'OBT2',
            'nama_obat' => 'Obat2',
            'exp_date' => '2022-10-09',
            'jumlah' => '90',
            'harga' => '900',
        ]);
        Obat::create([
            'kode_obat' => 'OBT3',
            'nama_obat' => 'Obat3',
            'exp_date' => '2022-10-09',
            'jumlah' => '90',
            'harga' => '1000',
        ]);
        Profil::create([
            'latitude' => '-6.9425894',
            'longitude' => '106.9476664'
        ]);
      
    }
}
