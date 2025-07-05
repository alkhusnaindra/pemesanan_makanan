<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

// Halaman awal
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Halaman berdasarkan nomor meja yang dipindai
Route::get('/meja-{nomor_meja}', [OrderController::class, 'showMenu'])->name('order.showMenu');

// Menu
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
Route::get('/menu/{menu}', [MenuController::class, 'show'])->name('menu.detail');

// Keranjang
Route::post('/cart/add/{menuId}', [CartController::class,'addToCart'])->name('cart.add');
Route::post('/cart/update/{menuId}', [CartController::class, 'updateQuantity'])->name('cart.update');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/remove/{menuId}', [CartController::class, 'removeItem'])->name('cart.remove');

// *** Group route yang butuh nomor_meja di session ***
Route::middleware(['check.nomor_meja'])->group(function () {
    
 // Checkout dan Konfirmasi Pembayaran
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    
    
    // Untuk pemesanan offline
    Route::post('/order-offline', [OrderController::class, 'checkoutOffline'])->name('checkout.offline');
    Route::get('/order-offline', [OrderController::class, 'showOrderOffline'])->name('order.offline');
});

// Halaman konfirmasi pembayaran
Route::get('/payment/confirm', [PaymentController::class, 'show'])->name('payment.confirm');

// Submit metode pembayaran
Route::post('/payment/submit', [PaymentController::class, 'submit'])->name('payment.submit');

// Halaman pembayaran via kasir
Route::get('/payment/cashier', function () {
    return view('payment.cashier');
})->name('payment.cashier');

// Submit selesai dari pembayaran kasir
Route::post('/payment/finish', function () {
    // Bersihkan session setelah selesai bayar
    session()->forget(['cart', 'catatan', 'metode_pembayaran']);
    return redirect()->route('payment.success')->with('success', 'Pembayaran selesai.');
})->name('payment.finish');

// Tampilan setelah pembayaran berhasil atau pending
Route::get('/payment-success', function () {
    return view('order.success');
})->name('payment.success');

Route::get('/payment-pending', function () {
    return view('order.pending');
})->name('payment.pending');


Route::get('/payment-failed', function () {
    return view('order.failed');
})->name('payment.failed');

