<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterAndLogin;
use App\Http\Controllers\OrderInvoicePayment;
use App\Http\Controllers\PdfgenerateController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ViewUsers;
use App\Http\Middleware\ProtectPagesMiddleware;
use App\Http\Middleware\GuestMiddleware;
use App\Http\Controllers\ChangePassword;

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
    // Route::get('/login', 'login')->name('login');
    // Route::post('/authenticate', 'authenticate')->name('authenticate');
    //Route::get('/register', 'register')->name('register');
    Route::get('/create_users', 'createusers')->name('createuser')->middleware('admin');;
    Route::post('/store', 'store')->name('store');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/logout', 'logout')->name('logout');
    //Route::get('/admin', 'admindashboard')->name('admindash');
   });

   Route::middleware('auth')->group(function () {
    Route::get('change_password', [App\Http\Controllers\Auth\ChangePassword::class, 'changepassword'])
    ->name('changepassword');
    Route::post('update_password', [App\Http\Controllers\Auth\ChangePassword::class, 'updatepassword'])
    ->name('updatepassword');
    Route::get('changepassword', [App\Http\Controllers\Auth\ChangePassword::class, 'changepwd'])
    ->name('changepwd');
    Route::post('updatepassword', [App\Http\Controllers\Auth\ChangePassword::class, 'updatepwd'])
    ->name('updatepwd');
   });
   
Route::controller(ViewUsers::class)->group(function () {
    Route::get('/viewusers', 'viewusers')->name('viewusers')->middleware('admin');
    Route::get('/authorizer', 'viewauthorizer')->name('authorizer');
    Route::get('/capturer', 'viewcapture')->name('capture');
    Route::get('/register', 'viewregister')->name('register');
    Route::get('/edituser/{users}/users', 'edit')->name('edit')->middleware('admin');;
    Route::put('/update/{users}/update', 'updateuser')->name('updateuser');
    Route::get('/adminprofile', 'adminprofile')->name('admin')->middleware('admin');
    Route::get('/editadmin/{users}/edit', 'adminedit')->name('editprofile')->middleware('admin');
    Route::put('/updateadmin/{users}/update', 'updateadmin')->name('updateadmin');
    Route::get('/profileofuser', 'userprofile')->name('user');
    Route::get('/edituser/{users}/edit', 'useredit')->name('edituser');
    Route::put('/updateauser/{users}/update', 'updateuserss')->name('updateuserss');
});

Route::controller(OrderInvoicePayment::class)->group(function () {
    Route::get('/create_order', 'create_order')->name('create_order')->middleware('order');
    Route::post('/store_order', 'store_order')->name('store_order')->middleware('order');;
    Route::post('/store_order', 'store_order')->name('store_order')->middleware('order');;
    Route::get('/allorders', 'list')->name('list')->middleware('order');
    
    Route::get('/order/{orders}/edit',  'edit')->name('editorders');
    Route::put('/order/{orders}/update',  'updateOrder')->name('updateorders');

    Route::get('get_orders',  'getOrders')->name('getorders');
    Route::get('get_orders/records',  'Orderrecords')->name('orders/records');
    Route::get('activitylogs',  'activityLogsList')->name('activitylogs')->middleware('admin');;
});



Route::controller(PdfgenerateController::class)->group(function () {
    Route::get('/generate_pdf/{data}/view', 'generatePDF')->name('generate_pdf');
});
Route::controller(PermissionController::class)->group(function () {
    Route::get('/permission', 'index')->name('permissionindex');
    Route::get('/createpermission', 'create')->name('permissioncreate');
    Route::post('/storepermission', 'storepermission')->name('permissionstore');
    Route::get('/getAllPermission', 'getAllPermissions')->name('getAllPermission');
});

Route::controller(RoleController::class)->group(function () {
    Route::get('/role', 'index')->name('roleindex');
    Route::get('/createrole', 'create')->name('rolecreate');
});