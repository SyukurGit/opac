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
        // 1. Validasi input: pastikan 'items' ada dan tidak kosong.
        $request->validate([
            'items' => 'required|string',
        ]);

        // 2. Ambil string ID dari query parameter dan ubah menjadi array.
        $itemIds = explode(',', $request->query('items'));

        // 3. Ambil data lengkap peminjaman dari database berdasarkan ID yang dipilih.
        // Kita juga pastikan hanya mengambil data yang ID-nya valid.
        $peminjamanItems = Peminjaman::whereIn('id', $itemIds)->get();

        // 4. Jika karena suatu alasan tidak ada item yang ditemukan, kembali dengan error.
        if ($peminjamanItems->isEmpty()) {
            return redirect()->route('admin.daftar-pinjam')->with('error', 'Item yang dipilih tidak valid.');
        }

        // 5. Hitung total denda dari item yang ditemukan.
        $totalDenda = $peminjamanItems->sum('denda');

        // 6. Kirim data item dan total denda ke view checkout.
        return view('admin.checkout', [
            'items' => $peminjamanItems,
            'totalDenda' => $totalDenda,
        ]);
    }
}



