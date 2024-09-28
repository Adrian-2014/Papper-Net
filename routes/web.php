<?php

use App\Http\Controllers\userControl;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminControll;
use App\Http\Controllers\loginControll;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;



Route::get('/', [userControl::class, 'welcome']);

// User
Route::post('/add-to-cart', [CartController::class, 'store']);

Route::post('/cart/increase', [CartController::class, 'tambahPro']);
Route::post('/kurangi-pro', [CartController::class, 'kurangPro']);
Route::post('/tambah-pro', [CartController::class, 'tambahPro']);
Route::post('/delete-item', [CartController::class, 'destroy']);
Route::post('/delete-all', [CartController::class, 'deleteAll']);


Route::get('/checkout', [CheckoutController::class, 'index']);
Route::post('/checkout-now', [CheckoutController::class, 'checkout']);


// User


// LOGIN

Route::get('/login', [loginControll::class, 'index']);
Route::post('/users-log', [loginControll::class, 'loginUser']);
Route::post('/users-reg', [loginControll::class, 'registerUser']);
Route::post('/admins-log', [loginControll::class, 'loginAdmin']);
Route::post('/logout', [loginControll::class, 'logout']);

// LOGIN




// ADMIN

Route::get('/admin/index', [adminControll::class, 'index'])->name('admin.index');
Route::post('/tambah-produk', [BookController::class, 'create']);
Route::put('/update-produk/{book}', [BookController::class, 'update']);
Route::delete('/delete-produk/{book}', [BookController::class, 'destroy']);






