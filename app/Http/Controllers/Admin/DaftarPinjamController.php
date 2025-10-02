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

        // Coba panggil API
        try {
            // Gunakan url() untuk memastikan URL yang dipanggil benar
            $response = Http::get(url('/api/v1/peminjaman'));

            // Cek jika request berhasil dan ambil data dari JSON
            if ($response->successful()) {
                // Ambil data dari key 'data' di dalam JSON
                $peminjaman = $response->json('data');
            }
        } catch (\Exception $e) {
            // Jika terjadi error saat koneksi ke API, catat error (opsional)
            // dan biarkan $peminjaman tetap kosong agar halaman tidak error.
            // Log::error('Gagal mengambil data dari API: ' . $e->getMessage());
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