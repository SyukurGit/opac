@extends('layouts.admin')

@section('header', 'Daftar Pengguna Terdaftar (SSO)')

@section('content')

<div class="bg-white rounded-lg border border-slate-200">
    <div class="p-5 border-b border-slate-200">
        <h2 class="text-lg font-semibold text-slate-800">Pengguna Aktif</h2>
        <p class="text-sm text-slate-500">Berikut adalah daftar semua pengguna yang telah login ke sistem melalui SSO.</p>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full table-auto">
            <thead class="text-xs font-semibold uppercase text-slate-500 bg-slate-50">
                <tr>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left">Nama Pengguna</div></th>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left">Email</div></th>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left">Keycloak ID</div></th>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left">Login Terakhir</div></th>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left">  Log Admin</div></th>

                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-slate-100">
                @forelse ($users as $user)
                    <tr class="hover:bg-slate-50">
                        <td class="p-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-10 h-10 shrink-0 mr-3">
                                    {{-- Tampilkan avatar jika ada, jika tidak, tampilkan inisial --}}
                                    @if($user->avatar)
                                        <img class="rounded-full" src="{{ $user->avatar }}" width="40" height="40" alt="{{ $user->name }}">
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-indigo-500 text-white flex items-center justify-center font-semibold">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="font-medium text-slate-800">{{ $user->name }}</div>
                            </div>
                        </td>
                        <td class="p-4 whitespace-nowrap">
                            <div class="text-left text-slate-700">{{ $user->email }}</div>
                        </td>
                        <td class="p-4 whitespace-nowrap">
                            <div class="text-left text-xs text-slate-500">{{ $user->keycloak_id }}</div>
                        </td>
                        <td class="p-4 whitespace-nowrap">
                            {{-- Format tanggal updated_at menjadi lebih mudah dibaca --}}
                            <div class="text-left text-slate-700">{{ $user->updated_at->diffForHumans() }}</div>
                            <div class="text-left text-xs text-slate-500">{{ $user->updated_at->format('d M Y, H:i') }}</div>
                        </td>

{{-- !!! 2. TAMBAHKAN SEL TABEL BARU DENGAN TOMBOL INI !!! --}}
                        <td class="p-4 whitespace-nowrap text-center">
                            <a href="{{ route('admin.pengguna.log', $user->id) }}"
                               class="px-3 py-1.5 text-xs font-semibold text-white bg-slate-500 hover:bg-slate-600 rounded-md transition-colors">
                                Log Aktivitas
                            </a>
                        </td>


                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-4 text-center text-slate-500">
                            Belum ada pengguna yang login ke sistem.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{-- Tampilkan link paginasi --}}
    @if ($users->hasPages())
        <div class="p-5">
            {{ $users->links() }}
        </div>
    @endif
</div>

@endsection