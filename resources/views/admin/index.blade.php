<!DOCTYPE html>
<html lang="id" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Sistem Denda Perpustakaan</title>

    {{-- Memuat Aset dari Vite (CSS & JS) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Memuat Alpine.js untuk Interaktivitas --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.10/dist/cdn.min.js"></script>

    <style>
        /* Transisi halus untuk sidebar dan konten utama */
        .sidebar-transition { transition: width 0.3s ease-in-out, transform 0.3s ease-in-out; }
        .content-transition { transition: margin-left 0.3s ease-in-out; }
    </style>
</head>
<body class="h-full font-sans antialiased">
    <div 
        x-data="{ 
            isSidebarOpen: window.innerWidth > 768 ? true : false, 
            isUserMenuOpen: false 
        }" 
        x-init="$watch('isSidebarOpen', value => {
            if (window.innerWidth <= 768) return;
            localStorage.setItem('sidebarOpen', value);
        }); 
        if (window.innerWidth > 768) {
            isSidebarOpen = localStorage.getItem('sidebarOpen') === 'true';
        }"
        class="relative min-h-screen md:flex"
    >
        {{-- Sidebar --}}
        <aside 
            :class="{ 
                'translate-x-0': isSidebarOpen && window.innerWidth <= 768, 
                '-translate-x-full': !isSidebarOpen && window.innerWidth <= 768,
                'w-64': isSidebarOpen && window.innerWidth > 768,
                'w-20': !isSidebarOpen && window.innerWidth > 768
            }"
            class="fixed inset-y-0 left-0 z-30 flex flex-col text-white bg-gray-900 shadow-lg sidebar-transition md:translate-x-0"
        >
            <div class="flex items-center justify-center h-16 px-4 bg-gray-800 border-b border-gray-700 shrink-0">
                <a href="{{ route('admin.dashboard') }}">
                    <span x-show="isSidebarOpen" class="text-xl font-bold text-white">Admin Denda</span>
                    <span x-show="!isSidebarOpen" class="font-bold text-white">AD</span>
                </a>
            </div>

            <nav class="flex-1 px-4 py-4 space-y-2 overflow-y-auto">
                {{-- Daftar Menu --}}
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center px-4 py-2.5 rounded-lg hover:bg-gray-700 transition-colors duration-200 
                          {{ request()->routeIs('admin.dashboard') ? 'bg-red-600' : '' }}"
                   :title="isSidebarOpen ? '' : 'Dashboard'">
                    {{-- Ikon Dashboard (SVG) --}}
                    <svg class="w-6 h-6 shrink-0" :class="{ 'mr-3': isSidebarOpen }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h7.5" />
                    </svg>
                    <span x-show="isSidebarOpen" class="flex-1">Dashboard</span>
                </a>

                <a href="#" {{-- Ganti dengan route Anda nanti --}}
                   class="flex items-center px-4 py-2.5 rounded-lg hover:bg-gray-700 transition-colors duration-200"
                   :title="isSidebarOpen ? '' : 'Daftar Denda'">
                    {{-- Ikon Daftar (SVG) --}}
                     <svg class="w-6 h-6 shrink-0" :class="{ 'mr-3': isSidebarOpen }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z" />
                    </svg>
                    <span x-show="isSidebarOpen" class="flex-1">Daftar Denda</span>
                </a>
            </nav>
        </aside>

        {{-- Backdrop untuk mobile (saat sidebar terbuka) --}}
        <div x-show="isSidebarOpen && window.innerWidth <= 768" class="fixed inset-0 z-20 bg-black bg-opacity-50" @click="isSidebarOpen = false" style="display: none;"></div>

        {{-- Content Area --}}
        <div class="flex flex-col flex-1 content-transition" 
             :class="{ 'md:ml-64': isSidebarOpen, 'md:ml-20': !isSidebarOpen }">
            
            {{-- Header --}}
            <header class="sticky top-0 z-10 flex items-center justify-between h-16 px-4 bg-white shadow-sm shrink-0 md:px-6">
                <div class="flex items-center gap-4">
                    {{-- Tombol Toggle Sidebar dengan Ikon SVG --}}
                    <button @click="isSidebarOpen = !isSidebarOpen" class="text-gray-600 hover:text-red-600 focus:outline-none">
                        <span class="sr-only">Buka/Tutup Sidebar</span>
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                    <h1 class="text-xl font-semibold text-gray-800 md:text-2xl">@yield('header', 'Dashboard')</h1>
                </div>

                {{-- Menu User --}}
                <div class="relative">
                    <button @click="isUserMenuOpen = !isUserMenuOpen" class="flex items-center space-x-2">
                        <span class="hidden font-medium text-gray-700 md:inline">{{ Auth::user()->name }}</span>
                        <div class="flex items-center justify-center w-9 h-9 font-bold text-white bg-red-600 rounded-full">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    </button>
                    <div x-show="isUserMenuOpen" @click.away="isUserMenuOpen = false" x-transition class="absolute right-0 z-20 w-48 py-1 mt-2 bg-white rounded-md shadow-lg" style="display: none;">
                        <a href="{{ url('/') }}" target="_blank" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Lihat Halaman Publik</a>
                        <div class="border-t border-gray-100"></div>
                        <a href="{{ route('auth.logout') }}" class="block w-full px-4 py-2 text-sm font-semibold text-left text-red-600 hover:bg-gray-100">
                            Logout
                        </a>
                    </div>
                </div>
            </header>

            {{-- Main Content --}}
            <main class="flex-1 p-4 md:p-8">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>