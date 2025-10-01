@extends('layouts.admin')

@section('header')
    <div class="flex items-center justify-between">
        <span>Detail Peminjaman</span>
        <a href="{{ route('admin.daftar-pinjam') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900 flex items-center">
            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar Pinjam
        </a>
    </div>
@endsection

@section('content')
{{-- Container Form --}}
<div class="bg-white rounded-lg border border-slate-200 p-6">
    <h3 class="text-lg font-semibold text-slate-800 mb-6 border-b border-slate-200 pb-4">Detail Pembayaran Denda</h3>

    <form action="#" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
            {{-- Kolom Kiri --}}
            <div>
                {{-- MEMBER ID --}}
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1">MEMBER ID</label>
                    <input type="text" readonly value="{{ $peminjaman['member_id'] }}" class="w-full bg-slate-100 border-slate-200 rounded-md shadow-sm text-slate-500 cursor-not-allowed">
                </div>

                {{-- ITEM CODE --}}
                <div class="mt-4">
                    <label class="block text-sm font-medium text-slate-600 mb-1">KODE ITEM</label>
                    <input type="text" readonly value="{{ $peminjaman['item_code'] }}" class="w-full bg-slate-100 border-slate-200 rounded-md shadow-sm text-slate-500 cursor-not-allowed">
                </div>
            </div>

            {{-- Kolom Kanan --}}
            <div>
                {{-- MEMBER NAME --}}
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1">NAMA MEMBER</label>
                    <input type="text" readonly value="{{ $peminjaman['member_name'] }}" class="w-full bg-slate-100 border-slate-200 rounded-md shadow-sm text-slate-500 cursor-not-allowed">
                </div>

                {{-- ITEM TITLE --}}
                <div class="mt-4">
                    <label class="block text-sm font-medium text-slate-600 mb-1">JUDUL ITEM</label>
                    <input type="text" readonly value="{{ $peminjaman['item_title'] }}" class="w-full bg-slate-100 border-slate-200 rounded-md shadow-sm text-slate-500 cursor-not-allowed">
                </div>
            </div>

            {{-- Detail Tanggal dan Denda --}}
            <div class="grid grid-cols-2 md:grid-cols-4 col-span-1 md:col-span-2 gap-x-8 gap-y-6">
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1">TGL JATUH TEMPO</label>
                    <input type="text" readonly value="{{ $peminjaman['due_date'] }}" class="w-full bg-slate-100 border-slate-200 rounded-md shadow-sm text-slate-500 cursor-not-allowed">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1">TGL PENGEMBALIAN</label>
                    <input type="text" readonly value="{{ $peminjaman['return_date'] }}" class="w-full bg-slate-100 border-slate-200 rounded-md shadow-sm text-slate-500 cursor-not-allowed">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1">KETERLAMBATAN</label>
                    <input type="text" readonly value="{{ $peminjaman['delay'] }}" class="w-full bg-slate-100 border-slate-200 rounded-md shadow-sm text-red-500 font-medium cursor-not-allowed">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-600 mb-1">TAGIHAN (*1K/Hari)</label>
                    <input type="text" readonly value="{{ $peminjaman['billing'] }}" class="w-full bg-slate-100 border-slate-200 rounded-md shadow-sm text-red-500 font-medium cursor-not-allowed">
                </div>
            </div>

            {{-- Opsi Pembayaran --}}
            <div x-data="{ paymentMethod: 'manual' }" class="col-span-1 md:col-span-2">
                <label class="block text-sm font-medium text-slate-600 mb-2">Metode Pembayaran</label>
                <div class="flex space-x-4">
                    <label class="flex items-center px-4 py-3 bg-white border rounded-md cursor-pointer transition-all w-1/2" :class="paymentMethod === 'manual' ? 'border-indigo-600 ring-2 ring-indigo-200' : 'border-slate-300'">
                        <input type="radio" name="payment_method" value="manual" x-model="paymentMethod" class="h-4 w-4 text-indigo-600 border-slate-300 focus:ring-indigo-500">
                        <span class="ml-3 text-sm font-medium text-slate-800">Bayar Manual (Cash)</span>
                    </label>
                    <label class="flex items-center px-4 py-3 bg-white border rounded-md cursor-pointer transition-all w-1/2" :class="paymentMethod === 'online' ? 'border-indigo-600 ring-2 ring-indigo-200' : 'border-slate-300'">
                        <input type="radio" name="payment_method" value="online" x-model="paymentMethod" class="h-4 w-4 text-indigo-600 border-slate-300 focus:ring-indigo-500">
                        <span class="ml-3 text-sm font-medium text-slate-800">Generate Payment Online</span>
                    </label>
                </div>

                {{-- Form untuk Bayar Manual --}}
                <div x-show="paymentMethod === 'manual'" class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-x-8">
                     <div>
                        <label for="cash" class="block text-sm font-medium text-slate-600 mb-1">UANG TUNAI (CASH)</label>
                        <input type="text" id="cash" name="cash" value="{{ $peminjaman['cash'] }}" class="w-full border-slate-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label for="description" class="block text-sm font-medium text-slate-600 mb-1">DESKRIPSI (Opsional)</label>
                        <textarea id="description" name="description" rows="1" class="w-full border-slate-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                    </div>
                </div>
            </div>

            {{-- Aksi Form --}}
            <div class="col-span-1 md:col-span-2 pt-6 border-t border-slate-200 mt-2">
                <div class="flex items-center justify-between">
                     <label class="flex items-center">
                        <input type="checkbox" class="h-4 w-4 rounded border-slate-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        <span class="ml-2 text-sm text-slate-600">Validasi Pembayaran</span>
                    </label>

                    <div class="flex items-center space-x-3">
                        <button type="reset" class="px-4 py-2 bg-white border border-slate-300 rounded-md text-sm font-medium text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Reset
                        </button>
                        <button type="submit" class="px-6 py-2 bg-indigo-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection