<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LaporanPembayaran;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Controllers\Admin\log;


class DaftarPinjamController extends Controller
{
    public function index(Request $request): View
    {
        $query = Peminjaman::query();
        $search = $request->input('search');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nim', 'like', "%{$search}%")
                  ->orWhere('nama_peminjam', 'like', "%{$search}%")
                  ->orWhere('judul_buku', 'like', "%{$search}%");
            });
        }

        $peminjaman = $query->latest()->paginate(10);

        

        return view('admin.daftar_denda.index', compact('peminjaman'));
    }

    public function show(Peminjaman $peminjaman): View
    {
        return view('admin.daftar_denda.detail', compact('peminjaman'));
    }

    /**
     * Menerima ID dari form daftar denda (POST),
     * menyimpannya ke session, lalu redirect.
     */
    public function selectForCheckout(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'peminjaman_ids'   => 'required|array|min:1',
            'peminjaman_ids.*' => 'exists:peminjaman,id',
        ], [
            'peminjaman_ids.required' => 'Anda harus memilih setidaknya satu item untuk dibayar.',
        ]);

        session(['peminjaman_ids_for_checkout' => $validated['peminjaman_ids']]);

        return redirect()->route('admin.checkout.detail');
    }

    /**
     * Menampilkan halaman detail pembayaran (GET), aman untuk di-refresh.
     */
    public function showCheckout(): View|RedirectResponse
    {
        $peminjamanIds = session('peminjaman_ids_for_checkout');

        if (empty($peminjamanIds)) {
            return redirect()->route('admin.laporan.index')
                ->with('error', 'Silakan pilih item denda terlebih dahulu.');
        }

        $items = Peminjaman::whereIn('id', $peminjamanIds)->get();

        if ($items->isEmpty()) {
             return redirect()->route('admin.laporan.index')
                ->with('error', 'Item yang dipilih tidak ditemukan atau sudah diproses.');
        }

        $peminjam = [
            'nim'  => $items->first()->nim,
            'nama' => $items->first()->nama_peminjam,
        ];
        
        $totalDenda = $items->sum('denda');

        return view('admin.daftar_denda.payment', compact('items', 'peminjam', 'totalDenda'));
    }

   
    public function processCheckout(Request $request): RedirectResponse
{
    // 1. Validasi disesuaikan dengan input tunggal
    $validated = $request->validate([
        'peminjaman_ids'   => 'required|array|min:1',
        'peminjaman_ids.*' => 'exists:peminjaman,id',
        'jumlah_dibayar'   => 'required|numeric|min:0', // Bukan lagi array
        'payment_method'   => 'required|string',       // Bukan lagi array
    ]);

    $peminjamans = Peminjaman::whereIn('id', $validated['peminjaman_ids'])->get();

    DB::beginTransaction();
    try {
        foreach ($peminjamans as $peminjaman) {
            LaporanPembayaran::create([
                'peminjaman_id'     => $peminjaman->id,
                'nim'               => $peminjaman->nim,
                'nama_peminjam'     => $peminjaman->nama_peminjam,
                'judul_buku'        => $peminjaman->judul_buku,
                'item_book'         => $peminjaman->item_book,
                'denda_asli'     => $peminjaman->denda, // Ambil langsung
                'denda_dibayar'     => $validated['jumlah_dibayar'], // Ambil langsung
                'tanggal_bayar'     => now(),
                'metode_pembayaran' => $validated['payment_method'], // Ambil langsung
                'catatan'           => 'Lunas', // Contoh catatan
            ]);
            
            $peminjaman->delete();
        }

        DB::commit();

        session()->forget('peminjaman_ids_for_checkout');

        // Redirect ke halaman laporan agar langsung terlihat hasilnya
        return redirect()->route('admin.laporan.index')
            ->with('success', 'Pembayaran berhasil diproses!');

    } catch (\Exception $e) {
        DB::rollBack();
        

        return back()->with('error', 'Terjadi kesalahan saat memproses pembayaran.');
    }
}
}