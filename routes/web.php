<?php

use App\Http\Controllers\BusController;
use App\Http\Controllers\BusRuteController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HargaController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KursiBusController;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\RuteController;
use App\Http\Controllers\BusKelasController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransactionController;
use App\Http\Middleware\AdminOnly;
use App\Http\Middleware\PenumpangOnly;
use Illuminate\Support\Facades\Route;



Route::get('/', [NavigationController::class, 'home'])->name('home');
Route::get('/aboutus', [NavigationController::class, 'aboutus'])->name('aboutus');
Route::get('/pemesananform', [NavigationController::class, 'pemesananForm'])->name('pemesananForm');
Route::get('/ticket', [NavigationController::class, 'ticket'])->name('ticket');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/registeraction', [AuthController::class, 'register'])->name('registeraction');
Route::post('/loginaction', [AuthController::class, 'login'])->name('loginaction');
ROute::post('/logout', [AuthController::class, 'logout'])->name('logout');

require __DIR__ . '/admin.php';
require __DIR__ . '/penumpang.php';

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});