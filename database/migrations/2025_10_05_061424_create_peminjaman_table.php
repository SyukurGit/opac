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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->string('nim');
            $table->string('nama_peminjam');
            $table->string('judul_buku');
            $table->string('item_book')->unique(); // Kode item buku, kita buat unik
            $table->string('delay');
            $table->string('status')->default('Terlambat'); // Sesuai permintaan Anda
            $table->unsignedInteger('denda');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};