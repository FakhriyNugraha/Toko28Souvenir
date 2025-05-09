<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembeli extends Model
{
    use HasFactory;

    // Jika nama tabel berbeda dengan nama model, Anda bisa mendeklarasikannya seperti ini:
    protected $table = 'pembelis';  // Pastikan ini sesuai dengan nama tabel di database

    protected $fillable = ['namapengguna', 'katasandi', 'foto'];
}

