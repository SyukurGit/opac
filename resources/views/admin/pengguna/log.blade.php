{{-- resources/views/admin/pengguna/log.blade.php --}}
@extends('layouts.admin')

{{-- Judul header akan dinamis sesuai nama pengguna --}}
@section('header', 'Log Aktivitas: ' . $user->name)

@section('content')

{{-- Tombol Kembali --}}
<div class="mb-6">
    <a href="{{ route('admin.pengguna.index') }}"
       class="inline-flex items-center px-4 py-2 bg-white border border-slate-300 rounded-md font-semibold text-xs text-slate-700 uppercase tracking-widest shadow-sm hover:bg-slate-50">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        Kembali ke Daftar Pengguna
    </a>
</div>

<div class="bg-white rounded-lg border border-slate-200">
    <div class="p-5">
        <h2 class="text-lg font-semibold text-slate-800">Detail Aktivitas</h2>
        <p class="text-sm text-slate-500">Menampilkan riwayat aktivitas untuk pengguna <span class="font-medium">{{ $user->name }}</span> ({{ $user->email }}).</p>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full table-auto">
            <thead class="text-xs font-semibold uppercase text-slate-500 bg-slate-50">
                <tr>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left">Waktu</div></th>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left">Aktivitas</div></th>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left">Detail</div></th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-slate-100">
                <tr>
                    <td colspan="3" class="p-4 text-center text-slate-500">
                        Fitur log aktivitas sedang dalam pengembangan. Data akan ditampilkan di sini.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection