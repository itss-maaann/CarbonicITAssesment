<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::group(['prefix' => 'payment'], function () {
    Route::get('/{order}/{gateway}', [PaymentController::class, 'showPaymentForm'])->name('payment.form');
    Route::post('/create', [PaymentController::class, 'createPayment'])->name('payment.process');
    Route::post('/confirm', [PaymentController::class, 'confirmPayment'])->name('payment.confirm');
    Route::post('/refund', [PaymentController::class, 'processRefund'])->name('refund');
});

Route::resource('orders', OrderController::class)->only(['index', 'store']);
Route::resource('products', ProductController::class)->only(['index', 'store']);

require __DIR__.'/auth.php';
