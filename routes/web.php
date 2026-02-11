<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware('guest')->group(function () {
    Route::get('/', [LoginController::class, 'index']);
    Route::post('/login-proses', [LoginController::class, 'login_proses']);
});

Route::middleware('auth')->group(function () {

    Route::get('/logout', [LoginController::class, 'logout']);

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/petugas', [UserController::class, 'index']);
    Route::post('/petugas/insert', [UserController::class, 'insert']);
    Route::put('/petugas/update/{id}', [UserController::class, 'update']);
    Route::get('/petugas/delete/{id}', [UserController::class, 'delete']);

    Route::get('/service', [ServiceController::class, 'index']);
    Route::post('/service/insert', [ServiceController::class, 'insert']);
    Route::put('/service/update/{id}', [ServiceController::class, 'update']);
    Route::get('/service/delete/{id}', [ServiceController::class, 'delete']);

    Route::get('/transaksi', [TransaksiController::class, 'index']);
    Route::post('/transaksi/insert', [TransaksiController::class, 'insert']);
    Route::get('/transaksi/print/{id}', [TransaksiController::class, 'print']);
});
