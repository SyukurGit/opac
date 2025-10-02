<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr; // Import class Arr

class CirculationController extends Controller
{
    /**
     * Kumpulan data peminjaman contoh.
     * @return array
     */
    private function getPeminjamanData(): array
    {
        return [
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
                'judul_buku' => 'Sejarah Nusantara Modern1',
                'tanggal_pinjam' => '2025-08-10',
                'tanggal_kembali' => '2025-08-17',
                'status' => 'Terlambat',
                'denda' => 45000,
            ],

            [
                'id' => 4,
                'nim' => '20011003',
                'nama_peminjam' => 'Citra Lestari',
                'judul_buku' => 'Sejarah Nusantara Modern2',
                'tanggal_pinjam' => '2025-08-10',
                'tanggal_kembali' => '2025-08-17',
                'status' => 'Terlambat',
                'denda' => 45000,
            ],
            [
                'id' => 5,
                'nim' => '20011003',
                'nama_peminjam' => 'Citra Lestari',
                'judul_buku' => 'Sejarah Nusantara Modern3',
                'tanggal_pinjam' => '2025-08-10',
                'tanggal_kembali' => '2025-08-17',
                'status' => 'Terlambat',
                'denda' => 45000,
            ],
            [
                'id' => 6,
                'nim' => '20011003',
                'nama_peminjam' => 'Citra Lestari',
                'judul_buku' => 'Sejarah Nusantara Modern4',
                'tanggal_pinjam' => '2025-08-10',
                'tanggal_kembali' => '2025-08-17',
                'status' => 'Terlambat',
                'denda' => 45000,
            ],
            [
                'id' => 7,
                'nim' => '20011003',
                'nama_peminjam' => 'Citra Lestari',
                'judul_buku' => 'Sejarah Nusantara Modern5',
                'tanggal_pinjam' => '2025-08-10',
                'tanggal_kembali' => '2025-08-17',
                'status' => 'Terlambat',
                'denda' => 45000,
            ],
            [
                'id' => 8,
                'nim' => '20011003',
                'nama_peminjam' => 'Citra Lestari',
                'judul_buku' => 'Sejarah Nusantara Modern6',
                'tanggal_pinjam' => '2025-08-10',
                'tanggal_kembali' => '2025-08-17',
                'status' => 'Terlambat',
                'denda' => 45000,
            ],
            [
                'id' => 9,
                'nim' => '20011003',
                'nama_peminjam' => 'Citra Lestari',
                'judul_buku' => 'Sejarah Nusantara Modern7',
                'tanggal_pinjam' => '2025-08-10',
                'tanggal_kembali' => '2025-08-17',
                'status' => 'Terlambat',
                'denda' => 45000,
            ],
            [
                'id' => 10,
                'nim' => '22011003',
                'nama_peminjam' => 'andika',
                'judul_buku' => 'Berita 2025',
                'tanggal_pinjam' => '2025-08-10',
                'tanggal_kembali' => '2025-08-17',
                'status' => 'Terlambat',
                'denda' => 45000,
            ],
            [
                'id' => 11,
                'nim' => '22011003',
                'nama_peminjam' => 'andika',
                'judul_buku' => 'Sejarah 1990',
                'tanggal_pinjam' => '2025-08-10',
                'tanggal_kembali' => '2025-08-17',
                'status' => 'Terlambat',
                'denda' => 45000,
            ],







        ];
    }

   public function index(Request $request): JsonResponse
    {
        // Ambil semua data peminjaman
        $peminjaman = $this->getPeminjamanData();

        // Cek apakah ada parameter 'search' di request
        if ($request->has('search')) {
            $searchKeyword = strtolower($request->input('search')); // ambil kata kunci & ubah ke huruf kecil

            $peminjaman = array_filter($peminjaman, function ($item) use ($searchKeyword) {
                // Cek apakah kata kunci ada di dalam nim atau judul buku (case-insensitive)
                $nimMatch = str_contains(strtolower($item['nim']), $searchKeyword);
                $judulMatch = str_contains(strtolower($item['judul_buku']), $searchKeyword);

                return $nimMatch || $judulMatch;
            });
        }

        return response()->json(['data' => array_values($peminjaman)]); // array_values untuk mereset index array
    }
    /**
     * Mengembalikan detail satu data peminjaman.
     *
     * @param string $id
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $peminjaman = $this->getPeminjamanData();

        // Cari item yang id-nya cocok. firstWhere adalah helper Laravel yang sangat berguna.
        $item = Arr::first($peminjaman, fn ($value) => $value['id'] == $id);

        if ($item) {
            // Jika item ditemukan, kembalikan datanya
            return response()->json(['data' => $item]);
        }

        // Jika tidak ditemukan, kembalikan error 404
        return response()->json(['message' => 'Data tidak ditemukan.'], 404);
    }
}