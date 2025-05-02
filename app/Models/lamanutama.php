<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\kategori;

class lamanutama extends Model
{
    use HasFactory;
    public function kategori()
    {
        return $this->belongsTo(kategori::class);
    }

    //guarded semua boleh diisi kecuali apa
    protected $fillable = ['nama_produk', 'jumlah_stok', 'harga', 'kategori_id'];
}
