@extends('layouts.admin')

@section('content')
<main class="grow">
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="sm:flex sm:justify-between sm:items-center mb-8">
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Detail Peminjaman</h1>
            </div>
        </div>

        <div class="bg-white shadow-lg rounded-sm border border-slate-200">
            <div class="p-6">
                <div class="space-y-4">
                    <div>
                        <h2 class="font-semibold text-slate-800">Informasi Peminjam</h2>
                        <div class="mt-2 text-sm text-slate-600">
                            <p><span class="font-medium">NIM:</span> {{ $peminjaman['nim'] }}</p>
                            <p><span class="font-medium">Nama:</span> {{ $peminjaman['nama_peminjam'] }}</p>
                        </div>
                    </div>
                    <hr class="border-t border-slate-200">
                    <div>
                        <h2 class="font-semibold text-slate-800">Informasi Buku</h2>
                        <div class="mt-2 text-sm text-slate-600">
                            <p><span class="font-medium">Judul Buku:</span> {{ $peminjaman['judul_buku'] }}</p>
                        </div>
                    </div>
                    <hr class="border-t border-slate-200">
                    <div>
                        <h2 class="font-semibold text-slate-800">Informasi Peminjaman</h2>
                        <div class="mt-2 text-sm text-slate-600">
                            <p><span class="font-medium">Tanggal Pinjam:</span> {{ \Carbon\Carbon::parse($peminjaman['tanggal_pinjam'])->isoFormat('D MMMM YYYY') }}</p>
                            <p><span class="font-medium">Jatuh Tempo:</span> {{ \Carbon\Carbon::parse($peminjaman['tanggal_kembali'])->isoFormat('D MMMM YYYY') }}</p>
                            <p><span class="font-medium">Status:</span>
                                @if($peminjaman['status'] == 'Terlambat')
                                    <span class="font-bold text-red-600">{{ $peminjaman['status'] }}</span>
                                @else
                                    <span class="font-bold text-emerald-600">{{ $peminjaman['status'] }}</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <hr class="border-t border-slate-200">
                    <div>
                        <h2 class="font-semibold text-slate-800">Informasi Denda</h2>
                        <div class="mt-2 text-sm text-slate-600">
                            <p><span class="font-medium">Total Denda:</span> <span class="font-bold text-lg text-red-600">Rp. {{ number_format($peminjaman['denda'], 0, ',', '.') }}</span></p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <a href="{{ route('admin.daftar-pinjam') }}" class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                        <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16"><path d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z"></path></svg>
                        <span class="ml-2">Kembali ke Daftar</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection