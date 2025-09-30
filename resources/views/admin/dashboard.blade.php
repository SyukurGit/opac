@extends('layouts.admin')

@section('header', 'Dashboard')

@section('content')
    {{-- Baris untuk Kartu Statistik --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        {{-- Kartu 1: Total Pengguna --}}
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-gray-500 text-sm font-medium">Total Pengguna</h3>
            <p class="text-3xl font-bold text-gray-800 mt-2">1,250</p>
        </div>

        {{-- Kartu 2: Denda Aktif --}}
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-gray-500 text-sm font-medium">Denda Aktif</h3>
            <p class="text-3xl font-bold text-gray-800 mt-2">85</p>
        </div>

        {{-- Kartu lain bisa ditambahkan di sini --}}
    </div>

    {{-- Bagian untuk Tabel atau Grafik --}}
    <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold mb-4">Aktivitas Terbaru</h3>
        {{-- Di sini bisa ditaruh tabel transaksi terakhir --}}
    </div>
@endsection