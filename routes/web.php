<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/categories/{category:slug}', [HomeController::class, 'category'])->name('home.category');
Route::get('/products/{product:slug}', [HomeController::class, 'product'])->name('home.product');
Route::get('/checkout/{product:slug}', [HomeController::class, 'checkout'])->name('home.checkout');
Route::post('/checkout/{product:slug}', [HomeController::class, 'checkoutProcess'])->name('home.checkout.process');
Route::get('/payment/{order:invoice}', [HomeController::class, 'payment'])->name('home.payment');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('auth.store');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
