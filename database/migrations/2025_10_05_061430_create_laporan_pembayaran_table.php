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
        Schema::create('laporan_pembayaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('peminjaman_id'); // ID asli dari tabel peminjaman
            $table->string('nim');
            $table->string('nama_peminjam');
            $table->string('judul_buku');
            $table->string('item_book');
            $table->string('denda_asli');

            $table->unsignedInteger('denda_dibayar');
            $table->dateTime('tanggal_bayar');
            $table->string('metode_pembayaran');
            $table->string('path_bukti_bayar')->nullable();
            $table->string('path_laporan_excel')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_pembayaran');
    }
};