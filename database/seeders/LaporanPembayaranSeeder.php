<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LaporanPembayaran;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LaporanPembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mengosongkan tabel sebelum diisi
        DB::table('laporan_pembayaran')->truncate();

        // Membuat 10 data laporan pembayaran dummy
        for ($i = 1; $i <= 10; $i++) {
            LaporanPembayaran::create([
                'peminjaman_id' => $i,
                'nim' => '2101100' . $i,
                'nama_peminjam' => 'Mahasiswa Contoh ' . $i,
                'judul_buku' => 'Buku Laravel Vol. ' . $i,
                'item_book' => 'BK' . str_pad($i, 5, '0', STR_PAD_LEFT),
                'denda_dibayar' => rand(5000, 25000),
                'tanggal_bayar' => now()->subDays(rand(1, 30)),
                'metode_pembayaran' => ['Tunai', 'QRIS', 'Transfer Bank'][array_rand(['Tunai', 'QRIS', 'Transfer Bank'])],
                'path_bukti_bayar' => null,
                'path_laporan_excel' => null,
                'catatan' => 'Pembayaran denda untuk buku ID ' . $i,
            ]);
        }
    }
}