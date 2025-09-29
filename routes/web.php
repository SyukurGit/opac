<?php

use Illuminate\Support\Facades\Route;
// Cukup import controller satu kali saja
use App\Http\Controllers\Auth\KeycloakController;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman utama
Route::get('/', function () {
    return view('home');
});

// Rute untuk otentikasi Keycloak
Route::get('/login', [KeycloakController::class, 'redirect'])->name('login');
Route::get('/auth/callback', [KeycloakController::class, 'callback']);
Route::get('/logout', [KeycloakController::class, 'logout'])->name('logout');

// Grup rute untuk admin panel
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    // Anda bisa menambahkan rute admin lainnya di sini
});