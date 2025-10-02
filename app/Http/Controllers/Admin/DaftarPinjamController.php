<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // <-- Tambahkan ini


class DaftarPinjamController extends Controller
{
    public function index()
    {
        // Panggil API contoh yang sudah kita buat
        $response = Http::get(url('/api/v1/peminjaman'));

        // Ambil data dari respons JSON
        $peminjaman = $response->json('data');

        // Jika API gagal atau data tidak ditemukan, siapkan array kosong
        if ($response->failed() || !$peminjaman) {
            $peminjaman = [];
        }

        return view('admin.daftar-pinjam', compact('peminjaman'));
    }

    public function show(string $id)
    {
        // Logika untuk menampilkan detail (bisa dikembangkan nanti)
        return view('admin.daftar-pinjam-detail');
    }
}