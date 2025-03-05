<?php

use App\Http\Controllers\BusController;
use App\Http\Controllers\BusRuteController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HargaController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KursiBusController;
use App\Http\Controllers\KursiPlaneController;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PlaneController;
use App\Http\Controllers\PlaneRuteController;
use App\Http\Controllers\RuteController;
use App\Http\Controllers\BusKelasController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransactionController;
use App\Http\Middleware\AdminOnly;
use App\Http\Middleware\PenumpangOnly;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', AdminOnly::class])->group(function () {
    Route::get('/dashboard', [NavigationController::class, 'dashboard'])->name('dashboard');
    Route::resource('pengguna', PenggunaController::class);
    Route::resource('plane', PlaneController::class);
    Route::resource('kelas', KelasController::class);
    Route::resource('rute', RuteController::class);
    Route::resource('harga', HargaController::class);
    Route::resource('planerute', PlaneRuteController::class);
    Route::resource('kursiplane', KursiPlaneController::class);
    Route::resource('jadwal', JadwalController::class);
    Route::resource('pemesanan', PemesananController::class);

    Route::prefix('transaction')->name('transaction.')->group(function () {
        Route::get('/', [TransactionController::class, 'index'])->name('index');
        Route::get('/create/{id_pemesanan}/{id_pengguna}', [TransactionController::class, 'create'])->name('create');
        Route::put('/store', [TransactionController::class, 'store'])->name('store');
        Route::delete('/destroy/{id_pemesanan}', [TransactionController::class, 'destroy'])->name('destroy');
        Route::delete('/cancel/{id_pemesanan}', [TransactionController::class, 'cancelAdmin'])->name('cancelAdmin');
        Route::put('/confirm/{id_transaction}', [TransactionController::class, 'confirm'])->name('confirm');
        Route::put('/refundadmin', [TransactionController::class, 'refundPaymentAdmin'])->name('refundAdmin');
    });
    Route::prefix('detailpemesanan')->name('detailpemesanan.')->group(function () {
        Route::get('/{id}', [PemesananController::class, 'detail'])->name('list');
        Route::post('/', [PemesananController::class, 'storedetail'])->name('store');
        Route::get('/edit/{id}', [PemesananController::class, 'editdetailform'])->name('edit');
        Route::put('/update/{id}', [PemesananController::class, 'updatedetail'])->name('update');
        Route::delete('/delete/{id}', [PemesananController::class, 'destroydetail'])->name('destroy');
        Route::get('/addnew/{id_pemesanan}/{id_kelas}/{tanggal}', [PemesananController::class, 'addnew'])->name('addnew');
        Route::post('/addnew', [PemesananController::class, 'storedetailnew'])->name('storenew');
    });

    Route::delete('/pemesanan/cancel/{id}', [PemesananController::class, 'cancel'])->name('pemesanan.cancel');
    Route::put('/pemesanan/confirm/{id}', [PemesananController::class, 'confirm'])->name('pemesanan.confirm');
});