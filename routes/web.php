<?php

use App\Http\Controllers\PaymentController;
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

Route::get('/stripe', function () {
    return view('payment.stripe');
})->name('payment.stripe');

Route::get('/paypal', function () {
    return view('payment.paypal');
})->name('payment.paypal');

Route::post('/payment/create', [PaymentController::class, 'createPayment'])->name('payment.create');
Route::get('/payment/confirm/{paymentId}', [PaymentController::class, 'confirmPayment'])->name('payment.confirm');
Route::post('/refund', [PaymentController::class, 'processRefund'])->name('refund');

require __DIR__.'/auth.php';
