<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\KeycloakController;
use App\Http\Controllers\Admin\DashboardController;

// Rute Publik
Route::get('/', function () {
    return view('homePublik');
});

// Rute Otentikasi SSO
Route::get('/auth/redirect', [KeycloakController::class, 'redirect'])->name('auth.redirect');
Route::get('/auth/callback', [KeycloakController::class, 'callback'])->name('auth.callback');
Route::get('/auth/logout', [KeycloakController::class, 'logout'])->name('auth.logout'); // <-- TAMBAHKAN BARIS INI

// Rute Grup Admin
Route::middleware(['auth'])->prefix('admin')->as('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});