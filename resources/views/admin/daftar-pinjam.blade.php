@extends('layouts.admin')

@section('header', 'Daftar Peminjaman')

@section('content')

{{-- 1. Inisialisasi Alpine.js di elemen pembungkus utama --}}
<div 
    class="bg-white rounded-lg border border-slate-200"
    x-data="{
        selectedIds: [],
        selectedNim: null,
        // Logika checkbox yang sudah diperbaiki
        toggleCheckbox(event, id, nim) {
            const checkbox = event.target;
            
            // Cek kondisi HANYA saat mencoba mencentang (bukan saat uncheck)
            if (checkbox.checked) {
                if (this.selectedNim !== null && this.selectedNim !== nim) {
                    // Jika NIM berbeda, batalkan aksi centang dan tampilkan alert
                    event.preventDefault();
                    alert('Hanya bisa memilih item dengan NIM yang sama.');
                    return;
                }
            }

            // Jika valid, lanjutkan update state
            if (checkbox.checked) {
                this.selectedIds.push(id);
                this.selectedNim = nim;
            } else {
                this.selectedIds = this.selectedIds.filter(i => i !== id);
                if (this.selectedIds.length === 0) {
                    this.selectedNim = null;
                }
            }
        }
    }"
>
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

            {{-- 2. Grupkan Tombol Cari dan Checkout --}}
            <div class="flex items-center space-x-4">
                {{-- Form Pencarian (tidak berubah) --}}
                <div>
                    <form action="{{ route('admin.daftar-pinjam') }}" method="GET" class="relative">
                        <label for="search" class="sr-only">Cari</label>
                        <input id="search" name="search" class="form-input w-full pl-9 pr-3 py-2 rounded-lg border border-slate-300 bg-slate-50 text-slate-9" type="search" placeholder="Cari berdasarkan NIM..." value="{{ request('search') }}">
                        <button class="absolute inset-0 right-auto" type="submit" aria-label="Cari">
                            <svg class="w-4 h-4 shrink-0 fill-current text-slate-400 ml-3 mr-2" viewBox="0 0 16 16"><path d="M7 14c-3.86 0-7-3.14-7-7s3.14-7 7-7 7 3.14 7 7-3.14 7-7 7zM7 2C4.243 2 2 4.243 2 7s2.243 5 5 5 5-2.243 5-5-2.243-5-5-5z"></path><path d="M15.707 14.293L13.314 11.9a8.019 8.019 0 01-1.414 1.414l2.393 2.393a.997.997 0 001.414 0 .999.999 0 000-1.414z"></path></svg>
                        </button>
                    </form>
                </div>


                
                {{-- Tombol Checkout Baru --}}
                <form action="{{ route('admin.checkout') }}" method="POST">
                    @csrf
                    <template x-for="id in selectedIds" :key="id">
                        <input type="hidden" name="selected_ids[]" :value="id">
                    </template>
                 <button 
    type="submit"
    class="inline-flex items-center justify-center px-6 py-3 text-sm font-medium rounded-lg shadow-sm 
           text-white transition-all duration-200 focus:outline-none focus:ring-4 
           disabled:cursor-not-allowed disabled:opacity-60"
    :class="{
        'bg-indigo-600 hover:bg-indigo-700 active:scale-95 focus:ring-indigo-300': selectedIds.length > 0,
        'bg-slate-300': selectedIds.length === 0
    }"
    :disabled="selectedIds.length === 0"
>
    <span x-text="selectedIds.length > 0 ? 'Bayar Semua (' + selectedIds.length + ')' : 'Bayar Semua'"></span>
</button>

                </form>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full table-auto">
            <thead class="text-xs font-semibold uppercase text-slate-500 bg-slate-50">
                <tr>
                    {{-- 3. Tambah Kolom Header untuk Checkbox --}}
                    <th class="p-4 w-px"></th>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left flex items-center">ID <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path></svg></div></th>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left flex items-center">NIM <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path></svg></div></th>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left flex items-center">Judul Buku <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path></svg></div></th>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left flex items-center">Book Code <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path></svg></div></th>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left flex items-center">Delay <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path></svg></div></th>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left flex items-center">Biaya <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path></svg></div></th>
                    {{-- <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left flex items-center">Status <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path></svg></div></th> --}}
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-center">Action</div></th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-slate-100">
                @forelse ($peminjaman as $item)
                {{-- :class untuk membuat baris yang tidak bisa dipilih menjadi pudar --}}
                <tr 
                    class="hover:bg-slate-50 transition-opacity duration-300"
                    :class="{ 'opacity-50': selectedNim !== null && selectedNim !== '{{ $item['nim'] }}' }"
                >
                    {{-- 4. Tambah Kolom Body untuk Checkbox --}}
                    <td class="p-4 whitespace-nowrap w-px">
                        <div class="flex items-center">
                            <label class="inline-flex">
                                <input 
                                    class="form-checkbox" 
                                    type="checkbox" 
                                    :checked="selectedIds.includes({{ $item['id'] }})"
                                    @click="toggleCheckbox($event, {{ $item['id'] }}, '{{ $item['nim'] }}')"
                                    :disabled="selectedNim !== null && selectedNim !== '{{ $item['nim'] }}'"
                                >
                            </label>
                        </div>
                    </td>
                    <td class="p-4 whitespace-nowrap"><div class="text-left text-slate-700">{{ $loop->iteration }}</div></td>
                    <td class="p-4 whitespace-nowrap"><div class="text-left font-medium text-slate-800">{{ $item['nim'] }}</div></td>
                    <td class="p-4 whitespace-nowrap"><div class="text-left text-slate-700">{{ $item['judul_buku'] }}</div></td>
                    <td class="p-4 whitespace-nowrap"><div class="text-left text-slate-700">{{ $item['item_book'] }}</div></td>
                    <td class="p-4 whitespace-nowrap"><div class="text-left text-slate-700">{{ $item['Delay'] }}</div></td>
                    <td class="p-4 whitespace-nowrap">
                        @if($item['denda'] > 0)
                            <div class="text-left text-red-500 font-medium">Rp. {{ number_format($item['denda'], 0, ',', '.') }}</div>
                        @else
                            <div class="text-left text-slate-700">-</div>
                        @endif
                    </td>

                    
                    {{-- <td class="p-4 whitespace-nowrap">
                        @if($item['status'] == 'Terlambat')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-red-50 text-red-700 border border-red-200">{{ $item['status'] }}</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">{{ $item['status'] }}</span>
                        @endif
                    </td> --}}



                    <td class="p-4 whitespace-nowrap text-center">
                        <a href="{{ route('admin.daftar-pinjam-detail', ['id' => $item['id']]) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold py-1.5 px-3 rounded-md transition duration-150 ease-in-out">
                            Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    {{-- Sesuaikan colspan karena ada tambahan 1 kolom --}}
                    <td colspan="9" class="p-4 text-center text-slate-500">
                        Tidak ada data keterlambatan untuk ditampilkan.
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