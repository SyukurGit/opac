@extends('layouts.admin')

@section('content')
<main class="grow">
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-4xl mx-auto">
        <h1 class="text-2xl md:text-3xl text-slate-800 font-bold mb-6">Proses Pembayaran Denda</h1>

        <div class="bg-white shadow-lg rounded-sm border border-slate-200 p-6">
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-slate-800">Informasi Peminjam</h2>
                <p class="text-sm text-slate-600 mt-1">NIM: <span class="font-medium">{{ $items[0]['nim'] }}</span></p>
                <p class="text-sm text-slate-600">Nama: <span class="font-medium">{{ $items[0]['nama_peminjam'] }}</span></p>
            </div>

            <h2 class="text-lg font-semibold text-slate-800 mb-2">Item yang akan dibayar</h2>
            <div class="overflow-x-auto mb-6">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="p-3 text-left font-semibold text-slate-600">Judul Buku</th>
                            <th class="p-3 text-right font-semibold text-slate-600">Denda</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                            <tr class="border-b border-slate-200">
                                <td class="p-3 text-slate-700">{{ $item['judul_buku'] }}</td>
                                <td class="p-3 text-right text-red-600 font-medium">Rp. {{ number_format($item['denda'], 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="bg-slate-50 font-semibold">
                            <td class="p-3 text-right">TOTAL PEMBAYARAN</td>
                            <td class="p-3 text-right text-lg text-red-700">Rp. {{ number_format($totalDenda, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div>
                <h2 class="text-lg font-semibold text-slate-800 mb-4">Pilih Metode Pembayaran</h2>
                <div class="flex items-center space-x-4">
                    <button class="btn bg-emerald-500 hover:bg-emerald-600 text-white">
                        Bayar Online (QRIS)
                    </button>
                    <button class="btn bg-indigo-500 hover:bg-indigo-600 text-white">
                        Bayar Offline (Tunai)
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection