<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8" />
    <title>Dashboard | opac</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    @vite('resources/css/app.css')

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            animation: {
              'fade-in': 'fadeIn 0.6s ease-out',
              'slide-up': 'slideUp 0.6s ease-out',
              'slide-in-left': 'slideInLeft 0.6s ease-out',
              'slide-in-right': 'slideInRight 0.6s ease-out',
              float: 'float 6s ease-in-out infinite',
              'pulse-slow': 'pulse 3s ease-in-out infinite'
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
              slideInLeft: {
                '0%': { opacity: '0', transform: 'translateX(-20px)' },
                '100%': { opacity: '1', transform: 'translateX(0)' }
              },
              slideInRight: {
                '0%': { opacity: '0', transform: 'translateX(20px)' },
                '100%': { opacity: '1', transform: 'translateX(0)' }
              },
              float: {
                '0%, 100%': { transform: 'translateY(0px)' },
                '50%': { transform: 'translateY(-10px)' }
              }
            }
          }
        }
      };
    </script>
  </head>

  <body class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 font-sans">
    <!-- Animated background elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
      <div class="absolute -top-40 -right-40 w-80 h-80 bg-purple-500 rounded-full mix-blend-multiply blur-xl opacity-20 animate-float"></div>
      <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-blue-500 rounded-full mix-blend-multiply blur-xl opacity-20 animate-float" style="animation-delay: 2s;"></div>
      <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-teal-500 rounded-full mix-blend-multiply blur-xl opacity-20 animate-float" style="animation-delay: 4s;"></div>
    </div>

    <!-- Navigation bar -->
    <nav class="relative z-10 p-6 animate-fade-in">
      <div class="mx-auto flex max-w-7xl items-center justify-between">
        <div class="flex items-center space-x-4">
          <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-gradient-to-r from-purple-500 to-blue-500 shadow-lg">
            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
          </div>
          <h1 class="text-2xl font-bold text-white">OPAC Dashboard</h1>
        </div>

        <div class="flex items-center space-x-4">
          <a href="{{ route('home') }}" class="flex items-center space-x-2 rounded-lg px-4 py-2 text-white/70 transition-colors duration-200 hover:bg-white/10 hover:text-white">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m0 0v-3a1 1 0 011-1h2a1 1 0 011 1v3m4 0a1 1 0 001-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 001 1h4z" />
            </svg>
            <span>Home</span>
          </a>

          <a href="{{ route('logout') }}" class="flex items-center space-x-2 rounded-lg border border-red-500/30 px-4 py-2 text-red-300 transition-colors duration-200 hover:border-red-400/50 hover:bg-red-500/20 hover:text-red-200">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            <span>Logout</span>
          </a>
        </div>
      </div>
    </nav>

    <!-- Main content -->
    <main class="relative z-10 mx-auto max-w-7xl px-6 py-8">
      <!-- Welcome section -->
      <section class="mb-8 animate-slide-up" style="animation-delay: 0.1s;">
        <div class="rounded-2xl border border-white/20 bg-white/10 p-8 shadow-2xl backdrop-blur-lg">
          <!-- Status indicator -->
          <div class="mb-6 flex items-center">
            <div class="flex items-center space-x-3">
              <span class="h-3 w-3 animate-pulse-slow rounded-full bg-green-400"></span>
              <span class="text-sm font-medium text-green-300">Status: Terhubung</span>
            </div>
          </div>

          <!-- Welcome message -->
          <div class="flex items-start space-x-4">
            <div class="flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-r from-green-500 to-teal-500 shadow-lg">
              <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
            </div>

            <div class="flex-1">
              <h2 class="mb-2 text-3xl font-bold text-white">Selamat datang!</h2>
              <p class="mb-1 text-xl text-white/90">
                Halo, <span class="font-semibold text-blue-300">{{ auth()->user()->name }}  </span>
              </p>


              <p class="flex items-center text-white/60"> Nim :
                {{ auth()->user()->username }}
              </p>

              <p class="flex items-center text-white/60">
                <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                {{ auth()->user()->email }}
              </p>

               <p class="flex items-center text-white/60"> Role : -
              </p>

               


            </div>
          </div>
        </div>
      </section>

      <!-- Quick actions grid -->
      <section class="mb-8 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        <!-- Search books -->
        <div class="cursor-pointer rounded-xl border border-white/20 bg-white/10 p-6 shadow-xl backdrop-blur-lg transition-all duration-300 hover:bg-white/15 animate-slide-in-left" style="animation-delay: 0.2s;">
          <div class="flex items-center space-x-4">
            <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-gradient-to-r from-blue-500 to-cyan-500">
              <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
            </div>
            <div>
              <h3 class="font-semibold text-white">Pencarian Buku</h3>
              <p class="text-sm text-white/60">Cari koleksi perpustakaan</p>
            </div>
          </div>
        </div>

        <!-- My borrowed books -->
        <div class="cursor-pointer rounded-xl border border-white/20 bg-white/10 p-6 shadow-xl backdrop-blur-lg transition-all duration-300 hover:bg-white/15 animate-slide-up" style="animation-delay: 0.3s;">
          <div class="flex items-center space-x-4">
            <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-gradient-to-r from-purple-500 to-pink-500">
              <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
              </svg>
            </div>
            <div>
              <h3 class="font-semibold text-white">Buku Dipinjam</h3>
              <p class="text-sm text-white/60">Kelola peminjaman Anda</p>
            </div>
          </div>
        </div>

        <!-- History -->
        <div class="cursor-pointer rounded-xl border border-white/20 bg-white/10 p-6 shadow-xl backdrop-blur-lg transition-all duration-300 hover:bg-white/15 animate-slide-in-right" style="animation-delay: 0.4s;">
          <div class="flex items-center space-x-4">
            <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-gradient-to-r from-orange-500 to-red-500">
              <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <div>
              <h3 class="font-semibold text-white">Riwayat</h3>
              <p class="text-sm text-white/60">Lihat aktivitas terkini</p>
            </div>
          </div>
        </div>
      </section>

      <!-- Recent activity -->
      <section class="animate-slide-up" style="animation-delay: 0.5s;">
        <div class="rounded-2xl border border-white/20 bg-white/10 p-8 shadow-2xl backdrop-blur-lg">
          <div class="mb-6 flex items-center justify-between">
            <h3 class="text-xl font-bold text-white">Aktivitas Terkini</h3>
            <div class="text-sm text-white/50">
              <svg class="mr-1 inline h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              Terakhir diperbarui: Hari ini
            </div>
          </div>

          <div class="space-y-4">
            <div class="flex items-center space-x-4 rounded-lg border border-white/10 bg-white/5 p-4">
              <span class="h-2 w-2 rounded-full bg-green-400"></span>
              <div class="flex-1">
                <p class="text-white/90">Login berhasil ke sistem</p>
                <p class="text-sm text-white/50">Beberapa detik yang lalu</p>
              </div>
            </div>

            <div class="py-8 text-center">
              <svg class="mx-auto mb-3 h-12 w-12 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
              </svg>
              <p class="text-white/50">Belum ada aktivitas lainnya</p>
              <p class="mt-1 text-sm text-white/30">Mulai jelajahi katalog untuk melihat lebih banyak aktivitas</p>
            </div>
          </div>
        </div>
      </section>
    </main>

    <!-- Footer -->
    <footer class="relative z-10 mt-16 pb-8">
      <div class="mx-auto max-w-7xl px-6 text-center">
        <p class="animate-fade-in text-sm text-white/40" style="animation-delay: 0.6s;">
          © 2025 OPAC - Online Public Access Catalog. Sistem Manajemen Perpustakaan Digital.
        </p>
      </div>
    </footer>
  </body>
</html>



