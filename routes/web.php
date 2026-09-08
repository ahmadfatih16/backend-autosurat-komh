<?php

use Illuminate\Support\Facades\Route;

// Redirect / atau layani index.html frontend secara langsung
Route::get('/', function () {
    $file = base_path('../frontend-autosurat/index.html');
    if (file_exists($file)) {
        return response()->file($file);
    }
    return view('welcome');
});

Route::get('/login', function () {
    return response()->file(base_path('../frontend-autosurat/index.html'));
})->name('login');

Route::get('/index.html', function () {
    return response()->file(base_path('../frontend-autosurat/index.html'));
});

Route::get('/login.html', function () {
    return response()->file(base_path('../frontend-autosurat/login.html'));
});

Route::get('/dashboard.html', function () {
    return response()->file(base_path('../frontend-autosurat/dashboard.html'));
});

Route::get('/dashboard', function () {
    return response()->file(base_path('../frontend-autosurat/dashboard.html'));
});

// Aset CSS frontend
Route::get('/css/{filename}', function ($filename) {
    $path = base_path("../frontend-autosurat/css/{$filename}");
    if (file_exists($path)) {
        return response()->file($path, ['Content-Type' => 'text/css']);
    }
    abort(404);
});

// Aset JS frontend
Route::get('/js/{filename}', function ($filename) {
    $path = base_path("../frontend-autosurat/js/{$filename}");
    if (file_exists($path)) {
        return response()->file($path, ['Content-Type' => 'application/javascript']);
    }
    abort(404);
});
