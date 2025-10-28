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
        Schema::create('submisi_harga_status', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('submisi_harga_id');
            $table->string('nama_status')->default('dikirim');
            $table->text('alasan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submisi_harga_status');
    }
};
