<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPembayaran extends Model
{
    use HasFactory;

    protected $table = 'laporan_pembayaran';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'peminjaman_id',
        'nim',
        'nama_peminjam',
        'judul_buku',
        'item_book',
        'denda_asli',
        'denda_dibayar',
        'tanggal_bayar',
        'metode_pembayaran',
        'path_bukti_bayar',
        'path_laporan_excel',
        'catatan',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_bayar' => 'datetime', // <-- TAMBAHKAN BARIS INI
    ];
}