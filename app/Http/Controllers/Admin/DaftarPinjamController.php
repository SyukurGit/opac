<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\View\View; // <-- PERBAIKAN 1: Tambahkan ini untuk View

class DaftarPinjamController extends Controller
{
    /**
     * Menampilkan daftar data peminjaman dengan paginasi.
     */
    public function index(Request $request)
    {
        $query = Peminjaman::query();

        if ($request->has('search') && $request->input('search') != '') {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nim', 'like', '%' . $search . '%')
                  ->orWhere('nama_peminjam', 'like', '%' . $search . '%')
                  ->orWhere('judul_buku', 'like', '%' . $search . '%');
            });
        }

        // PERBAIKAN 2: Ganti .get() menjadi .paginate()
        // Ini akan membuat data terbagi per halaman (misal: 10 item per halaman)
        $peminjaman = $query->latest()->paginate(10); 

        return view('admin.daftar-pinjam', compact('peminjaman'));
    }

    /**
     * Menampilkan detail peminjaman.
     */
    public function show($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        return view('admin.daftar-pinjam-detail', compact('peminjaman'));
    }

    /**
     * Menampilkan halaman detail checkout.
     */
    public function showCheckout(Request $request): View
    {
        // 1. Validasi input dari form
        $validated = $request->validate([
            'peminjaman_ids'   => 'required|array|min:1',
            'peminjaman_ids.*' => 'exists:peminjaman,id',
        ], [
            'peminjaman_ids.required' => 'Anda harus memilih setidaknya satu item untuk checkout.',
        ]);

        // 2. Ambil semua data peminjaman
        $items = Peminjaman::whereIn('id', $validated['peminjaman_ids'])->get();

        // 3. Jika data tidak ditemukan
        if ($items->isEmpty()) {
            return view(view: 'admin.checkout-detail')->with('error', 'Item yang dipilih tidak ditemukan.');
        }

        // 4. Ambil informasi peminjam
        $peminjam = [
            'nim'  => $items->first()->nim,
            'nama' => $items->first()->nama_peminjam,
        ];
        
        // 5. Hitung total denda
        $totalDenda = $items->sum('denda');

        // 6. Kirim semua data ke view baru
        return view('admin.checkout-detail', [
            'items'      => $items,
            'peminjam'   => $peminjam,
            'totalDenda' => $totalDenda,
        ]);
    }
} // <-- PERBAIKAN 3: Pastikan hanya ada satu kurung kurawal penutup untuk class