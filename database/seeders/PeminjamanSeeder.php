<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Peminjaman;

class PeminjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kosongkan tabel terlebih dahulu untuk menghindari data duplikat
        Peminjaman::truncate();

        $data = [
            [
                'nim' => '21011001',
                'nama_peminjam' => 'Ahmad Subarjo',
                'judul_buku' => 'Kalkulus Jilid 1',
                'item_book' => 'KAL001-2021',
                'delay' => '+10 days',
                'denda' => 10000,
            ],
            [
                'nim' => '21011002',
                'nama_peminjam' => 'Siti Nurbaya',
                'judul_buku' => 'Fisika Dasar untuk Universitas',
                'item_book' => 'FIS003-2022',
                'delay' => '+5 days',
                'denda' => 5000,
            ],
            [
                'nim' => '21011001',
                'nama_peminjam' => 'Ahmad Subarjo',
                'judul_buku' => 'Algoritma dan Struktur Data',
                'item_book' => 'ALGO01-2021',
                'delay' => '+12 days',
                'denda' => 12000,
            ],
            [
                'nim' => '22022005',
                'nama_peminjam' => 'Bambang Pamungkas',
                'judul_buku' => 'Pengantar Ekonomi Mikro',
                'item_book' => 'EKO007-2023',
                'delay' => '+2 days',
                'denda' => 2000,
            ],
            [
                'nim' => '22022005',
                'nama_peminjam' => 'Bambang Pamungkas',
                'judul_buku' => 'Manajemen Pemasaran Global',
                'item_book' => 'MAN002-2022',
                'delay' => '+20 days',
                'denda' => 20000,
            ],
        ];

        // Masukkan data ke dalam tabel
        foreach ($data as $item) {
            Peminjaman::create($item);
        }
    }
}