<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategoris')->insert([
            "nama" => "Sendok"
        ]);
        DB::table('kategoris')->insert([
            "nama" => "Gelas"
        ]);
        DB::table('kategoris')->insert([
            "nama" => "Mangkok"
        ]);
    }
}
