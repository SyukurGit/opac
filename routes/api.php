<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\CirculationController;

// Definisikan rute API kita di sini
Route::get('/v1/peminjaman', [CirculationController::class, 'index']);