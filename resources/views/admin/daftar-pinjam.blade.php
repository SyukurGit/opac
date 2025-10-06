@extends('layouts.admin')

@section('header', 'Daftar Denda Peminjaman')

@section('content')

{{-- 1. Inisialisasi Alpine.js menggunakan komponen yang kita definisikan di <script> --}}
<div class="bg-white rounded-lg border border-slate-200" x-data="peminjamanComponent()">
    <div class="px-5 py-4 border-b border-slate-200">
        <div class="flex items-center justify-between">
            {{-- Search Form --}}
            <div>
                <form action="{{ route('admin.daftar-pinjam') }}" method="GET" class="relative">
                    <label for="search" class="sr-only">Cari</label>
                    <input id="search" name="search"
                        class="form-input w-full pl-9 pr-3 py-2 rounded-lg border border-slate-300 bg-slate-50 text-slate-900"
                        type="search" placeholder="Cari NIM, Nama, atau Judul..." value="{{ request('search') }}">
                    <button class="absolute inset-0 right-auto" type="submit" aria-label="Cari">
                        <svg class="w-4 h-4 shrink-0 fill-current text-slate-400 ml-3 mr-2" viewBox="0 0 16 16">
                            <path
                                d="M7 14c-3.86 0-7-3.14-7-7s3.14-7 7-7 7 3.14 7 7-3.14 7-7 7zM7 2C4.243 2 2 4.243 2 7s2.243 5 5 5 5-2.243 5-5-2.243-5-5-5z" />
                            <path
                                d="M15.707 14.293L13.314 11.9a8.019 8.019 0 01-1.414 1.414l2.393 2.393a.997.997 0 001.414 0 .999.999 0 000-1.414z" />
                        </svg>
                    </button>
                </form>
            </div>

            {{-- Tombol Checkout & Total Denda --}}
            <div class="flex items-center space-x-4">
                <div class="text-right">
                    <p class="text-sm text-slate-500">Total Denda Terpilih</p>
                    <p class="text-xl font-bold text-slate-800" x-text="`Rp ${totalDenda.toLocaleString('id-ID')}`"></p>
                </div>


               {{-- INI KODE PERBAIKANNYA --}}
<div>
    <form action="{{ route('admin.checkout') }}" method="POST">
        @csrf
        <input type="hidden" name="items" x-bind:value="selectedItems.join(',')">
        <button type="submit"
            x-bind:disabled="selectedItems.length === 0"
            x-bind:class="{
                'bg-gray-400 cursor-not-allowed': selectedItems.length === 0,
                'bg-blue-600 hover:bg-blue-700': selectedItems.length > 0
            }"
            class="inline-block px-6 py-3 text-base font-semibold text-white rounded-lg transition-colors duration-300 whitespace-nowrap">
            Checkout
        </button>
    </form>
</div>



            </div>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full table-auto">
            <thead class="text-xs font-semibold uppercase text-slate-500 bg-slate-50">
                <tr>
                    <th class="p-4 w-px"></th>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left">NIM</div></th>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left">Nama Peminjam</div></th>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left">Judul Buku</div></th>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left">Keterlambatan</div></th>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left">Denda</div></th>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-center">Action</div></th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-slate-100">
                @forelse ($peminjaman as $item)
                <tr class="hover:bg-slate-50 transition-opacity duration-300"
                    :class="{ 'opacity-50': selectedNim !== null && selectedNim !== '{{ $item->nim }}' }">
                    <td class="p-4 whitespace-nowrap w-px">
                        <div class="flex items-center">
                            <label class="inline-flex">
                                <input class="form-checkbox" type="checkbox"
                                    :checked="selectedItems.includes({{ $item->id }})"
                                    @click="toggleCheckbox($event, {{ json_encode($item) }})"
                                    :disabled="selectedNim !== null && selectedNim !== '{{ $item->nim }}'">
                            </label>
                        </div>
                    </td>
                    {{-- PERBAIKAN DI BAWAH INI: Menggunakan $item->properti bukan $item['properti'] --}}
                    <td class="p-4 whitespace-nowrap"><div class="text-left font-medium text-slate-800">{{ $item->nim }}</div></td>
                    <td class="p-4 whitespace-nowrap"><div class="text-left text-slate-700">{{ $item->nama_peminjam }}</div></td>
                    <td class="p-4 whitespace-nowrap"><div class="text-left text-slate-700 max-w-xs truncate">{{ $item->judul_buku }}</div></td>
                    <td class="p-4 whitespace-nowrap"><div class="text-left text-slate-700">{{ $item->delay }}</div></td>
                    <td class="p-4 whitespace-nowrap">
                        <div class="text-left text-red-500 font-medium">Rp. {{ number_format($item->denda, 0, ',', '.') }}</div>
                    </td>
                    <td class="p-4 whitespace-nowrap text-center">
                        <a href="{{ route('admin.daftar-pinjam-detail', ['id' => $item->id]) }}"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold py-1.5 px-3 rounded-md transition duration-150 ease-in-out">
                            Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="p-4 text-center text-slate-500">
                        Tidak ada data keterlambatan untuk ditampilkan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


<script>
    function peminjamanComponent() {
        return {
            peminjamanData: @json($peminjaman),
            selectedItems: [],
            selectedNim: null,
            totalDenda: 0,

            toggleCheckbox(event, item) {
                const checkbox = event.target;
                const id = item.id;
                const nim = item.nim;

                if (checkbox.checked) {
                    if (this.selectedNim !== null && this.selectedNim !== nim) {
                        event.preventDefault();
                        alert('Hanya bisa memilih item dengan NIM yang sama.');
                        return;
                    }
                }

                if (checkbox.checked) {
                    this.selectedItems.push(id);
                    this.selectedNim = nim;
                } else {
                    this.selectedItems = this.selectedItems.filter(i => i !== id);
                    if (this.selectedItems.length === 0) {
                        this.selectedNim = null;
                    }
                }
                this.calculateTotal();
            },

            calculateTotal() {
                this.totalDenda = this.selectedItems.reduce((sum, currentId) => {
                    const item = this.peminjamanData.find(p => p.id === currentId);
                    return sum + (item ? item.denda : 0);
                }, 0);
            },

            async processPayment() {
                if (this.selectedItems.length === 0) {
                    alert('Silakan pilih item yang akan dibayar.');
                    return;
                }
                const isConfirmed = confirm(`Anda akan memproses pembayaran untuk ${this.selectedItems.length} item dengan total denda Rp ${this.totalDenda.toLocaleString('id-ID')}. Lanjutkan?`);
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
                            peminjaman_ids: this.selectedItems,
                            metode_pembayaran: 'QRIS'
                        })
                    });
                    const result = await response.json();
                    if (!response.ok) {
                        let errorMsg = result.message || 'Terjadi kesalahan.';
                        if (result.errors) {
                            errorMsg += '\n' + Object.values(result.errors).flat().join('\n');
                        }
                        throw new Error(errorMsg);
                    }
                    alert('Pembayaran berhasil diproses!');
                    location.reload();
                } catch (error) {
                    console.error('Error:', error);
                    alert('Gagal memproses pembayaran: ' + error.message);
                }
            }
        }
    }
</script>
@endsection