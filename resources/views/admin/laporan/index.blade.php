@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <div>
            <h2 class="text-2xl font-semibold leading-tight text-gray-800">Laporan Pembayaran Denda</h2>
        </div>

        <div class="my-4 flex sm:flex-row flex-col">
            <form action="{{ route('admin.laporan.index') }}" method="GET" class="w-full">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <svg viewBox="0 0 24 24" class="h-4 w-4 text-gray-500">
                            <path
                                d="M10,18a8,8,0,1,1,8-8A8,8,0,0,1,10,18ZM1,10a9,9,0,1,0,9-9A9,9,0,0,0,1,10Z"
                                fill="currentColor"></path>
                            <path
                                d="M22,23a1,1,0,0,1-.71-.29l-4-4a1,1,0,0,1,1.42-1.42l4,4a1,1,0,0,1,0,1.42A1,1,0,0,1,22,23Z"
                                fill="currentColor"></path>
                        </svg>
                    </span>
                    <input placeholder="Cari berdasarkan NIM, Nama, atau Item Book..." name="search"
                        class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-10 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" value="{{ request('search') }}">
                </div>
            </form>
        </div>

        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr class="bg-gray-100 text-gray-600 uppercase text-sm">
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-left">Peminjam</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-left">Detail Buku</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-left">Denda Asli</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-left">Total Dibayar</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-left">Info Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($laporanTergabung as $transaksi)
                        @php
                            // Ambil item pertama sebagai perwakilan data umum (nim, nama, dll)
                            $perwakilan = $transaksi->first();
                        @endphp
                        <tr class="hover:bg-gray-50">
                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                <p class="text-gray-900 font-semibold whitespace-no-wrap">{{ $perwakilan->nama_peminjam }}</p>
                                <p class="text-gray-600 whitespace-no-wrap">{{ $perwakilan->nim }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                <ul class="list-disc list-inside">
                                    @foreach ($transaksi as $item)
                                        <li>{{ $item->judul_buku }} ({{ $item->item_book }})</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">Rp {{ number_format($transaksi->sum('denda_asli'), 0, ',', '.') }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                <p class="text-green-600 font-bold whitespace-no-wrap">Rp {{ number_format($perwakilan->denda_dibayar, 0, ',', '.') }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $perwakilan->metode_pembayaran }}</p>
                                <p class="text-gray-600 whitespace-no-wrap">{{ $perwakilan->tanggal_bayar->format('d M Y, H:i') }}</p>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-10">
                                <p class="text-gray-500">Tidak ada data laporan yang ditemukan.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection 