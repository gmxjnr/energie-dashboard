<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProgressController;

// Startpagina: laad dashboard.home via HomeController
Route::get('/', [HomeController::class, 'index'])->name('dashboard.home');

// Andere dashboard pagina's
Route::get('/analyse', [DashboardController::class, 'analyse'])->name('dashboard.analyse');
Route::get('/energiebespaar', [DashboardController::class, 'energiebespaar'])->name('dashboard.energiebespaar');
Route::get('/instellingen', [DashboardController::class, 'instellingen'])->name('dashboard.instellingen');
Route::get('/inzicht/{periode}', [App\Http\Controllers\DashboardController::class, 'inzichtData']);
Route::get('/api/progress', [ProgressController::class, 'get']);


// Optioneel: extra route voor directe toegang tot /dashboard/home
Route::get('/dashboard/home', [HomeController::class, 'index']);
