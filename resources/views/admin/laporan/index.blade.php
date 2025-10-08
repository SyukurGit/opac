@extends('layouts.admin')

@section('header', 'Laporan Pembayaran Denda')

@section('content')

{{-- Filter & Pencarian --}}
<div class="bg-white rounded-lg border border-slate-200 p-5 mb-6">
    <form action="{{ route('admin.laporan.index') }}" method="GET">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            {{-- Pencarian Keyword --}}
            <div class="md:col-span-2">
                <label for="search" class="sr-only">Cari</label>
                <div class="relative">
                    <input id="search" name="search"
                        class="form-input w-full pl-9 pr-3 py-2 rounded-lg border-slate-300 focus:border-indigo-500"
                        type="search" placeholder="Cari NIM, Nama, Judul, atau ID Transaksi..." value="{{ request('search') }}">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-slate-400" viewBox="0 0 16 16" fill="currentColor">
                            <path d="M7 14c-3.86 0-7-3.14-7-7s3.14-7 7-7 7 3.14 7 7-3.14 7-7 7zM7 2C4.243 2 2 4.243 2 7s2.243 5 5 5 5-2.243 5-5-2.243-5-5-5z" />
                            <path d="M15.707 14.293L13.314 11.9a8.019 8.019 0 01-1.414 1.414l2.393 2.393a.997.997 0 001.414 0 .999.999 0 000-1.414z" />
                        </svg>
                    </div>
                </div>
            </div>
            
            {{-- Filter Tanggal Mulai --}}
            
        
    </form>
</div>

{{-- Tabel Laporan --}}
<div class="bg-white rounded-lg border border-slate-200">
    <div class="overflow-x-auto">
        <table class="w-full table-auto">
            <thead class="text-xs font-semibold uppercase text-slate-500 bg-slate-50">
                <tr>
                    {{-- Sesuai permintaan, semua kolom ditampilkan dulu --}}
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left">ID Laporan</div></th>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left">Status</div></th>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left">NIM</div></th>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left">Nama Peminjam</div></th>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left">Judul Buku</div></th>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-right">Total Denda</div></th>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-right">Jumlah Dibayar</div></th>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left">Metode Bayar</div></th>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left">ID Transaksi</div></th>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left">Tanggal Bayar</div></th>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-center">Struk</div></th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-slate-100">
                {{-- Saat ini data masih kosong, jadi kita tampilkan pesan --}}
                @forelse ($laporan as $item)
                    {{-- Logika untuk menampilkan data akan ditambahkan di sini nanti --}}
                @empty
                    <tr>
                        <td colspan="11" class="p-4 text-center text-slate-500">
                            Tidak ada data laporan untuk ditampilkan. Silakan gunakan filter di atas.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection