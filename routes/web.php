<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

<<<<<<< Updated upstream
Route::get('/', [DashboardController::class, 'home'])->name('dashboard.home');
Route::get('/analyse', [DashboardController::class, 'analyse'])->name('dashboard.analyse');
Route::get('/energiebespaar', [DashboardController::class, 'energiebespaar'])->name('dashboard.energiebespaar');
Route::get('/instellingen', [DashboardController::class, 'instellingen'])->name('dashboard.instellingen');
=======
Route::get('/', function () {
    return view('dashboard');
});

<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
