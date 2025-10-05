<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// 1. Import CirculationController yang akan kita panggil
use App\Http\Controllers\Api\V1\CirculationController;

class DaftarPinjamController extends Controller
{
    public function index(Request $request) // Tambahkan Request $request
    {
        // 2. Buat instance baru dari API controller kita
        $circulationApi = new CirculationController();

        // 3. Panggil langsung method 'index' nya
        // Method 'index' di CirculationController mengembalikan JsonResponse,
        // jadi kita perlu mengambil datanya.
        $response = $circulationApi->index($request);

        // 4. Ambil konten dari JsonResponse dan decode menjadi array
        $peminjaman = json_decode($response->getContent(), true)['data'] ?? [];

        // 5. Kirim data yang sudah bersih ke view
        return view('admin.daftar-pinjam', compact('peminjaman'));
    }

    public function show(Request $request, string $id) // Tambahkan Request $request
    {
        $circulationApi = new CirculationController();
        $response = $circulationApi->show($id); // Panggil method show dari API

        // Ambil data dari JSON, default ke array kosong jika gagal
        $peminjaman = json_decode($response->getContent(), true)['data'] ?? [];

        // Jika data tidak ditemukan (kosong), tampilkan halaman 404
        if (empty($peminjaman)) {
            abort(404);
        }

        return view('admin.daftar-pinjam-detail', compact('peminjaman'));
    }



    public function showCheckoutForm(Request $request)
{
    // Validasi, pastikan 'selected_ids' ada dan berupa array
    $request->validate([
        'selected_ids' => 'required|array|min:1',
    ]);

    $selectedIds = $request->input('selected_ids');

    $circulationApi = new CirculationController();
    $items = [];
    $totalDenda = 0;

    foreach ($selectedIds as $id) {
        $response = $circulationApi->show($id);
        $itemData = json_decode($response->getContent(), true)['data'] ?? null;
        if ($itemData) {
            $items[] = $itemData;
            $totalDenda += $itemData['denda'];
        }
    }

    if (empty($items)) {
        return redirect()->route('admin.daftar-pinjam')->with('error', 'Item yang dipilih tidak ditemukan.');
    }

    return view('admin.checkout', compact('items', 'totalDenda'));
}
}