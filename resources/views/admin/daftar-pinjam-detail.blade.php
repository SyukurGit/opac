@extends('layouts.admin')

@section('header', 'Detail Denda')

@section('content')
<div class="bg-white rounded-lg border border-slate-200 p-6">
    <div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold text-slate-800">Detail Peminjaman Terlambat</h2>
    <a href="{{ route('admin.daftar-pinjam') }}"
       class="inline-flex items-center px-4 py-2 rounded-lg bg-blue-600 text-white font-medium shadow-sm
              hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1
              transition-all duration-200">
        <!-- Ikon panah kembali -->
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali ke Daftar Denda
    </a>
</div>


    {{-- Data sekarang diambil dari variabel $peminjaman yang dikirim Controller --}}
    <div class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Kolom Kiri --}}
            <div class="space-y-3">
                <div class="flex justify-between items-center border-b pb-2">
                    <span class="text-slate-500 font-medium">NIM</span>
                    {{-- PERBAIKAN: Menggunakan sintaks objek -> --}}
                    <span class="text-slate-800 font-bold text-lg">{{ $peminjaman->nim }}</span>
                </div>
                <div class="flex justify-between items-center border-b pb-2">
                    <span class="text-slate-500 font-medium">Nama Peminjam</span>
                    <span class="text-slate-800">{{ $peminjaman->nama_peminjam }}</span>
                </div>
                <div class="flex justify-between items-center border-b pb-2">
                    <span class="text-slate-500 font-medium">Status</span>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-sm font-medium bg-red-100 text-red-800 border border-red-200">{{ $peminjaman->status }}</span>
                </div>
            </div>

            {{-- Kolom Kanan --}}
            <div class="space-y-3">
                <div class="flex justify-between items-center border-b pb-2">
                    <span class="text-slate-500 font-medium">Tanggal Tercatat</span>
                     {{-- Kita gunakan created_at karena ini yang ada di database --}}
                    <span class="text-slate-800">{{ $peminjaman->created_at->format('d F Y') }}</span>
                </div>
                 <div class="flex justify-between items-center border-b pb-2">
                    <span class="text-slate-500 font-medium">Keterlambatan</span>
                    <span class="text-slate-800 font-semibold">{{ $peminjaman->delay }}</span>
                </div>
            </div>
        </div>

        <div class="border-t pt-4 mt-4">
             <h3 class="text-xl font-bold text-slate-800 mb-4">Detail Buku</h3>
             <div class="space-y-3">
                <div class="flex justify-between items-center border-b pb-2">
                    <span class="text-slate-500 font-medium">Judul Buku</span>
                    <span class="text-slate-800 text-right">{{ $peminjaman->judul_buku }}</span>
                </div>
                <div class="flex justify-between items-center border-b pb-2">
                    <span class="text-slate-500 font-medium">Kode Item Buku</span>
                    <span class="text-slate-800 font-mono">{{ $peminjaman->item_book }}</span>
                </div>
             </div>
        </div>

        <div class="border-t pt-6 mt-6 text-center">
            <p class="text-slate-600 text-lg">Denda yang Harus Dibayar:</p>
            <p class="text-4xl font-extrabold text-red-600 my-2">
                Rp {{ number_format($peminjaman->denda, 0, ',', '.') }}
            </p>
            <div class="mt-6">
                {{-- Tombol ini bisa dihubungkan ke API pembayaran untuk satu item nanti --}}
                {{-- <button class="w-full max-w-xs bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition duration-300 ease-in-out">
                    Proses Pembayaran
                </button> --}}
            </div>
        </div>
    </div>
</div>
@endsection