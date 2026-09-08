<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\JenisSuratController;
use App\Http\Controllers\Api\SuratController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public auth & master data routes
Route::post('/login', [AuthController::class, 'login']);
Route::get('/jenis-surat', [JenisSuratController::class, 'index']);
Route::get('/penerbit-surat', [JenisSuratController::class, 'penerbits']);

// Protected routes (Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Surat & Dashboard
    Route::get('/dashboard/stats', [SuratController::class, 'stats']);
    Route::get('/surat', [SuratController::class, 'index']);
    Route::post('/surat/generate-nomor', [SuratController::class, 'generateNomor']);
    Route::post('/surat', [SuratController::class, 'store']);
    Route::get('/surat/{id}', [SuratController::class, 'show']);
    Route::delete('/surat/{id}', [SuratController::class, 'destroy']);
});

// Fallback direct routes for ease of development & demo access
Route::get('/public/dashboard/stats', [SuratController::class, 'stats']);
Route::get('/public/surat', [SuratController::class, 'index']);
Route::post('/public/surat', [SuratController::class, 'store']);
