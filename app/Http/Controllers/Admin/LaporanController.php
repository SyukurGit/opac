<?php
// app/Http/Controllers/Admin/LaporanController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LaporanController extends Controller
{
    /**
     * Menampilkan halaman laporan pembayaran.
     */
    public function index(Request $request): View
    {
        // Untuk saat ini, kita hanya menampilkan view-nya saja.
        // Logika untuk mengambil dan memfilter data akan kita tambahkan nanti.
        
        // Buat array kosong agar tidak error di view
        $laporan = []; 

        return view('admin.laporan.index', compact('laporan'));
    }
}