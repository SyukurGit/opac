<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Home | opac</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')

  <script src="https://cdn.tailwindcss.com"></script>
  
  <script>
    tailwind.config = {
      theme: {
        extend: {
          animation: {
            'fade-in': 'fadeIn 0.6s ease-out',
            'slide-up': 'slideUp 0.6s ease-out',
            'float': 'float 6s ease-in-out infinite',
          },
          keyframes: {
            fadeIn: {
              '0%': { opacity: '0' },
              '100%': { opacity: '1' }
            },
            slideUp: {
              '0%': { opacity: '0', transform: 'translateY(20px)' },
              '100%': { opacity: '1', transform: 'translateY(0)' }
            },
            float: {
              '0%, 100%': { transform: 'translateY(0px)' },
              '50%': { transform: 'translateY(-10px)' }
            }
          }
        }
      }
    }
  </script>
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 font-sans">
  <!-- Animated background elements -->
  <div class="fixed inset-0 overflow-hidden pointer-events-none">
    <div class="absolute -top-40 -right-40 w-80 h-80 bg-purple-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float"></div>
    <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-blue-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float" style="animation-delay: 2s;"></div>
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-teal-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float" style="animation-delay: 4s;"></div>
  </div>

  <!-- Main content -->
  <div class="relative z-10 flex items-center justify-center min-h-screen px-4">
    <div class="max-w-md w-full">
      <!-- Welcome card -->
      <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-8 shadow-2xl border border-white/20 animate-slide-up">
        <!-- Header -->
        <div class="text-center mb-8">
          <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-blue-500 rounded-full mx-auto mb-4 flex items-center justify-center shadow-lg">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
          </div>
          <h1 class="text-3xl font-bold text-white mb-2 animate-fade-in">
            Selamat datang di Sistem Pembayaran Denda
          </h1>
          <p class="text-white/70 animate-fade-in" style="animation-delay: 0.2s;">
            OPAC - Ar-Raniry
          </p>
        </div>

        <!-- Error message -->
        @if(session('error'))
          <div class="bg-red-500/20 border border-red-500/30 text-red-200 px-4 py-3 rounded-lg mb-6 backdrop-blur-sm animate-slide-up" style="animation-delay: 0.3s;">
            <div class="flex items-center">
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
              {{ session('error') }}
            </div>
          </div>
        @endif

        <!-- Auth section -->
        <div class="space-y-4 animate-slide-up" style="animation-delay: 0.4s;">
          @auth
            <!-- Logged in state -->
            <div class="bg-green-500/20 border border-green-500/30 rounded-lg p-4 backdrop-blur-sm">
              <div class="flex items-center mb-3">
                <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center mr-3">
                  <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                  </svg>
                </div>
                <div>
                  <p class="text-green-200 text-sm">Anda sudah login sebagai</p>
                  <p class="text-white font-semibold">{{ auth()->user()->name }}</p>
                </div>
              </div>
              
              <div class="flex gap-3">
                <a href="{{ route('dashboard') }}" 
                   class="flex-1 bg-gradient-to-r from-blue-500 to-purple-600 text-white px-4 py-2.5 rounded-lg font-medium text-center hover:from-blue-600 hover:to-purple-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                  <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                  </svg>
                  Dashboard
                </a>
                <a href="{{ route('logout') }}" 
                   class="px-4 py-2.5 rounded-lg font-medium text-white border border-white/30 hover:bg-white/10 transition-all duration-200 hover:scale-105">
                  <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                  </svg>
                  Logout
                </a>
              </div>
            </div>
          @else
            <!-- Login state -->
            <div class="text-center">
              <a href="{{ route('login') }}" 
                 class="inline-flex items-center justify-center w-full bg-gradient-to-r from-purple-600 to-blue-600 text-white px-6 py-4 rounded-xl font-semibold text-lg hover:from-purple-700 hover:to-blue-700 transform hover:scale-105 transition-all duration-300 shadow-2xl hover:shadow-purple-500/25 group">
                <svg class="w-5 h-5 mr-3 group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                </svg>
                Login dengan Keycloak
                <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </a>
              
              <p class="text-white/50 text-sm mt-4">
                Login untuk akses lengkap
              </p>
            </div>
          @endauth
        </div>

        <!-- Footer info -->
        <div class="mt-8 pt-6 border-t border-white/10 text-center animate-fade-in" style="animation-delay: 0.6s;">
          <p class="text-white/40 text-xs">
            Sistem Manajemen Perpustakaan Uin Ar-Raniry
          </p>
        </div>
      </div>
    </div>
  </div>
</body>
</html>