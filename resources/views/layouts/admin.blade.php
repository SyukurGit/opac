<!DOCTYPE html>
<html lang="id">
<head>
    {{-- ... bagian head tetap sama ... --}}
</head>
<body class="h-full font-sans antialiased">
    <div x-data="{ sidebarOpen: true }" class="flex h-screen bg-gray-100">
        {{-- Panggil Sidebar --}}
        @include('layouts.partials.sidebar')

        <div class="flex-1 flex flex-col overflow-hidden">
            {{-- Panggil Header --}}
            @include('layouts.partials.header')

            {{-- Konten Utama --}}
            <main class="flex-1 overflow-y-auto p-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">
                    @yield('header')
                </h2>
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>