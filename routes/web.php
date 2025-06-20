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
    // Login routes
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login'); // Laravel verwacht 'login'
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

    // Register routes
    Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register.show');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
});

/*
|--------------------------------------------------------------------------
| Beveiligde routes (alleen toegankelijk als je WEL bent ingelogd)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Dashboard en subpagina's
    Route::get('/', [HomeController::class, 'index'])->name('dashboard.home');
    Route::get('/analyse', [DashboardController::class, 'analyse'])->name('dashboard.analyse');
    Route::get('/energiebespaar', [DashboardController::class, 'energiebespaar'])->name('dashboard.energiebespaar');
    Route::get('/instellingen', [DashboardController::class, 'instellingen'])->name('dashboard.instellingen');
    Route::get('/inzicht/{periode}', [DashboardController::class, 'inzichtData']);
    Route::get('/dashboard/home', [HomeController::class, 'index']);

    // API
    Route::get('/api/progress', [ProgressController::class, 'get']);

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});
