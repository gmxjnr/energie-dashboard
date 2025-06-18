<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\DashboardController;

// Startpagina: laad dashboard.home via HomeController
Route::get('/', [HomeController::class, 'index'])->name('dashboard.home');

// Andere dashboard pagina's
Route::get('/analyse', [DashboardController::class, 'analyse'])->name('dashboard.analyse');
Route::get('/energiebespaar', [DashboardController::class, 'energiebespaar'])->name('dashboard.energiebespaar');
Route::get('/instellingen', [DashboardController::class, 'instellingen'])->name('dashboard.instellingen');

// Optioneel: extra route voor directe toegang tot /dashboard/home
Route::get('/dashboard/home', [HomeController::class, 'index']);
