<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\lamanutama;

class kategori extends Model
{
    use HasFactory;

    public function lamanutamas()
    {
        return $this->hasMany(lamanutama::class);
    }
}
