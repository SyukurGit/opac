@extends('layouts.admin')

@section('header', 'Daftar Peminjaman')

@section('content')
<div class="bg-white rounded-lg border border-slate-200">
    <div class="px-5 py-4 border-b border-slate-200">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-2 text-sm">
                <span>Show</span>
                <select class="border border-slate-300 rounded-md shadow-sm focus:ring-2 focus:ring-slate-400 focus:border-slate-400 transition duration-150 ease-in-out py-1.5 px-2">
                    <option>10</option>
                    <option>25</option>
                    <option>50</option>
                </select>
                <span>entries</span>
            </div>

            <div class="relative">
                <input type="text" placeholder="Search..." class="w-64 pl-9 pr-4 py-2 border border-slate-300 rounded-md shadow-sm focus:ring-2 focus:ring-slate-400 focus:border-slate-400 transition duration-150 ease-in-out text-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full table-auto">
            <thead class="text-xs font-semibold uppercase text-slate-500 bg-slate-50">
                <tr>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left flex items-center">ID <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path></svg></div></th>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left flex items-center">Member ID <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path></svg></div></th>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left flex items-center">Item Code <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path></svg></div></th>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left flex items-center">Due Date <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path></svg></div></th>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left flex items-center">Return Date <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path></svg></div></th>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left flex items-center">Delay <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path></svg></div></th>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-left flex items-center">Amount <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path></svg></div></th>
                    <th class="p-4 whitespace-nowrap"><div class="font-semibold text-center">Action</div></th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-slate-100">
                {{-- Data statis sebagai contoh --}}
                @for ($i = 1; $i <= 8; $i++)
                <tr class="hover:bg-slate-50">
                    <td class="p-4 whitespace-nowrap"><div class="text-left text-slate-700">{{ $i }}</div></td>
                    <td class="p-4 whitespace-nowrap"><div class="text-left font-medium text-slate-800">230503072</div></td>
                    <td class="p-4 whitespace-nowrap"><div class="text-left text-slate-700">0041016TXT03</div></td>
                    <td class="p-4 whitespace-nowrap"><div class="text-left text-slate-700">2025-09-26</div></td>
                    <td class="p-4 whitespace-nowrap"><div class="text-left text-slate-700">2025-09-29</div></td>
                    <td class="p-4 whitespace-nowrap"><div class="text-left text-red-500 font-medium">+3 days</div></td>
                    <td class="p-4 whitespace-nowrap"><div class="text-left text-red-500 font-medium">+3 days</div></td>
                    <td class="p-4 whitespace-nowrap text-center">
    <a href="{{ route('admin.daftar-pinjam-detail', ['id' => $i]) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold py-1.5 px-3 rounded-md transition duration-150 ease-in-out">
        Detail
    </a>
</td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>

    <div class="px-5 py-4 border-t border-slate-200">
        <div class="flex items-center justify-between text-sm">
            <div class="text-slate-500">
                Showing <span class="font-medium text-slate-600">1</span> to <span class="font-medium text-slate-600">8</span> of <span class="font-medium text-slate-600">8</span> entries
            </div>
            <div class="flex space-x-1">
                <button class="px-3 py-1 border border-slate-200 rounded-md bg-white text-slate-500 hover:bg-slate-50 text-xs">&laquo; Previous</button>
                <button class="px-3 py-1 border border-slate-200 rounded-md bg-white text-slate-500 hover:bg-slate-50 text-xs">Next &raquo;</button>
            </div>
        </div>
    </div>
</div>
@endsection