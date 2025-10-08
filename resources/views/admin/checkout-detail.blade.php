{{-- resources/views/admin/checkout-detail.blade.php --}}
@extends('layouts.admin')

@section('header', 'Detail Info Denda')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    
    {{-- Kolom Kiri: Detail Pembayaran --}}
    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-1">Detail Pembayaran</h2>
            <p class="text-gray-600 text-sm mb-8">Harap konfirmasi detail denda yang akan dibayarkan.</p>

            {{-- Informasi Peminjam --}}
            <div class="mb-8 pb-6 border-b border-gray-100">
                <h3 class="text-base font-semibold text-gray-900 mb-4">Informasi Peminjam</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div class="text-gray-600">NIM</div>
                    <div class="text-gray-900 font-medium">{{ $peminjam['nim'] }}</div>
                    <div class="text-gray-600">Nama Lengkap</div>
                    <div class="text-gray-900 font-medium">{{ $peminjam['nama'] }}</div>
                </div>
            </div>

            {{-- Tabel Rincian Denda --}}
            <h3 class="text-base font-semibold text-gray-900 mb-4">Rincian Denda</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="pb-3 text-left font-semibold text-gray-700">Judul Buku</th>
                            <th class="pb-3 text-center font-semibold text-gray-700">Keterlambatan</th>
                            <th class="pb-3 text-right font-semibold text-gray-700">Jumlah Denda</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr class="border-b border-gray-100">
                            <td class="py-4 text-gray-800">{{ $item->judul_buku }}</td>
                            <td class="py-4 text-gray-800 text-center">{{ $item->delay }}</td>
                            <td class="py-4 text-gray-900 text-right font-semibold">Rp {{ number_format($item->denda, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Kolom Kanan: Opsi Pembayaran & Total --}}
    <div>
        <form action="#" method="POST">
            @csrf
            @foreach ($items as $item)
                <input type="hidden" name="peminjaman_ids[]" value="{{ $item->id }}">
            @endforeach

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sticky top-6">
                <h3 class="text-lg font-bold text-gray-900 mb-6">Total & Pembayaran</h3>
                
                {{-- Total --}}
                <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-xl p-5 mb-6">
                    <div class="text-sm text-gray-600 mb-1">Total Tagihan</div>
                    <div class="text-3xl font-bold text-indigo-600">Rp {{ number_format($totalDenda, 0, ',', '.') }}</div>
                </div>

                {{-- Pilihan Metode Pembayaran --}}
                <div class="mb-6">
                    <h4 class="font-semibold text-gray-900 text-sm mb-3">Pilih Metode Pembayaran</h4>
                    <div class="space-y-2">
                        <label class="flex items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-indigo-300 hover:bg-indigo-50/50 transition-all duration-200">
                            <input type="radio" name="payment_method" value="online" class="w-4 h-4 text-indigo-600" checked>
                            <span class="ml-3 text-gray-800 text-sm font-medium">Pembayaran Online (Edlink)</span>
                        </label>
                        {{-- <label class="flex items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-indigo-300 hover:bg-indigo-50/50 transition-all duration-200">
                            <input type="radio" name="payment_method" value="offline" class="w-4 h-4 text-indigo-600">
                            <span class="ml-3 text-gray-800 text-sm font-medium">Pembayaran Offline (Langsung cash)</span>
                        </label> --}}
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <button type="submit" class="w-full bg-indigo-600 text-white font-semibold py-3.5 px-4 rounded-xl hover:bg-indigo-700 active:bg-indigo-800 transition-all duration-200 shadow-sm hover:shadow-md">
                    Proses Pembayaran
                </button>
            </div>
        </form>
    </div>
</div>
@endsection