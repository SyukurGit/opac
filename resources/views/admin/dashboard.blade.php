@extends('admin.index')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-8">
    <div>
        <h1 class="text-2xl font-semibold leading-tight text-gray-800">Selamat Datang, {{ $user->name ?? 'Admin' }}!</h1>
        <p class="mt-1 text-sm text-gray-600">Berikut adalah ringkasan informasi Anda.</p>
    </div>

    <div class="p-6 bg-white shadow-lg rounded-xl">
        <h2 class="text-lg font-medium text-gray-900 border-b pb-3">Detail Akun Pengguna</h2>
        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
            
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
                <dt class="text-sm font-medium text-gray-500">Terakhir Diperbarui</dt>
                <dd class="mt-1 text-md font-semibold text-gray-900">{{ $user->updated_at ? $user->updated_at->format('d M Y, H:i') : 'Tidak tersedia' }}</dd>
            </div>

        </div>
    </div>
    
    <div class="p-6 bg-white shadow-lg rounded-xl">
        <h3 class="text-lg font-medium text-gray-900">Data Mentah (Raw)</h3>
        <div class="mt-2 p-4 text-xs text-gray-700 bg-gray-100 rounded-md overflow-x-auto">
            <pre><code>{{ print_r($user->toArray(), true) }}</code></pre>
        </div>
        <p class="mt-2 text-xs text-gray-500">Ini adalah semua data yang diterima dari sistem SSO untuk pengguna ini.</p>
    </div>
</div>
@endsection