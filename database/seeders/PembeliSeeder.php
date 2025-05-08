<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PembeliSeeder extends Seeder
{
    public function run()
    {
        DB::table('pembelis')->insert([
            'namapengguna' => 'pembeli1',
            'katasandi' => bcrypt('12345'),
            'foto' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
