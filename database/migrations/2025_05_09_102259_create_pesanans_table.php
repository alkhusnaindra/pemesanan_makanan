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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meja_id')->constrained('mejas')->onDelete('cascade');
            $table->enum('status', ['menunggu', 'diproses', 'dikirim', 'selesai'])->default('menunggu');
            $table->integer('total_harga')->default(0);
            $table->text('catatan')->nullable();

            $table->string('bukti_pembayaran')->nullable();
            $table->enum('status_pembayaran', ['belum', 'menunggu_verifikasi', 'dibayar'])->default('belum');
            $table->string('order_id')->nullable(); 
            $table->string('snap_token')->nullable(); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
