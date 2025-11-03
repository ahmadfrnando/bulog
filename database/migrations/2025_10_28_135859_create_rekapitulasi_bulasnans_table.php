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
        Schema::create('rekapitulasi_bulanan', function (Blueprint $table) {
            $table->id();
            $table->string('tahun');
            $table->string('bulan');
            $table->unsignedBigInteger('komoditas_id');
            $table->string('nama_komoditas');
            $table->decimal('harga_rata_rata', 10, 2)->nullable();
            $table->decimal('pst_perubahan_harga', 8, 4)->nullable(); // persentase
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekapitulasi_bulanan');
    }
};
