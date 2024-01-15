<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterAndLogin;
use App\Http\Controllers\OrderInvoicePayment;
use App\Http\Controllers\PdfgenerateController;
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

//login and register
Route::controller(RegisterAndLogin::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    //Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/logout', 'logout')->name('logout');
});
//OrderInvoicePayment
Route::controller(OrderInvoicePayment::class)->group(function () {
    Route::get('/create_order', 'create_order')->name('create_order');
    Route::post('/store_order', 'store_order')->name('store_order');
    Route::get('/create_invoice', 'create_invoice')->name('create_invoice');
    Route::post('/store_invoice', 'store_invoice')->name('store_invoice');
    Route::get('/create_payment', 'create_payment')->name('create_payment');
    Route::post('/store_payment', 'store_payment')->name('store_payment');
    Route::get('/view_invoice/{data}/view', 'view_invoice')->name('view_invoice');
    Route::get('/view_orders', 'view_orders')->name('view_orders');
    Route::get('/list_invoice', 'list_invoice')->name('list_invoice');
    Route::get('/list_payment', 'list_payment')->name('list_payment');
});

Route::controller(PdfgenerateController::class)->group(function () {
    Route::get('/generate_pdf/{data}/view', 'generatePDF')->name('generate_pdf');
});