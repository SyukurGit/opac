<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\KeycloakController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DaftarPinjamController; // <-- Tambahkan ini



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman utama
Route::get('/', function () {
    return view('home');
})->name('home'); 



Route::get('/debug-session', function () {
    return [
        'auth'    => Auth::check(),
        'user'    => Auth::user(),
        'session' => session()->all(),
    ];
});


// Rute untuk otentikasi Keycloak
Route::get('/login', [KeycloakController::class, 'redirect'])->name('login');
Route::get('/auth/callback', [KeycloakController::class, 'callback']);
Route::get('/logout', [KeycloakController::class, 'logout'])->name('logout');


// Grup rute untuk admin panel
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/daftar-denda', [DaftarPinjamController::class, 'index'])->name('admin.daftar-pinjam');
        Route::get('/daftar-denda-detail/{id}', [DaftarPinjamController::class, 'show'])->name('admin.daftar-pinjam-detail');
Route::post('/checkout', [DaftarPinjamController::class, 'checkout'])->name('admin.checkout');
    // Anda bisa menambahkan rute admin lainnya di sini
});