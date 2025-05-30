<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pembelis', function (Blueprint $table) {
            $table->text('alamat')->after('katasandi')->nullable();
            $table->string('no_hp', 15)->after('alamat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembelis', function (Blueprint $table) {
            //
        });
    }
};
