<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Pastikan Http facade di-import

class DaftarPinjamController extends Controller
{
    public function index(Request $request)
    {
        $queryParams = [];
        if ($request->has('search')) {
            $queryParams['search'] = $request->input('search');
        }

        $peminjaman = []; // Default ke array kosong

        try {
            // Gunakan config('app.url') agar lebih dinamis
            $response = Http::get(config('app.url') . '/api/v1/peminjaman', $queryParams);

            if ($response->successful()) {
                $peminjaman = $response->json(); // Langsung konversi ke array
            } else {
                // Jika API gagal, setidaknya halaman tidak akan error
                // Anda bisa menambahkan logging atau notifikasi di sini
                // Log::error('Gagal mengambil data dari API: ' . $response->body());
            }
        } catch (\Exception $e) {
            // Jika ada masalah koneksi ke API
            // Log::error('Tidak dapat terhubung ke API: ' . $e->getMessage());
        }


        return view('admin.daftar-pinjam', compact('peminjaman'));
    }

    // Metode detail dan checkout tidak perlu kita ubah
    public function detail($id)
    {
        // Logika ini juga bisa mengambil dari API
        return view('admin.daftar-pinjam-detail', ['id' => $id]);
    }

    public function checkout(Request $request)
    {
        // Halaman ini mungkin tidak akan terpakai lagi,
        // tapi kita biarkan saja untuk saat ini.
        $items = $request->query('items', []);
        return view('admin.checkout', ['items' => $items]);
    }
}