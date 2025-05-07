<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AkunadminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('akunadmin')->insert([
            "namapengguna" => "admin1",
            "katasandi" => Hash::make("12345") // Enkripsi kata sandi menggunakan Hash::make()
        ]);
    }
}
