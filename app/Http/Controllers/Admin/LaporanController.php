<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LaporanPembayaran;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LaporanController extends Controller
{
    public function index(Request $request): View
    {
        $laporanQuery = LaporanPembayaran::latest('tanggal_bayar');

        // Fitur Pencarian (Opsional tapi berguna)
        if ($search = $request->input('search')) {
            $laporanQuery->where(function ($query) use ($search) {
                $query->where('nim', 'like', "%{$search}%")
                    ->orWhere('nama_peminjam', 'like', "%{$search}%")
                    ->orWhere('item_book', 'like', "%{$search}%");
            });
        }
        
        $semuaLaporan = $laporanQuery->get();

        // LOGIKA INTI: Mengelompokkan berdasarkan transaksi
        // Kunci grup adalah NIM + Tanggal Bayar (diformat hingga detik)
        $laporanTergabung = $semuaLaporan->groupBy(function ($item) {
            return $item->nim . '_' . $item->tanggal_bayar->toDateTimeString();
        });

        // Kirim data yang sudah digabungkan ke view
        return view('admin.laporan.index', compact('laporanTergabung'));
    }
}