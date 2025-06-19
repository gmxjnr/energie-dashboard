<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SettingsController;

// AUTH ROUTES
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// DASHBOARD EN INSTELLINGEN (alleen voor ingelogde gebruikers)
Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard.home');
    Route::get('/analyse', [DashboardController::class, 'analyse'])->name('dashboard.analyse');
    Route::get('/energiebespaar', [DashboardController::class, 'energiebespaar'])->name('dashboard.energiebespaar');

    // Instellingen routes
    Route::get('/instellingen', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::post('/instellingen', [SettingsController::class, 'update'])->name('settings.update');
});
