@extends('layouts.admin')

@section('header', 'Detail Info Denda')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    
    {{-- Kolom Kiri: Detail Pembayaran --}}
    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-1">Detail Pembayaran</h2>
            <p class="text-gray-600 text-sm mb-8">Harap konfirmasi detail denda yang akan dibayarkan.</p>

            {{-- Informasi Peminjam (Tidak ada perubahan) --}}
            <div class="mb-8 pb-6 border-b border-gray-100">
                <h3 class="text-base font-semibold text-gray-900 mb-4">Informasi Peminjam</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div class="text-gray-600">NIM</div>
                    <div class="text-gray-900 font-medium">{{ $peminjam['nim'] }}</div>
                    <div class="text-gray-600">Nama Lengkap</div>
                    <div class="text-gray-900 font-medium">{{ $peminjam['nama'] }}</div>
                </div>
            </div>

            {{-- Tabel Rincian Denda (Ada sedikit perubahan pada nama kolom variabel) --}}
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
                            {{-- Menggunakan 'keterlambatan' sesuai skema baru --}}
                            <td class="py-4 text-gray-800 text-center">{{ $item->keterlambatan }} Hari</td> 
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




{{-- BLOK UNTUK MENAMPILKAN ERROR VALIDASI --}}
@if ($errors->any())
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
        <p class="font-bold">Terjadi Kesalahan</p>
        <ul class="mt-2 list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif









        {{-- Kita gunakan nama rute yang lebih spesifik nanti --}}
<form action="{{ route('admin.checkout.process') }}" method="POST">            @csrf
            {{-- Input hidden untuk ID peminjaman (tidak berubah) --}}
            @foreach ($items as $item)
                <input type="hidden" name="peminjaman_ids[]" value="{{ $item->id }}">
            @endforeach

            {{-- !!! KODE BARU DIMULAI DARI SINI !!! --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sticky top-6"
                 x-data="{
                    totalTagihan: {{ $totalDenda }},
                    jumlahDibayar: {{ $totalDenda }},
                    editing: false,
                    formatRupiah(angka) {
                        return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                    }
                 }">
                
                <h3 class="text-lg font-bold text-gray-900 mb-6">Total & Pembayaran</h3>
                
                {{-- Total Tagihan (Statis) --}}
                <div class="bg-slate-50 border border-slate-200 rounded-xl p-5 mb-4">
                    <div class="text-sm text-gray-600 mb-1">Total Tagihan Asli</div>
                    <div class="text-2xl font-semibold text-slate-700">Rp {{ number_format($totalDenda, 0, ',', '.') }}</div>
                </div>

                {{-- Jumlah Dibayar (Dinamis dan Bisa Diedit) --}}
                <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-xl p-5 mb-6 relative">
                    <div class="text-sm text-gray-600 mb-1">Jumlah Akan Dibayar</div>
                    
                    {{-- Tampilan Normal --}}
                    <div x-show="!editing" class="flex items-center justify-between">
                        <div class="text-3xl font-bold text-indigo-600" x-text="formatRupiah(jumlahDibayar)"></div>
                        <button @click="editing = true" type="button" class="text-xs text-indigo-600 font-semibold hover:underline">
                            Edit
                        </button>
                    </div>

                    {{-- Tampilan Edit --}}
                    <div x-show="editing" class="mt-2">
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">Rp</span>
                            <input type="number" x-model.number="jumlahDibayar" class="form-input w-full pl-8 rounded-lg" autofocus>
                        </div>
                        <div class="flex items-center justify-end space-x-2 mt-2">
                            <button @click="editing = false; jumlahDibayar = totalTagihan" type="button" class="text-xs text-gray-600 hover:underline">Batal</button>
                            <button @click="editing = false" type="button" class="px-3 py-1 text-xs bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Simpan</button>
                        </div>
                    </div>
                </div>
                
                {{-- Input hidden ini yang akan dikirim ke backend --}}
                <input type="hidden" name="jumlah_dibayar" :value="jumlahDibayar">

                {{-- Pilihan Metode Pembayaran (Tidak ada perubahan) --}}
                <div class="mb-6">
                    <h4 class="font-semibold text-gray-900 text-sm mb-3">Pilih Metode Pembayaran</h4>
                    <div class="space-y-2">
                        <label class="flex items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-indigo-300">
                            <input type="radio" name="payment_method" value="online" class="w-4 h-4 text-indigo-600" checked>
                            <span class="ml-3 text-gray-800 text-sm font-medium">Pembayaran Online (Edlink)</span>
                        </label>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <button type="submit" class="w-full bg-indigo-600 text-white font-semibold py-3.5 px-4 rounded-xl hover:bg-indigo-700">
                    Proses Pembayaran
                </button>
            </div>
        </form>
    </div>
</div>
@endsection