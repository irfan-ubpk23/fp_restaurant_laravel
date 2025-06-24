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
        Schema::create('reservasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('meja_id');
            $table->unsignedBigInteger('transaksi_id');

            $table->timestamp('tanggal_dan_jam', precision:0)->nullable();
            $table->enum('status_reservasi', ['menunggu', 'sudah', 'tidak_hadir'])->default('menunggu');

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('meja_id')->references('id')->on('meja');
            $table->foreign('transaksi_id')->references('id')->on('transaksi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasi');
    }
};
