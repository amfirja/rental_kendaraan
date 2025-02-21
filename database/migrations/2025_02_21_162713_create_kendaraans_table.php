<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('kendaraans', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->enum('jenis', ['motor','mobil']);
        $table->string('plat_nomor')->unique();
        $table->decimal('harga_sewa', 10, 2);
        $table->enum('status', ['tersedia','disewa'])->default('tersedia');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraans');
    }
};
