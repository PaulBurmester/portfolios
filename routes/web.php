<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('userzone.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [App\Http\Controllers\Userzone\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\Userzone\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\Userzone\ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/securities', [App\Http\Controllers\Financezone\SecurityController::class, 'index'])->name('security.index');
    Route::get('/securities/create', [App\Http\Controllers\Financezone\SecurityController::class, 'create'])->name('security.create');
    Route::post('/securities', [App\Http\Controllers\Financezone\SecurityController::class, 'store'])->name('security.store');
    Route::get('/securities/{security}/edit', [App\Http\Controllers\Financezone\SecurityController::class, 'edit'])->name('security.edit');
    Route::put('/securities/{security}', [App\Http\Controllers\Financezone\SecurityController::class, 'update'])->name('security.update');
});

require __DIR__.'/auth.php';
