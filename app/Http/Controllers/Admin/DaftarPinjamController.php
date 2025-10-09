<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LaporanPembayaran;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

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

        return view('admin.daftar-pinjam', compact('peminjaman'));
    }

    public function show(Peminjaman $peminjaman): View
    {
        return view('admin.daftar-pinjam-detail', compact('peminjaman'));
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
            return redirect()->route('admin.denda.index')
                ->with('error', 'Silakan pilih item denda terlebih dahulu.');
        }

        $items = Peminjaman::whereIn('id', $peminjamanIds)->get();

        if ($items->isEmpty()) {
             return redirect()->route('admin.denda.index')
                ->with('error', 'Item yang dipilih tidak ditemukan atau sudah diproses.');
        }

        $peminjam = [
            'nim'  => $items->first()->nim,
            'nama' => $items->first()->nama_peminjam,
        ];
        
        $totalDenda = $items->sum('denda');

        return view('admin.checkout-detail', compact('items', 'peminjam', 'totalDenda'));
    }

    /**
     * Memproses pembayaran akhir dari halaman detail (POST).
     */
    public function processCheckout(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'peminjaman_ids'   => 'required|array|min:1',
            'peminjaman_ids.*' => 'exists:peminjaman,id',
            'jumlah_dibayar'   => 'required|numeric|min:0',
            'payment_method'   => 'required|string',
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
                    'nomor_panggil'     => $peminjaman->nomor_panggil,
                    'tanggal_pinjam'    => $peminjaman->tanggal_pinjam,
                    'tanggal_kembali'   => $peminjaman->tanggal_kembali,
                    'delay'             => $peminjaman->delay,
                    'denda'             => $peminjaman->denda,
                    'denda_dibayar'     => $validated['jumlah_dibayar'],
                    'tanggal_bayar'     => now(),
                    'metode_pembayaran' => $validated['payment_method'],
                    'status'            => 'Lunas',
                ]);
                
                $peminjaman->delete();
            }

            DB::commit();

            session()->forget('peminjaman_ids_for_checkout');

            return redirect()->route('admin.laporan.index')
                ->with('success', 'Pembayaran berhasil diproses!');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Terjadi kesalahan saat memproses pembayaran.');
        }
    }
}