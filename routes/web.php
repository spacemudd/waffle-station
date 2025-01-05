<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\PersonalFormController;


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
Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::get('/product_details/{id}', [ProductController::class, 'show'])->name('product.details');

Route::get('/cart', [CartController::class, 'viewCart'])->name('cart');
Route::post('/', [CartController::class, 'store'])->name('cart.store');

Route::get('/clear-session', function () {
    Session::flush();
    return redirect()->route('home');
});

