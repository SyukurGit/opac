<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CirculationController extends Controller
{
    private function getPeminjamanData(): array
    {
        // Data contoh dengan beberapa NIM yang sama dan status 'Terlambat'
       return [
    [
        'id' => 1, 'nim' => '20011001', 'nama_peminjam' => 'Jawi',
        'judul_buku' => 'Dasar-Dasar Pemrograman Laravel', 'item_book' => '0003975TXT12',
        'Delay' => '+1 days', 'status' => 'Terlambat', 'denda' => 14000,
    ],

    [
        'id' => 2, 'nim' => '20011021', 'nama_peminjam' => 'Budi Santoso',
        'judul_buku' => 'Dasar-Dasar Pemrograman Laravel', 'item_book' => '0005975TXT02',
        'Delay' => '+2 days', 'status' => 'Terlambat', 'denda' => 10000,
    ],

     [
        'id' => 3, 'nim' => '20011021', 'nama_peminjam' => 'Budi Santoso',
        'judul_buku' => 'Dasar-Dasar Pemrograman Laravel 2 ', 'item_book' => '0005975TXT02',
        'Delay' => '+4 days', 'status' => 'Terlambat', 'denda' => 30000,
    ],

   
  
];

    }

    public function index(Request $request): JsonResponse
    {
        $peminjaman = $this->getPeminjamanData();

        // 1. Filter HANYA yang statusnya 'Terlambat'
        $terlambat = array_filter($peminjaman, fn ($item) => $item['status'] === 'Terlambat');

        // 2. Terapkan pencarian jika ada
        if ($request->has('search')) {
            $searchKeyword = strtolower($request->input('search'));

            $terlambat = array_filter($terlambat, function ($item) use ($searchKeyword) {
                $nimMatch = str_contains(strtolower($item['nim']), $searchKeyword);
                $judulMatch = str_contains(strtolower($item['judul_buku']), $searchKeyword);
                return $nimMatch || $judulMatch;
            });
        }

        return response()->json(['data' => array_values($terlambat)]);
    }

    public function show(string $id): JsonResponse
    {
        $peminjaman = $this->getPeminjamanData();
        $item = Arr::first($peminjaman, fn ($value) => $value['id'] == $id);

        if ($item) {
            return response()->json(['data' => $item]);
        }

        return response()->json(['message' => 'Data tidak ditemukan.'], 404);
    }
}