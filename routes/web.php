<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Gastenroutes (alleen zichtbaar als je NIET bent ingelogd)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

    // Register
    Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register.show');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
});

/*
|--------------------------------------------------------------------------
| Beveiligde routes (alleen toegankelijk als je WEL bent ingelogd)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Navigatie items
    Route::get('/', [HomeController::class, 'index'])->name('dashboard.home');
    Route::get('/analyse', [DashboardController::class, 'analyse'])->name('dashboard.analyse');
    Route::get('/energiebespaar', [DashboardController::class, 'energiebespaar'])->name('dashboard.energiebespaar');
    Route::get('/instellingen', [DashboardController::class, 'instellingen'])->name('dashboard.instellingen');

    // Data ophalen
    Route::get('/inzicht/{periode}', [DashboardController::class, 'inzichtData']);

    // API
    Route::get('/api/progress', [ProgressController::class, 'get']);

    // Home fallback
    Route::get('/dashboard/home', [HomeController::class, 'index']);

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});
  