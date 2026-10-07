<?php

use App\Http\Controllers\Financezone\HoldingController;
use App\Http\Controllers\Financezone\PortfolioController;
use App\Http\Controllers\Financezone\SecurityController;
use App\Http\Controllers\Userzone\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('userzone.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/securities', [SecurityController::class, 'index'])->name('security.index');
    Route::get('/securities/create', [SecurityController::class, 'create'])->name('security.create');
    Route::post('/securities', [SecurityController::class, 'store'])->name('security.store');
    Route::get('/securities/{security}/edit', [SecurityController::class, 'edit'])->name('security.edit');
    Route::put('/securities/{security}', [SecurityController::class, 'update'])->name('security.update');
    Route::delete('/securities/{security}', [SecurityController::class, 'destroy'])->name('security.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/portfolios', [PortfolioController::class, 'index'])->name('portfolio.index');
    Route::get('/portfolios/create', [PortfolioController::class, 'create'])->name('portfolio.create');
    Route::post('/portfolios', [PortfolioController::class, 'store'])->name('portfolio.store');
    Route::get('/portfolios/{portfolio}/edit', [PortfolioController::class, 'edit'])->name('portfolio.edit');
    Route::put('/portfolios/{portfolio}', [PortfolioController::class, 'update'])->name('portfolio.update');
    Route::delete('/portfolios/{portfolio}', [PortfolioController::class, 'destroy'])->name('portfolio.destroy');
    Route::get('/portfolios/{portfolio}/holdings', [HoldingController::class, 'index'])->name('holding.index');
});

require __DIR__.'/auth.php';
