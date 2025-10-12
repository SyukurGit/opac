<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Peminjaman;

class PeminjamanSeeder extends Seeder
{
   
    public function run(): void
    {
        // Kosongkan tabel terlebih dahulu untuk menghindari data duplikat
        Peminjaman::truncate();

      $data = [
    // === 3 data dengan NIM sama (21011001) ===
    [
        'nim' => '21011001',
        'nama_peminjam' => 'Ahmad Subarjo',
        'judul_buku' => 'Kalkulus 1',
        'item_book' => 'KAL001-2021',
        'delay' => '+10 days',
        'denda' => 3000,
    ],
    [
        'nim' => '21011001',
        'nama_peminjam' => 'Ahmad Subarjo',
        'judul_buku' => 'Algoritma dan Struktur Data',
        'item_book' => 'ALGO002-2021',
        'delay' => '+7 days',
        'denda' => 5000,
    ],
    [
        'nim' => '21011001',
        'nama_peminjam' => 'Ahmad Subarjo',
        'judul_buku' => 'Pemrograman Web Dasar',
        'item_book' => 'WEB003-2022',
        'delay' => '+5 days',
        'denda' => 4000,
    ],

    // === 2 data dengan NIM sama (22022005) ===
    [
        'nim' => '22022005',
        'nama_peminjam' => 'Siti Nurbaya',
        'judul_buku' => 'Fisika Dasar untuk Universitas',
        'item_book' => 'FIS004-2022',
        'delay' => '+8 days',
        'denda' => 6000,
    ],
    [
        'nim' => '22022005',
        'nama_peminjam' => 'Siti Nurbaya',
        'judul_buku' => 'Kimia Organik Lanjut',
        'item_book' => 'KIM005-2020',
        'delay' => '+4 days',
        'denda' => 2500,
    ],

    // === 4 data dengan NIM unik lainnya ===
    [
        'nim' => '23033009',
        'nama_peminjam' => 'Budi Santoso',
        'judul_buku' => 'Bahasa Inggris untuk Akademik',
        'item_book' => 'ENG006-2023',
        'delay' => '+6 days',
        'denda' => 3500,
    ],
    [
        'nim' => '21044012',
        'nama_peminjam' => 'Rina Marlina',
        'judul_buku' => 'Sosiologi Pendidikan',
        'item_book' => 'SOS007-2021',
        'delay' => '+9 days',
        'denda' => 4200,
    ],
    [
        'nim' => '20055008',
        'nama_peminjam' => 'Dedi Gunawan',
        'judul_buku' => 'Metodologi Penelitian',
        'item_book' => 'MET008-2020',
        'delay' => '+11 days',
        'denda' => 7000,
    ],
    [
        'nim' => '24066010',
        'nama_peminjam' => 'Intan Maulida',
        'judul_buku' => 'Psikologi Umum',
        'item_book' => 'PSI009-2023',
        'delay' => '+3 days',
        'denda' => 2000,
    ],
];


        // Masukkan data ke dalam tabel
        foreach ($data as $item) {
            Peminjaman::create($item);
        }
    }
}