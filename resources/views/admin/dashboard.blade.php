@extends('layouts.admin') {{-- Memberitahu Blade untuk menggunakan layout admin.blade.php --}}

@section('header', 'Dashboard') {{-- Mengisi slot @yield('header') --}}

@section('content') {{-- Mengisi slot @yield('content') --}}
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <h3 class="text-lg font-medium">Selamat Datang Kembali!</h3>
            <p class="mt-2">Ini adalah halaman utama panel admin Anda.</p>
        </div>
    </div>
@endsection