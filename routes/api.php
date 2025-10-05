<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\CirculationController;
use App\Http\Controllers\Api\V1\PembayaranController; // <-- IMPORT CONTROLLER BARU

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('v1')->group(function () {
    Route::apiResource('peminjaman', CirculationController::class)->only(['index', 'show']);

    // RUTE BARU UNTUK PROSES PEMBAYARAN
    Route::post('pembayaran', [PembayaranController::class, 'processPayment']);
});