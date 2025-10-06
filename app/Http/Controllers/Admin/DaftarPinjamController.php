<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman; // <-- IMPORT MODEL PEMINJAMAN
use Illuminate\Http\Request;

class DaftarPinjamController extends Controller
{
    /**
     * Menampilkan daftar data peminjaman yang diambil langsung dari database.
     */
    public function index(Request $request)
    {
        // Mulai query builder langsung dari model
        $query = Peminjaman::query();

        // Terapkan filter pencarian jika ada
        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nim', 'like', '%' . $search . '%')
                  ->orWhere('nama_peminjam', 'like', '%' . $search . '%')
                  ->orWhere('judul_buku', 'like', '%' . $search . '%');
            });
        }

        // Ambil data terbaru dan kirim ke view
        $peminjaman = $query->latest()->get();

        return view('admin.daftar-pinjam', compact('peminjaman'));
    }

    /**
     * Menampilkan detail peminjaman.
     */
public function show($id)
    
    {
        // Ambil data detail juga langsung dari model
        $peminjaman = Peminjaman::findOrFail($id);

        return view('admin.daftar-pinjam-detail', compact('peminjaman'));
    }

    public function checkout(Request $request)
{
    // Ubah dari $request->query('items') menjadi $request->input('items')
    $itemIds = json_decode($request->input('items'), true);

    if (empty($itemIds)) {
        return redirect()->route('admin.daftar-pinjam')->with('error', 'Tidak ada item yang dipilih.');
    }

    $items = Peminjaman::whereIn('id', $itemIds)->get();

    // Pastikan semua item milik NIM yang sama
    $nim = $items->first()->nim ?? null;
    $namaPeminjam = $items->first()->nama_peminjam ?? null;

    $totalDenda = $items->sum('denda');

    return view('admin.checkout', compact('items', 'totalDenda', 'nim', 'namaPeminjam'));
}
}



