<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataTrainingController;
use App\Http\Controllers\NaiveBayesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Semua route aplikasi web didefinisikan di sini
|--------------------------------------------------------------------------
*/

// =======================
// AUTH LOGIN (TANPA MIDDLEWARE)
// =======================
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

// =======================
// HALAMAN AWAL
// =======================
Route::get('/', function () {
    return redirect('/training');
});

// =======================
// ROUTE YANG WAJIB LOGIN
// =======================
Route::middleware(['authcheck'])->group(function () {

    // =======================
    // CRUD DATA TRAINING
    // =======================
    Route::get('/training', [DataTrainingController::class, 'index'])
        ->name('training.index');

    Route::get('/training/create', [DataTrainingController::class, 'create'])
        ->name('training.create');

    Route::post('/training', [DataTrainingController::class, 'store'])
        ->name('training.store');

    Route::get('/training/{id}/edit', [DataTrainingController::class, 'edit'])
        ->name('training.edit');

    Route::put('/training/{id}', [DataTrainingController::class, 'update'])
        ->name('training.update');

    Route::delete('/training/{id}', [DataTrainingController::class, 'destroy'])
        ->name('training.destroy');

    // =======================
    // KLASIFIKASI BEASISWA
    // =======================
    Route::get('/klasifikasi', [NaiveBayesController::class, 'index'])
        ->name('klasifikasi.index');

    Route::post('/klasifikasi', [NaiveBayesController::class, 'process'])
        ->name('klasifikasi.process');
});
