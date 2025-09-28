<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\KeycloakController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () {
    return view('home');
});

Route::get('/login', [KeycloakController::class, 'redirect'])->name('login');
Route::get('/auth/callback', [KeycloakController::class, 'callback']);
Route::get('/logout', [KeycloakController::class, 'logout'])->name('logout');

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});