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
                            <p><span class="font-medium">Code buku:</span> {{$peminjaman['item_book']}}</p>
                            <p><span class="font-medium">Delay:</span> {{ ($peminjaman['Delay'])}}</p>
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
    <a href="{{ route('admin.daftar-pinjam') }}"
       class="inline-flex items-center px-4 py-2 rounded-lg bg-indigo-500 text-white text-sm font-medium shadow-sm hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition duration-200">
        <svg class="w-4 h-4 opacity-70" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-5-5a1 
                 1 0 010-1.414l5-5a1 1 0 111.414 
                 1.414L4.414 9H18a1 1 0 110 
                 2H4.414l3.293 3.293a1 1 0 010 
                 1.414z" clip-rule="evenodd"/>
        </svg>
        <span class="ml-2">Kembali ke Daftar</span>
    </a>
</div>

            </div>
        </div>
    </div>
</main>
@endsection