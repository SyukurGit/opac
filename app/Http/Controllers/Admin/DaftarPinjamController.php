<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Pastikan ini di-import

class DaftarPinjamController extends Controller
{
     public function index()
    {
        $peminjaman = []; // Inisialisasi sebagai array kosong

        try {
            $response = Http::get(url('/api/v1/peminjaman'));

            // Cek jika request berhasil (status code 2xx)
            if ($response->successful()) {
                // Ambil nilai dari key 'data', jika tidak ada, default ke array kosong
                $peminjaman = $response->json('data', []);
            }
        } catch (\Exception $e) {
            // Biarkan $peminjaman kosong jika koneksi ke API gagal
        }

        return view('admin.daftar-pinjam', compact('peminjaman'));
    }

    public function show(string $id)
    {
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

        return view('admin.daftar-pinjam-detail', compact('peminjaman'));
    }
}