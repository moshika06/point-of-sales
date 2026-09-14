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
    // Transaction
    Route::get('transactions/{transaction}/print', [OrderController::class, 'print'])->name('transactions.print');
    Route::resource('transactions', OrderController::class);
});
Route::middleware('auth')->group(function () {
    //Route::resource('menu', MenuController::class);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::middleware('auth')->prefix('cashier')->group(function () {
    Route::get('/', [OrderController::class, 'cashier'])->name('cashier.index');
    Route::post('/payment', [OrderController::class, 'store'])->name('cashier.payment');
});

Route::middleware('auth')->prefix('pimpinan')->group(function () {
    // Halaman utama pimpinan = laporan
    Route::get('/', [ReportController::class, 'index'])
        ->name('pimpinan.index');
    // Halaman stok produk
    Route::get('/stok', [ProductController::class, 'stok'])
        ->name('pimpinan.stok');
});
