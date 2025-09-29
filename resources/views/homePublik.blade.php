<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Denda Perpustakaan</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="bg-gradient-to-br from-gray-50 to-gray-200 min-h-screen flex items-center justify-center">
        <div class="relative w-full max-w-md p-8 m-4 bg-white shadow-2xl rounded-2xl">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-gray-800">Manajemen Denda Perpustakaan</h1>
                <p class="mt-2 text-gray-500">Sistem terintegrasi untukelola denda keterlambatan.</p>
            </div>
            
            <div class="mt-8">
                <p class="text-sm text-center text-gray-600">
                    Selamat datang, Admin. Silakan masuk untuk melanjutkan ke dasbor pengelolaan.
                </p>
            </div>

            <div class="mt-6 flex justify-center">
                <a href="{{ url('/auth/redirect') }}" class="w-full inline-flex items-center justify-center px-6 py-3 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-transform transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" />
                    </svg>
                    Login dengan SSO
                </a>
            </div>

            <footer class="mt-12 text-center">
                <p class="text-xs text-gray-400">&copy; {{ date('Y') }} Universitas. All rights reserved.</p>
            </footer>
        </div>
    </div>
</body>
</html>