<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::get('/', [LoginController::class, 'login']);
    Route::get('/login', [LoginController::class, 'login']);
    Route::post('/actionlogin', [LoginController::class, 'actionLogin'])->name('action-login');
    Route::resource('dashboard', DashboardController::class);
});
