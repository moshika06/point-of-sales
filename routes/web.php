<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('login');
});

Route::prefix('admin')->group(function () {
    Route::get('/', [LoginController::class, 'login']);
    Route::get('/login', [LoginController::class, 'login']);
    Route::post('/actionlogin', [LoginController::class, 'actionLogin'])->name('action-login');
    Route::resource('dashboard', DashboardController::class);
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('products', ProductController::class);
    Route::resource('transactions', OrderController::class);
    Route::resource('reports', ReportController::class);
});
Route::middleware('auth')->group(function () {
    //     Route::resource('menu', MenuController::class);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
