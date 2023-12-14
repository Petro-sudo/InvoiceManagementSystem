<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterAndLogin;
use App\Http\Controllers\OrderInvoicePayment;
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

Route::get('/', function () {
    return view('welcome');
});

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

//login and register
Route::controller(RegisterAndLogin::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    // Route::post('/logout', 'logout')->name('logout');
});
//OrderInvoicePayment
Route::controller(OrderInvoicePayment::class)->group(function () {
    Route::get('/create_order', 'create_order')->name('create_order');
    Route::post('/store_order', 'store_order')->name('store_order');
    Route::get('/create_invoice', 'create_invoice')->name('create_invoice');
    Route::post('/store_invoice', 'store_invoice')->name('store_invoice');
    Route::get('/create_payment', 'create_payment')->name('create_payment');
    Route::get('/store_payment', 'store_payment')->name('store_payment');
    // Route::post('/logout', 'logout')->name('logout');
});
