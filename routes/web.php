<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\KeycloakController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DaftarPinjamController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PenggunaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman utama
Route::get('/', function () {
    return view('home');
})->name('home');

// Rute untuk otentikasi Keycloak
Route::get('/login', [KeycloakController::class, 'redirect'])->name('login');
Route::get('/auth/callback', [KeycloakController::class, 'callback']);
Route::get('/logout', [KeycloakController::class, 'logout'])->name('logout');

// Grup rute untuk admin panel
// Semua rute di dalam grup ini akan memiliki prefix /admin dan memerlukan autentikasi
Route::middleware('auth')->prefix('admin')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');

    // Daftar Pinjam / Denda
    Route::get('/daftar-denda', [DaftarPinjamController::class, 'index'])->name('admin.daftar_denda.index');
Route::get('/daftar-denda-detail/{peminjaman}', [DaftarPinjamController::class, 'show'])->name('admin.daftar_denda.detail');
    // Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('admin.laporan.index');

    // Pengguna
    Route::get('/admin', [PenggunaController::class, 'index'])->name('admin.pengguna.index');
    Route::get('/admin/{user}/log', [PenggunaController::class, 'showLog'])->name('admin.pengguna.log');

    // --- RUTE CHECKOUT DIPINDAHKAN KE SINI ---
    // Rute ini akan menangani pemilihan item untuk checkout dari halaman daftar-denda
    // URL: /admin/checkout/select, Metode: POST
    Route::post('/checkout/select', [DaftarPinjamController::class, 'selectForCheckout'])->name('admin.checkout.select');
    
    // Rute ini akan menampilkan halaman detail item yang akan di-checkout
    // URL: /admin/checkout/detail, Metode: GET
    Route::get('/checkout/detail', [DaftarPinjamController::class, 'showCheckout'])->name('admin.checkout.detail');

    // Rute ini yang akan memproses pembayaran dari form
    // URL: /admin/checkout, Metode: POST
    Route::post('/checkout', [DaftarPinjamController::class, 'processCheckout'])->name('admin.checkout.process');
});
