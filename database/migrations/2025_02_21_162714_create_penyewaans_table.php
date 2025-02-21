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
    Schema::create('penyewaans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('kendaraan_id')->constrained();
        $table->date('tanggal_mulai');
        $table->date('tanggal_selesai');
        $table->decimal('total_biaya', 10, 2);
        $table->string('nama_penyewa');
        $table->string('kontak');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyewaans');
    }
};
