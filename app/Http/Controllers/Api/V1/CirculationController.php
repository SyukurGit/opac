<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman; // <-- IMPORT MODEL PEMINJAMAN
use Illuminate\Http\Request;

class CirculationController extends Controller
{
    /**
     * Menampilkan daftar data peminjaman yang terlambat.
     */
    public function index(Request $request)
    {
        $query = Peminjaman::query();

        // Cek jika ada parameter pencarian 'search'
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nim', 'like', '%' . $search . '%')
                  ->orWhere('judul_buku', 'like', '%' . $search . '%')
                  ->orWhere('nama_peminjam', 'like', '%' . $search . '%');
            });
        }

        $peminjaman = $query->latest()->get(); // Ambil data terbaru

        return response()->json($peminjaman);
    }


    /**
     * Menampilkan detail satu data peminjaman.
     */
    public function show(string $id)
    {
        // Cari data berdasarkan ID, jika tidak ketemu akan otomatis error 404
        $peminjaman = Peminjaman::findOrFail($id);

        return response()->json($peminjaman);
    }

    // Metode getPeminjamanData() dan yang lainnya (store, update, destroy) kita hapus
    // karena sudah tidak relevan atau tidak digunakan.
}