<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // database/migrations/xxxx_xx_xx_create_carts_table.php

   public function up()
   {
       Schema::create('keranjangs', function (Blueprint $table) {
           $table->id();
           $table->unsignedBigInteger('pembeli_id');
           $table->unsignedBigInteger('produk_id');
           $table->integer('jumlah');
           $table->timestamps();
           $table->foreign('pembeli_id')->references('id')->on('pembelis')->onDelete('cascade');
           $table->foreign('produk_id')->references('id')->on('produks')->onDelete('cascade');
       });
   }
   


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
