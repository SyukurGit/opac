{{-- resources/views/admin/checkout-detail.blade.php --}}
@extends('layouts.admin')

@section('header', 'Detail Checkout Denda')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    {{-- Kolom Kiri: Detail Pembayaran --}}
    <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Ringkasan Pembayaran</h2>
            <p class="text-gray-500 mb-6">Harap konfirmasi detail denda yang akan dibayarkan.</p>

            {{-- Informasi Peminjam --}}
            <div class="mb-6 border-b pb-4">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Informasi Peminjam</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div class="text-gray-500">NIM</div>
                    <div class="text-gray-800 font-medium">{{ $peminjam['nim'] }}</div>
                    <div class="text-gray-500">Nama Lengkap</div>
                    <div class="text-gray-800 font-medium">{{ $peminjam['nama'] }}</div>
                </div>
            </div>

            {{-- Tabel Rincian Denda --}}
            <h3 class="text-lg font-semibold text-gray-700 mb-3">Rincian Denda</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="p-3 text-left font-semibold text-gray-600">Judul Buku</th>
                            <th class="p-3 text-center font-semibold text-gray-600">Keterlambatan</th>
                            <th class="p-3 text-right font-semibold text-gray-600">Jumlah Denda</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr class="border-b">
                            <td class="p-3 text-gray-700">{{ $item->judul_buku }}</td>
                            <td class="p-3 text-gray-700 text-center">{{ $item->delay }}</td>
                            <td class="p-3 text-gray-800 text-right font-medium">Rp {{ number_format($item->denda, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Kolom Kanan: Opsi Pembayaran & Total --}}
    <div>
        <form action="#" method="POST"> {{-- Nanti akan kita arahkan ke rute proses pembayaran --}}
            @csrf
            {{-- Kirim lagi ID item yang relevan untuk proses pembayaran final --}}
            @foreach ($items as $item)
                <input type="hidden" name="peminjaman_ids[]" value="{{ $item->id }}">
            @endforeach

            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Total & Pembayaran</h3>
                
                {{-- Total --}}
                <div class="flex justify-between items-center mb-6 pb-6 border-b">
                    <span class="text-gray-600 font-semibold">Total Tagihan</span>
                    <span class="text-2xl font-bold text-indigo-600">Rp {{ number_format($totalDenda, 0, ',', '.') }}</span>
                </div>

                {{-- Pilihan Metode Pembayaran --}}
                <div class="mb-6">
                    <h4 class="font-semibold text-gray-700 mb-3">Pilih Metode Pembayaran</h4>
                    <div class="space-y-3">
                        <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="radio" name="payment_method" value="online" class="form-radio text-indigo-600" checked>
                            <span class="ml-3 text-gray-700">Pembayaran Online (e.g., QRIS, VA)</span>
                        </label>
                        <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="radio" name="payment_method" value="offline" class="form-radio text-indigo-600">
                            <span class="ml-3 text-gray-700">Pembayaran Offline (di konter)</span>
                        </label>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-indigo-700 transition-colors duration-300">
                    Proses Pembayaran
                </button>
            </div>
        </form>
    </div>
</div>
@endsection