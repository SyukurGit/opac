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
                </table>@extends('layouts.admin')

@section('header', 'Konfirmasi Pembayaran Denda')

@section('content')
<div class="bg-white rounded-lg border border-slate-200" x-data="{ paymentMethod: '', selectedItems: {{ json_encode($items->pluck('id')) }} }">
    <div class="p-6">
        <h2 class="text-2xl font-bold text-slate-800 mb-2">Ringkasan Pembayaran</h2>
        <p class="text-slate-500 mb-6">Harap periksa kembali detail denda sebelum melanjutkan proses pembayaran.</p>

        {{-- Detail Peminjam --}}
        <div class="bg-slate-50 border border-slate-200 rounded-lg p-4 mb-6">
            <h3 class="font-semibold text-slate-800 mb-2">Detail Peminjam</h3>
            <div class="text-sm">
                <p><span class="text-slate-500 w-24 inline-block">NIM</span>: <span class="font-medium text-slate-700">{{ $items->first()->nim }}</span></p>
                <p><span class="text-slate-500 w-24 inline-block">Nama</span>: <span class="font-medium text-slate-700">{{ $items->first()->nama_peminjam }}</span></p>
            </div>
        </div>

        {{-- Tabel Rincian Denda --}}
        <div class="overflow-x-auto mb-6">
            <table class="w-full table-auto border-collapse">
                <thead class="text-xs font-semibold uppercase text-slate-500 bg-slate-100">
                    <tr>
                        <th class="p-3 whitespace-nowrap text-left">Judul Buku</th>
                        <th class="p-3 whitespace-nowrap text-right">Denda</th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-slate-200">
                    @foreach ($items as $item)
                    <tr>
                        <td class="p-3 text-slate-700">{{ $item->judul_buku }}</td>
                        <td class="p-3 text-right font-medium text-red-500">Rp {{ number_format($item->denda, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="text-sm font-semibold text-slate-800">
                    <tr>
                        <td class="p-3 text-right">Total Keseluruhan:</td>
                        <td class="p-3 text-right text-lg text-red-600">Rp {{ number_format($totalDenda, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        {{-- Opsi Metode Pembayaran --}}
        <div>
            <h3 class="text-lg font-semibold text-slate-800 mb-4">Pilih Metode Pembayaran</h3>
            <div class="space-y-3 mb-6">
                <label class="flex items-center p-4 border rounded-lg cursor-pointer transition-all" :class="paymentMethod === 'online' ? 'border-blue-500 bg-blue-50 shadow-sm' : 'border-slate-200 hover:border-slate-300'">
                    <input type="radio" name="payment_method" value="online" x-model="paymentMethod" class="form-radio text-blue-600">
                    <span class="ml-4">
                        <span class="font-semibold text-slate-800">Online (QRIS)</span>
                        <span class="block text-sm text-slate-500">Pembayaran digital melalui QRIS.</span>
                    </span>
                </label>
                <label class="flex items-center p-4 border rounded-lg cursor-pointer transition-all" :class="paymentMethod === 'offline' ? 'border-blue-500 bg-blue-50 shadow-sm' : 'border-slate-200 hover:border-slate-300'">
                    <input type="radio" name="payment_method" value="offline" x-model="paymentMethod" class="form-radio text-blue-600">
                    <span class="ml-4">
                        <span class="font-semibold text-slate-800">Offline (Tunai)</span>
                        <span class="block text-sm text-slate-500">Bayar langsung di konter perpustakaan.</span>
                    </span>
                </label>
            </div>

            {{-- Form untuk submit pembayaran final --}}
            <form x-on:submit.prevent="processPayment(paymentMethod, selectedItems)">
                <button type="submit"
                    :disabled="!paymentMethod"
                    :class="{ 'bg-gray-400 cursor-not-allowed': !paymentMethod, 'bg-green-600 hover:bg-green-700': paymentMethod }"
                    class="w-full text-white font-bold py-3 px-4 rounded-lg transition duration-300 ease-in-out">
                    Konfirmasi & Proses Pembayaran
                </button>
            </form>
        </div>
    </div>
</div>

<script>
// Kita bisa letakkan script ini di sini atau di app.js, untuk sekarang di sini saja
async function processPayment(method, itemIds) {
    if (!method) {
        alert('Silakan pilih metode pembayaran terlebih dahulu.');
        return;
    }

    const isConfirmed = confirm(`Anda akan memproses pembayaran dengan metode ${method.toUpperCase()}. Lanjutkan?`);
    if (!isConfirmed) return;

    try {
        const response = await fetch('/api/v1/pembayaran', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                peminjaman_ids: itemIds,
                metode_pembayaran: method
            })
        });

        const result = await response.json();
        if (!response.ok) {
            throw new Error(result.message || 'Terjadi kesalahan server.');
        }

        alert('Pembayaran berhasil diproses!');
        window.location.href = '{{ route('admin.daftar-pinjam') }}'; // Redirect kembali ke halaman daftar

    } catch (error) {
        console.error('Error:', error);
        alert('Gagal memproses pembayaran: ' + error.message);
    }
}
</script>
@endsection
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