<?php

// routes/web.php
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Auth\KeycloakController;

// Home publik
Route::view('/', 'home')->name('home');

// Redirect ke Keycloak (gunakan scope openid+profile+email)
Route::get('/login', [KeycloakController::class, 'redirect'])->name('login');

// Callback dari Keycloak
Route::get('/auth/callback', [KeycloakController::class, 'callback'])->name('kc.callback');

// Dashboard (hanya untuk user login)
Route::middleware('auth')->get('/dashboard', fn() => view('dashboard'))->name('dashboard');

// Logout (app + Keycloak)
Route::get('/logout', [KeycloakController::class, 'logout'])->name('logout');
