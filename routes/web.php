<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\PersonalFormController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BookingRequestController;


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

Route::get('/admin', function(){
    return view('back.pages.index');
})->name('dashboard');




Route::get('/admin/products',[ProductController::class, 'getItems'])->name('get-back-items');


Route::get('/admin/settings', [SettingsController::class, 'index'])->name('settings.index');
Route::post('/admin/settings', [SettingsController::class, 'store'])->name('settings.store');


Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');Route::post('register', [RegisterController::class, 'register']);
Route::post('register', [RegisterController::class, 'register']);

Route::post('login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



Route::post('/booking/store', [BookingRequestController::class, 'store'])->name('booking.store');