@extends('admin.index')

{{-- Mengisi judul header yang akan ditampilkan di navbar --}}
@section('header', 'Dashboard Utama')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-8">
    <div>
        <h1 class="text-2xl font-semibold leading-tight text-gray-800">Selamat Datang Kembali, {{ $user->name ?? 'Admin' }}!</h1>
        <p class="mt-1 text-sm text-gray-600">Ini adalah halaman utama panel admin Anda.</p>
    </div>

    <div class="p-6 bg-white shadow-lg rounded-xl">
        <h2 class="text-lg font-medium text-gray-900 border-b pb-3">Detail Akun Pengguna (dari SSO)</h2>
        <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">
            
            <div class="p-4 bg-gray-50 rounded-lg">
                <dt class="text-sm font-medium text-gray-500">Nama Lengkap</dt>
                <dd class="mt-1 text-md font-semibold text-gray-900">{{ $user->name ?? 'Tidak tersedia' }}</dd>
            </div>

            <div class="p-4 bg-gray-50 rounded-lg">
                <dt class="text-sm font-medium text-gray-500">Alamat Email</dt>
                <dd class="mt-1 text-md font-semibold text-gray-900">{{ $user->email ?? 'Tidak tersedia' }}</dd>
            </div>
            
            <div class="p-4 bg-gray-50 rounded-lg">
                <dt class="text-sm font-medium text-gray-500">ID Pengguna (SSO)</dt>
                <dd class="mt-1 text-md font-semibold text-gray-900">{{ $user->id ?? 'Tidak tersedia' }}</dd>
            </div>
            
            <div class="p-4 bg-gray-50 rounded-lg">
                <dt class="text-sm font-medium text-gray-500">Waktu Login</dt>
                <dd class="mt-1 text-md font-semibold text-gray-900">{{ $user->created_at ? $user->created_at->format('d M Y, H:i') : 'Tidak tersedia' }}</dd>
            </div>
        </div>
    </div>
    
    {{-- PERBAIKAN DI SINI --}}
    <div class="p-6 bg-white shadow-lg rounded-xl">
        <h3 class="text-lg font-medium text-gray-900">Data Lengkap (Raw)</h3>
        {{-- Menambahkan overflow-x-auto agar bisa discroll ke samping jika konten terlalu lebar --}}
        <div class="mt-2 p-4 text-xs text-gray-700 bg-gray-100 rounded-md overflow-x-auto">
            <pre><code>{{ print_r($user->toArray(), true) }}</code></pre>
        </div>
        <p class="mt-2 text-xs text-gray-500">Ini adalah semua data yang diterima dari sistem SSO untuk pengguna ini, berguna untuk development.</p>
    </div>
</div>
@endsection 