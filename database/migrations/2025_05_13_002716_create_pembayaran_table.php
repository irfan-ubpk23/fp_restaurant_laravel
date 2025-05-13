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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('metode_pembayaran_id');

            $table->integer('total_harga');
            $table->string('kode_transaksi');
            $table->enum('status_pembayaran', ['belum', 'selesai']);
            $table->text('bukti_pembayaran');
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('order');
            $table->foreign('metode_pembayaran_id')->references('id')->on('metode_pembayaran');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
