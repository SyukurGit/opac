<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DaftarPinjamController extends Controller
{
    /**
     * Menampilkan halaman daftar peminjaman.
     */
    public function index()
    {
        // Saat ini kita hanya menampilkan view.
        // Nanti, logika untuk mengambil data dari API akan ditambahkan di sini.
        return view('admin.daftar-pinjam');
    }



     public function show($id)
    {
        // Data statis sebagai contoh, nanti ini akan diambil dari API
        $peminjaman = [
            'id' => $id,
            'member_id' => '230503072',
            'member_name' => 'RISALUL YANTI',
            'item_code' => '0041016TXT03',
            'item_title' => 'Petunjuk Praktis Metode Penelitian Teknologi Informasi',
            'due_date' => '2025-09-26',
            'return_date' => '2025-09-29',
            'delay' => '+3 days',
            'billing' => 'Rp. 3,000',
            'cash' => '3,000',
        ];

        // Kirim data ke view
        return view('admin.daftar-pinjam', compact('peminjaman'));
    }

}