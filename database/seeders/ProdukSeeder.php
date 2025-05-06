<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('produks')->insert([
            "nama_produk" => "Sendok Cabe",
            "jumlah_stok" => 250,
            "harga" => "Rp800/pcs",
            "kategori_id" => 1
        ]);
        DB::table('produks')->insert([
            "nama_produk" => "Gelas Kaca",
            "jumlah_stok" => 200,
            "harga" => "Rp1500/pcs",
            "kategori_id" => 2
        ]);
        DB::table('produks')->insert([
            "nama_produk" => "Mangkok Bola",
            "jumlah_stok" => 100,
            "harga" => "Rp2000/pcs",
            "kategori_id" => 3
        ]);
    }
}
