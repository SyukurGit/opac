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
            [
                'nim' => '21011001',
                'nama_peminjam' => 'Ahmadsss Subarjo',
                'judul_buku' => 'Kalkulus Jilid 1',
                'item_book' => 'KAL001-2021',
                'delay' => '+10 days',
                'denda' => 3000,
            ],
           
          
          






            
        ];

        // Masukkan data ke dalam tabel
        foreach ($data as $item) {
            Peminjaman::create($item);
        }
    }
}