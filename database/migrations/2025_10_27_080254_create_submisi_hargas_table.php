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
        Schema::create('submisi_harga', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('nama_petugas');
            $table->unsignedBigInteger('pasar_id');
            $table->string('nama_pasar');
            $table->string('nama_toko');
            $table->unsignedBigInteger('komoditas_id');
            $table->string('nama_komoditas');
            $table->decimal('harga', 10, 2);
            $table->string('unit')->nullable();
            $table->date('tanggal_observasi');
            $table->text('url_foto')->nullable();
            $table->text('catatan')->nullable();
            $table->enum('status', ['dikirim', 'diterbitkan', 'ditandai', 'ditolak', 'dikoreksi'])->default('dikirim');
            $table->date('tanggal_validasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submisi_harga');
    }
};
