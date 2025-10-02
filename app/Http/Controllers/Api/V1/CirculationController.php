<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CirculationController extends Controller
{
    /**
     * Mengembalikan daftar data peminjaman contoh.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        // Data contoh (dummy)
        $peminjaman = [
            [
                'id' => 1,
                'nim' => '20011001',
                'nama_peminjam' => 'Budi Santoso',
                'judul_buku' => 'Dasar-Dasar Pemrograman Laravel',
                'tanggal_pinjam' => '2025-09-15',
                'tanggal_kembali' => '2025-09-22',
                'status' => 'Terlambat',
                'denda' => 10000,
            ],
            [
                'id' => 2,
                'nim' => '20011002',
                'nama_peminjam' => 'Ani Wijaya',
                'judul_buku' => 'Fisika Kuantum untuk Pemula',
                'tanggal_pinjam' => '2025-09-20',
                'tanggal_kembali' => '2025-09-27',
                'status' => 'Dipinjam',
                'denda' => 0,
            ],
            [
                'id' => 3,
                'nim' => '20011003',
                'nama_peminjam' => 'Citra Lestari',
                'judul_buku' => 'Sejarah Nusantara Modern',
                'tanggal_pinjam' => '2025-08-10',
                'tanggal_kembali' => '2025-08-17',
                'status' => 'Terlambat',
                'denda' => 45000,
            ],
        ];

        // Mengembalikan data sebagai respons JSON
        return response()->json([
            'status' => 'success',
            'message' => 'Data peminjaman berhasil diambil.',
            'data' => $peminjaman,
        ]);
    }
}