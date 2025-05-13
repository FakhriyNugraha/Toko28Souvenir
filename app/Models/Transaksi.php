<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = ['namapengguna', 'total_harga', 'alamat'];

    public function details()
    {
        return $this->hasMany(TransaksiDetail::class);
    }

}
