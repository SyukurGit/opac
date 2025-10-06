@extends('layouts.admin')

@section('header', 'Dashboard')

@section('content')
    {{-- SATU DIV PEMBUNGKUS UTAMA. Ini adalah kuncinya. --}}
    <div class="space-y-6">
        {{-- Bagian Kartu Statistik (sekarang ada di dalam pembungkus) --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
            
            {{-- Card: Total Pengguna --}}
            <div class="bg-white p-5 rounded-lg border border-slate-200 hover:border-slate-300 transition-all duration-200 hover:shadow-sm">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wide mb-1.5">Total Pengguna</p>
                        <p class="text-2xl font-semibold text-slate-900 truncate">1,250</p>
                    </div>
                    <div class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center flex-shrink-0 ml-3">
                        <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="flex items-center text-xs text-emerald-600 font-medium">
                    <svg class="w-3.5 h-3.5 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                    <span class="truncate">+12% dari bulan lalu</span>
                </div>
            </div>

            {{-- Card: Denda Aktif --}}
            <div class="bg-white p-5 rounded-lg border border-slate-200 hover:border-slate-300 transition-all duration-200 hover:shadow-sm">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wide mb-1.5">Denda Aktif</p>
                        <p class="text-2xl font-semibold text-slate-900 truncate">85</p>
                    </div>
                    <div class="w-10 h-10 bg-red-50 rounded-lg flex items-center justify-center flex-shrink-0 ml-3">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="flex items-center text-xs text-red-600 font-medium">
                    <svg class="w-3.5 h-3.5 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <span class="truncate">Perlu ditindaklanjuti</span>
                </div>
            </div>

            {{-- Card: Buku Dipinjam --}}
            <div class="bg-white p-5 rounded-lg border border-slate-200 hover:border-slate-300 transition-all duration-200 hover:shadow-sm">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wide mb-1.5">Buku Dipinjam</p>
                        <p class="text-2xl font-semibold text-slate-900 truncate">342</p>
                    </div>
                    <div class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center flex-shrink-0 ml-3">
                        <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                </div>
                <div class="flex items-center text-xs text-slate-600 font-medium">
                    <svg class="w-3.5 h-3.5 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="truncate">Dari 500 total buku</span>
                </div>
            </div>

            {{-- Card: Hari Ini --}}
            <div class="bg-white p-5 rounded-lg border border-slate-200 hover:border-slate-300 transition-all duration-200 hover:shadow-sm">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wide mb-1.5">Hari Ini</p>
                        <p class="text-2xl font-semibold text-slate-900 truncate">24</p>
                    </div>
                    <div class="w-10 h-10 bg-emerald-50 rounded-lg flex items-center justify-center flex-shrink-0 ml-3">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
                <div class="flex items-center text-xs text-emerald-600 font-medium">
                    <svg class="w-3.5 h-3.5 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="truncate">Peminjaman baru</span>
                </div>
            </div>
        </div>

        {{-- Bagian Tabel Aktivitas (sekarang ada di dalam pembungkus) --}}
        <div class="bg-white rounded-lg border border-slate-200 overflow-hidden">
            <div class="px-4 sm:px-6 py-4 border-b border-slate-200">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div class="flex-1 min-w-0">
                        <h3 class="text-base font-semibold text-slate-900 truncate">Aktivitas Terbaru</h3>
                        <p class="text-sm text-slate-500 mt-0.5 truncate">Transaksi peminjaman dan pengembalian</p>
                    </div>
                    <button class="px-4 py-2 bg-slate-900 hover:bg-slate-800 text-white text-sm font-medium rounded-lg transition-colors duration-150 whitespace-nowrap">
                        Lihat Semua
                    </button>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full min-w-[640px]">
                    <thead>
                        <tr class="border-b border-slate-200 bg-slate-50">
                            <th class="text-left py-3 px-4 sm:px-6 text-xs font-semibold text-slate-600 uppercase tracking-wide">Waktu</th>
                            <th class="text-left py-3 px-4 sm:px-6 text-xs font-semibold text-slate-600 uppercase tracking-wide">Pengguna</th>
                            <th class="text-left py-3 px-4 sm:px-6 text-xs font-semibold text-slate-600 uppercase tracking-wide">Aktivitas</th>
                            <th class="text-left py-3 px-4 sm:px-6 text-xs font-semibold text-slate-600 uppercase tracking-wide">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr class="hover:bg-slate-50 transition-colors duration-150">
                            <td class="py-3.5 px-4 sm:px-6"><span class="text-sm text-slate-600 whitespace-nowrap">10:23 AM</span></td>
                            <td class="py-3.5 px-4 sm:px-6"><div class="flex items-center space-x-3 min-w-0"><div class="w-8 h-8 bg-slate-900 rounded-full flex items-center justify-center flex-shrink-0"><span class="text-white text-xs font-medium">JD</span></div><span class="text-sm font-medium text-slate-900 truncate">John Doe</span></div></td>
                            <td class="py-3.5 px-4 sm:px-6"><span class="text-sm text-slate-700">Meminjam buku "Laravel Advanced"</span></td>
                            <td class="py-3.5 px-4 sm:px-6"><span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200 whitespace-nowrap">Berhasil</span></td>
                        </tr>
                        <tr class="hover:bg-slate-50 transition-colors duration-150">
                            <td class="py-3.5 px-4 sm:px-6"><span class="text-sm text-slate-600 whitespace-nowrap">09:15 AM</span></td>
                            <td class="py-3.5 px-4 sm:px-6"><div class="flex items-center space-x-3 min-w-0"><div class="w-8 h-8 bg-slate-700 rounded-full flex items-center justify-center flex-shrink-0"><span class="text-white text-xs font-medium">AS</span></div><span class="text-sm font-medium text-slate-900 truncate">Rajul Smith</span></div></td>
                            <td class="py-3.5 px-4 sm:px-6"><span class="text-sm text-slate-700">Mengembalikan buku "PHP Basics"</span></td>
                            <td class="py-3.5 px-4 sm:px-6"><span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-blue-50 text-blue-700 border border-blue-200 whitespace-nowrap">Selesai</span></td>
                        </tr>
                        <tr class="hover:bg-slate-50 transition-colors duration-150">
                            <td class="py-3.5 px-4 sm:px-6"><span class="text-sm text-slate-600 whitespace-nowrap">08:42 AM</span></td>
                            <td class="py-3.5 px-4 sm:px-6"><div class="flex items-center space-x-3 min-w-0"><div class="w-8 h-8 bg-slate-600 rounded-full flex items-center justify-center flex-shrink-0"><span class="text-white text-xs font-medium">BJ</span></div><span class="text-sm font-medium text-slate-900 truncate">Syukur Johnson</span></div></td>
                            <td class="py-3.5 px-4 sm:px-6"><span class="text-sm text-slate-700">Terlambat mengembalikan buku</span></td>
                            <td class="py-3.5 px-4 sm:px-6"><span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-red-50 text-red-700 border border-red-200 whitespace-nowrap">Denda</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection