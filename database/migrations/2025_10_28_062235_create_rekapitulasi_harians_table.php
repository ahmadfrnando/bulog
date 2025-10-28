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
        Schema::create('rekapitulasi_harian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('komoditas_id');
            $table->string('nama_komoditas');
            $table->date('tanggal');
            $table->decimal('harga_rata_rata', 10, 2)->nullable();
            $table->decimal('harga_median', 10, 2)->nullable();
            $table->decimal('harga_minimal', 10, 2)->nullable();
            $table->decimal('harga_maksimal', 10, 2)->nullable();
            $table->integer('jumlah_submisi')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekapitulasi_harian');
    }
};
