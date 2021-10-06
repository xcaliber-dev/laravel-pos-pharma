<?php

use App\Http\Controllers\{
    DashboardController,
    CashierController,
    SupplierController,
    UserController,
    ProfileController,
    ProductController,
    OrderController,
    SellController
};
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::redirect('/','/pos-pharma/public/dashboard');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');
    Route::resource('cashiers',CashierController::class)->parameters(['cashiers'=>'user']);
    Route::resource('suppliers',SupplierController::class)->except('create','show');

    //products
    Route::get('products/expire', [ProductController::class,'expire'])->name('products.expire')->middleware('password.confirm');
    Route::get('products/not-left', [ProductController::class,'notLeft'])->name('products.not_left');
    Route::get('products/debt', [ProductController::class,'debt'])->name('products.debt');
    Route::resource('products', ProductController::class)->except('create','show');

    //orders
    Route::resource('orders',OrderController::class);
    Route::post('/get-data',[OrderController::class,'getData'])->name('orders.getData');
    Route::post('/undo-order',[OrderController::class,'undoOrder'])->name('orders.undoOrder');
    Route::get('invoice',[OrderController::class,'invoice'])->name('orders.invoice');


    Route::resource('user', UserController::class, ['except' => ['show']]);
    Route::put('profile', [ProfileController::class,'update'])->name('profile.update');
    Route::get('profile', [ProfileController::class,'edit'])->name('profile.edit');
    Route::put('profile/password', [ProfileController::class,'password'])->name('profile.password');
});
