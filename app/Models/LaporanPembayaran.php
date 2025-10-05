<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPembayaran extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terhubung dengan model ini.
     *
     * @var string
     */
    protected $table = 'laporan_pembayaran';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'peminjaman_id',
        'nim',
        'nama_peminjam',
        'judul_buku',
        'item_book',
        'denda_dibayar',
        'tanggal_bayar',
        'metode_pembayaran',
        'path_bukti_bayar',
        'path_laporan_excel',
        'catatan',
    ];
}