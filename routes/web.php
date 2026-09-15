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
    //login
    Route::get('/', [LoginController::class, 'login']);
    Route::get('/login', [LoginController::class, 'login']);
    Route::post('/actionlogin', [LoginController::class, 'actionLogin'])->name('action-login');
    //page
    Route::resource('dashboard', DashboardController::class);
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('products',  ProductController::class);
    Route::resource('transactions',  OrderController::class);
    Route::get('transactions/{transaction}/print', [OrderController::class, 'print'])->name('transactions.print');
});

Route::middleware('auth')->prefix('cashier')->group(function () {
    Route::get('/', [OrderController::class, 'cashier'])->name('cashier.index');
    Route::post('/payment', [OrderController::class, 'store'])->name('cashier.payment');
});

Route::middleware('auth')->prefix('pimpinan')->group(function () {
    Route::get('/', [ReportController::class, 'index'])->name('pimpinan.index');
    Route::get('/stok', [ProductController::class, 'stok'])->name('pimpinan.stok');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
