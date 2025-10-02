@extends('layouts.admin')

@section('header', 'Daftar Peminjaman')

@section('content')
<div class="bg-white rounded-lg border border-slate-200">
    <div class="px-5 py-4 border-b border-slate-200">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-2 text-sm">
                <span>Show</span>
                <select class="border border-slate-300 rounded-md shadow-sm focus:ring-2 focus:ring-slate-400 focus:border-slate-400 transition duration-150 ease-in-out py-1.5 px-2">
                    <option>10</option>
                    <option>25</option>
                    <option>50</option>
                </select>
                <span>entries</span>
            </div>

           <div class="mb-4">
    <form action="{{ route('admin.daftar-pinjam') }}" method="GET" class="relative">
        <label for="search" class="sr-only">Cari</label>
        <input id="search" name="search" class="form-input w-full pl-9" type="search" placeholder="Cari berdasarkan NIM atau Judul Buku..." value="{{ request('search') }}">
        <button class="absolute inset-0 right-auto" type="submit" aria-label="Cari">
            <svg class="w-4 h-4 shrink-0 fill-current text-slate-400 ml-3 mr-2" viewBox="0 0 16 16">
                <path d="M7 14c-3.86 0-7-3.14-7-7s3.14-7 7-7 7 3.14 7 7-3.14 7-7 7zM7 2C4.243 2 2 4.243 2 7s2.243 5 5 5 5-2.243 5-5-2.243-5-5-5z"></path>
                <path d="M15.707 14.293L13.314 11.9a8.019 8.019 0 01-1.414 1.414l2.393 2.393a.997.997 0 001.414 0 .999.999 0 000-1.414z"></path>
            </svg>
        </button>
    </form>
</div>


        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full table-auto">
            <thead class="text-xs font-semibold uppercase text-slate-500 bg-slate-50">
                <tr>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left flex items-center">ID <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path></svg></div></th>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left flex items-center">Member ID <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path></svg></div></th>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left flex items-center">Item Code <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path></svg></div></th>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left flex items-center">Due Date <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path></svg></div></th>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left flex items-center">Return Date <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path></svg></div></th>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left flex items-center">Delay <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path></svg></div></th>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left flex items-center">Amount <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path></svg></div></th>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-center">Action</div></th>
                </tr>
            </thead>




          <tbody class="text-sm divide-y divide-slate-100">
    @forelse ($peminjaman as $item)
    <tr class="hover:bg-slate-50">
        {{-- Menggunakan $loop->iteration untuk nomor urut --}}
        <td class="p-4 whitespace-nowrap"><div class="text-left text-slate-700">{{ $loop->iteration }}</div></td>
        <td class="p-4 whitespace-nowrap"><div class="text-left font-medium text-slate-800">{{ $item['nim'] }}</div></td>
        <td class="p-4 whitespace-nowrap"><div class="text-left text-slate-700">{{ $item['judul_buku'] }}</div></td>
        <td class="p-4 whitespace-nowrap"><div class="text-left text-slate-700">{{ $item['tanggal_pinjam'] }}</div></td>
        <td class="p-4 whitespace-nowrap"><div class="text-left text-slate-700">{{ $item['tanggal_kembali'] }}</div></td>
        <td class="p-4 whitespace-nowrap">
            {{-- Menampilkan denda jika lebih dari 0 --}}
            @if($item['denda'] > 0)
                <div class="text-left text-red-500 font-medium">Rp. {{ number_format($item['denda'], 0, ',', '.') }}</div>
            @else
                <div class="text-left text-slate-700">-</div>
            @endif
        </td>
        <td class="p-4 whitespace-nowrap">
            {{-- Kondisi untuk status badge --}}
            @if($item['status'] == 'Terlambat')
                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-red-50 text-red-700 border border-red-200">{{ $item['status'] }}</span>
            @else
                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">{{ $item['status'] }}</span>
            @endif
        </td>
        <td class="p-4 whitespace-nowrap text-center">
            <a href="{{ route('admin.daftar-pinjam-detail', ['id' => $item['id']]) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold py-1.5 px-3 rounded-md transition duration-150 ease-in-out">
                Detail
            </a>
        </td>
    </tr>
    @empty
    {{-- Pesan jika tidak ada data --}}
    <tr>
        <td colspan="8" class="p-4 text-center text-slate-500">
            Tidak ada data peminjaman untuk ditampilkan.
        </td>
    </tr>
    @endforelse
</tbody>





        </table>
    </div>

    <div class="px-5 py-4 border-t border-slate-200">
        <div class="flex items-center justify-between text-sm">
            <div class="text-slate-500">
                Showing <span class="font-medium text-slate-600">1</span> to <span class="font-medium text-slate-600">8</span> of <span class="font-medium text-slate-600">8</span> entries
            </div>
            <div class="flex space-x-1">
                <button class="px-3 py-1 border border-slate-200 rounded-md bg-white text-slate-500 hover:bg-slate-50 text-xs">&laquo; Previous</button>
                <button class="px-3 py-1 border border-slate-200 rounded-md bg-white text-slate-500 hover:bg-slate-50 text-xs">Next &raquo;</button>
            </div>
        </div>
    </div>
</div>
@endsection