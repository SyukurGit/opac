<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\LaporanPembayaran;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class PembayaranController extends Controller
{
    /**
     * Memproses pembayaran denda dan memindahkan data.
     */
    public function processPayment(Request $request)
    {
        // 1. Validasi Input
        $validator = Validator::make($request->all(), [
            'peminjaman_ids' => 'required|array',
            'peminjaman_ids.*' => 'integer|exists:peminjaman,id',
            'metode_pembayaran' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $peminjamanIds = $request->input('peminjaman_ids');
        $metodePembayaran = $request->input('metode_pembayaran');

        // 2. Gunakan Database Transaction
        try {
            DB::beginTransaction();

            foreach ($peminjamanIds as $id) {
                // Cari data peminjaman yang akan diproses
                $peminjaman = Peminjaman::findOrFail($id);

                // Buat entri baru di tabel laporan_pembayaran
                LaporanPembayaran::create([
                    'peminjaman_id' => $peminjaman->id,
                    'nim' => $peminjaman->nim,
                    'nama_peminjam' => $peminjaman->nama_peminjam,
                    'judul_buku' => $peminjaman->judul_buku,
                    'item_book' => $peminjaman->item_book,
                    'denda_asli' => $peminjaman->denda,

                    'denda_dibayar' => $peminjaman->denda,
                    'tanggal_bayar' => Carbon::now(),
                    'metode_pembayaran' => $metodePembayaran,
                ]);

                // Hapus entri dari tabel peminjaman
                $peminjaman->delete();
            }

            // Jika semua berhasil, commit transaksinya
            DB::commit();

            return response()->json([
                'message' => 'Pembayaran berhasil diproses.'
            ], 200);

        } catch (\Exception $e) {
            // Jika ada error, batalkan semua perubahan (rollback)
            DB::rollBack();

            return response()->json([
                'message' => 'Terjadi kesalahan saat memproses pembayaran.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}