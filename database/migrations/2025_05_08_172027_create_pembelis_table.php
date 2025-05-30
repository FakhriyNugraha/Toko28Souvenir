<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelisTable extends Migration
{
    public function up()
    {
        Schema::create('pembelis', function (Blueprint $table) {
            $table->id();
            $table->string('namapengguna')->unique();
            $table->string('katasandi');
            $table->string('foto')->nullable(); // foto profil opsional
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pembelis');
    }
}
