@extends('layouts.admin')

@section('header', 'Daftar Denda Peminjaman')

@section('content')

{{-- Form untuk pencarian (method GET) --}}
<form id="searchForm" action="{{ route('admin.daftar_denda.index') }}" method="GET"></form>

{{-- Form utama untuk proses checkout (method POST) --}}
<form action="#" method="POST"> {{-- Ganti "#" dengan route checkout Anda, misal: {{ route('admin.checkout.process') }} --}}
    @csrf

    {{-- Komponen Alpine.js untuk state management --}}
    <div class="bg-white rounded-lg border border-slate-200" x-data="dendaComponent()">
        <div class="px-5 py-4 border-b border-slate-200">
            <div class="flex items-center justify-between">

                {{-- Input Pencarian --}}
                <div class="relative w-full max-w-md">
                    <label for="search" class="sr-only">Cari</label>
                    <input id="search" name="search" form="searchForm"
                           class="form-input w-full pl-9 pr-3 py-2 rounded-lg border border-slate-300 bg-slate-50 text-slate-900"
                           type="search" placeholder="Cari Member ID atau Kode Item..." value="{{ request('search') }}">
                    <button type="submit" form="searchForm" aria-label="Cari" class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <svg class="w-4 h-4 shrink-0 fill-current text-slate-400" viewBox="0 0 16 16"><path d="M7 14c-3.86 0-7-3.14-7-7s3.14-7 7-7 7 3.14 7 7-3.14 7-7 7zM7 2C4.243 2 2 4.243 2 7s2.243 5 5 5 5-2.243 5-5-2.243-5-5-5z"/><path d="M15.707 14.293L13.314 11.9a8.019 8.019 0 01-1.414 1.414l2.393 2.393a.997.997 0 001.414 0 .999.999 0 000-1.414z"/></svg>
                    </button>
                </div>

                {{-- Tombol Checkout & Total Denda --}}
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="text-sm text-slate-500">Total Denda Terpilih</p>
                        <p class="text-xl font-bold text-slate-800" x-text="`Rp ${totalDenda.toLocaleString('id-ID')}`"></p>
                    </div>
                    <button type="submit"
                            :disabled="selectedItems.length === 0"
                            :class="{
                                'bg-gray-400 cursor-not-allowed': selectedItems.length === 0,
                                'bg-blue-600 hover:bg-blue-700': selectedItems.length > 0
                            }"
                            class="inline-block px-6 py-3 text-base font-semibold text-white rounded-lg transition-colors duration-300 whitespace-nowrap">
                        Bayar Semua
                    </button>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead class="text-xs font-semibold uppercase text-slate-500 bg-slate-50">
                    <tr>
                        <th class="p-4 w-px"></th>
                        <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left">NIM (Member ID)</div></th>
                        <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left">Kode Buku</div></th>
                        <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left">Keterlambatan</div></th>
                        <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left">Jumlah Denda</div></th>
                        <th class="p-4 whitespace-nowrap"><div class="font-semibold text-center">Action</div></th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-slate-100">
                    @forelse ($daftar_denda as $item)
                        <tr class="hover:bg-slate-50 transition-opacity duration-300"
                            :class="{ 'opacity-50': selectedMemberId !== null && selectedMemberId !== '{{ $item['member_id'] }}' }">
                            <td class="p-4 whitespace-nowrap w-px">
                                <div class="flex items-center">
                                    <label class="inline-flex">
                                        <input class="form-checkbox" type="checkbox"
                                               name="selected_loans[]"
                                               :value="{{ $item['loan_id'] }}"
                                               :id="'checkbox-' + {{ $item['loan_id'] }}"
                                               @change="toggleSelection({{ json_encode($item) }})"
                                               :disabled="selectedMemberId !== null && selectedMemberId !== '{{ $item['member_id'] }}'">
                                    </label>
                                </div>
                            </td>
                            <td class="p-4 whitespace-nowrap"><div class="text-left font-medium text-slate-800">{{ $item['member_id'] }}</div></td>
                            <td class="p-4 whitespace-nowrap"><div class="text-left text-slate-700">{{ $item['item_code'] }}</div></td>
                            <td class="p-4 whitespace-nowrap"><div class="text-left text-slate-700">{{ $item['keterlambatan'] }} Hari</div></td>
                            <td class="p-4 whitespace-nowrap">
                                <div class="text-left text-red-500 font-medium">Rp. {{ number_format($item['denda'], 0, ',', '.') }}</div>
                            </td>
                            <td class="p-4 whitespace-nowrap text-center">
                                {{-- Arahkan ke route detail dengan parameter loan_id --}}
                                <a href="#" {{-- Ganti "#" dengan route detail, misal: {{ route('admin.daftar_denda.detail', $item['loan_id']) }} --}}
                                   class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold py-1.5 px-3 rounded-md transition duration-150 ease-in-out">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-4 text-center text-slate-500">
                                Tidak ada data keterlambatan untuk ditampilkan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</form>

<script>
    function dendaComponent() {
        return {
            // Inisialisasi data dari variabel PHP yang sudah diproses
            dendaData: @json(array_values($daftar_denda)),
            selectedItems: [],
            selectedMemberId: null,
            totalDenda: 0,

            toggleSelection(item) {
                // Batasi pemilihan hanya untuk Member ID yang sama
                if (this.selectedMemberId && this.selectedMemberId !== item.member_id) {
                    alert('Hanya bisa memilih item dengan Member ID (NIM) yang sama.');
                    // Batalkan centang pada checkbox
                    document.getElementById('checkbox-' + item.loan_id).checked = false;
                    return;
                }

                const index = this.selectedItems.findIndex(selected => selected.loan_id === item.loan_id);
                if (index > -1) {
                    // Jika sudah ada, hapus dari daftar pilihan
                    this.selectedItems.splice(index, 1);
                } else {
                    // Jika belum ada, tambahkan ke daftar pilihan
                    this.selectedItems.push(item);
                }

                // Set atau reset Member ID yang terpilih
                if (this.selectedItems.length > 0) {
                    this.selectedMemberId = this.selectedItems[0].member_id;
                } else {
                    this.selectedMemberId = null;
                }

                this.calculateTotal();
            },

            calculateTotal() {
                // Hitung total denda dari item yang dipilih
                this.totalDenda = this.selectedItems.reduce((sum, item) => {
                    return sum + item.denda;
                }, 0);
            },
        }
    }
</script>
@endsection