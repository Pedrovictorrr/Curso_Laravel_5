<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\SiteController::class, 'index'])->name('index');

Auth::routes();

Route::prefix('admin')->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('/', [App\Http\Controllers\admin\AdminController::class, 'index'])->name('admin');
        Route::get('/balance', [App\Http\Controllers\admin\BalanceController::class, 'index'])->name('balance');
        Route::get('/balance/deposito', [App\Http\Controllers\admin\BalanceController::class, 'deposito'])->name('balance.deposito');
        Route::post('/balance/deposito', [App\Http\Controllers\admin\BalanceController::class, 'store'])->name('balance.deposito.store');
        });
    });
