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
        Route::get('/historico', [App\Http\Controllers\admin\BalanceController::class, 'historico'])->name('historico');

        Route::get('/balance/deposito', [App\Http\Controllers\admin\BalanceController::class, 'deposito'])->name('balance.deposito');
        Route::post('/balance/deposito', [App\Http\Controllers\admin\BalanceController::class, 'store'])->name('balance.deposito.store');

        Route::get('/balance/saque', [App\Http\Controllers\admin\BalanceController::class, 'saque'])->name('balance.saque');
        Route::post('/balance/saque', [App\Http\Controllers\admin\BalanceController::class, 'retirar'])->name('balance.deposito.retirar');
        
        Route::get('/balance/transferir', [App\Http\Controllers\admin\BalanceController::class, 'transferir'])->name('balance.transferir');
        Route::post('/balance/transferir', [App\Http\Controllers\admin\BalanceController::class, 'enviar'])->name('balance.deposito.transferir');
        Route::post('/balance/transferir/confirmar', [App\Http\Controllers\admin\BalanceController::class, 'EnviarConfirmar'])->name('balance.deposito.transferir.store');
      
       
       
       
        
        
        });
    });
