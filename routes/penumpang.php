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

Route::middleware(['auth', PenumpangOnly::class])->group(function () {
    Route::get('/order/{tanggal}/{id_jadwal}/{id_kelas}', [OrderController::class, 'order'])->name('order');
    Route::delete('/order/{id_pemesanan}', [OrderController::class, 'ordercancel'])->name('order.cancel');
    Route::post('/order-detail', [OrderController::class, 'orderdetail'])->name('order.detail');
    Route::get('/profile/{id}', [NavigationController::class, 'profile'])->name('profile');
    Route::put('/profile/update/{id}', [PenggunaController::class, 'updateprofile'])->name('profile.update');
    Route::put('/profile/updatepassword/{id}', [
        PenggunaController::class,
        'updateprofilepassword'
    ])->name('profile.updatepassword');

    Route::get('/detail-pemesanan/{id_pengguna}/{id_pemesanan}', [
        NavigationController::class,
        'viewDetailPemesananCustomer'
    ])->name('pemesanan.viewDetailCustomer');

    Route::prefix('transaction')->name('transaction.')->group(function () {
        Route::get('/{id_pemesanan}', [TransactionController::class, 'transactionViewCustomer'])->name('viewCustomer');
        Route::put('/', [TransactionController::class, 'transactionUpdateCustomer'])->name('updateCustomer');
        
        Route::delete('/cancel-customer/{id_pemesanan}', [
            TransactionController::class,
            'cancelCustomer'
        ])->name('cancelCustomer');

        Route::get('/transaction-update/{id_transaction}', [
            TransactionController::class,
            'transactionViewCustomerPending'
        ])->name('viewCustomerPending');

        Route::put('/update/{id_transaction}', [
            TransactionController::class,
            'transactionUpdateCustomerPending'
        ])->name('updateCustomerPending');

        Route::put('/refund', [TransactionController::class, 'refundPayment'])->name('refundCustomer');
    });
});