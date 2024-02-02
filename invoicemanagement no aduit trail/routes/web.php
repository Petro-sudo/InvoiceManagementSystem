<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterAndLogin;
use App\Http\Controllers\OrderInvoicePayment;
use App\Http\Controllers\PdfgenerateController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;

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
    Route::get('/loginUser', 'loginuser')->name('loginuser');
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/logout', 'logout')->name('logout');
    Route::get('/admin', 'admindash')->name('admindash');
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

    Route::get('get_invoice',  'getStandard')->name('standards');
    Route::get('get_invoice/records',  'records')->name('students/records');
    Route::get('get_invoice', 'getInvoice')->name('getinvoice');

    Route::get('get_orders',  'getOrders')->name('getorders');
    Route::get('get_orders/records',  'Orderrecords')->name('orders/records');
});




Route::controller(PdfgenerateController::class)->group(function () {
    Route::get('/generate_pdf/{data}/view', 'generatePDF')->name('generate_pdf');
});
Route::controller(PermissionController::class)->group(function () {
    Route::get('/permission', 'index')->name('permissionindex');
    Route::get('/createpermission', 'create')->name('permissioncreate');
    Route::post('/storepermission', 'storepermission')->name('permissionstore');
    Route::get('/getAllPermission', 'getAllPermissions')->name('getAllPermission');
    // Route::resource('permission','PermissionController');
});

Route::controller(RoleController::class)->group(function () {
    Route::get('/role', 'index')->name('roleindex');
    Route::get('/createrole', 'create')->name('rolecreate');
    //Route::post('/store', 'store')->name('permissionstore');
    // Route::resource('permission','PermissionController');
});

//axios request
//Route::get('/getAllPermission', 'PermissionController@getAllPermissions');