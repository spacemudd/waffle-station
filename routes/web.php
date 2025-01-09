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
use App\Http\Controllers\back\AdminController;
use App\Http\Controllers\BookingRequestController;
use App\Http\Controllers\PaymentController;


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

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');Route::post('register', [RegisterController::class, 'register']);
Route::post('register', [RegisterController::class, 'register']);

Route::post('login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/booking/store', [BookingRequestController::class, 'store'])->name('booking.store');

Route::get('/profile', function() {
    return view('front.profiles.profile');
})->name('profile');

Route::get('/NoonPayment', [PaymentController::class, 'showNoonPayment'])->name('Noon');
Route::post('/NoonPayment', [PaymentController::class, 'processPayment'])->name('process-payment');

Route::post('/booking-requests/clear', [BookingRequestController::class, 'clearBookingRequests'])->name('booking_requests.clear');
// Route::get('/payment/success', function () {
//     return view('front.payments.success');
// })->name('payment.success');

// Route::get('/payment/failure', function () {
//     return view('front.payments.failure');
// })->name('payment.failure');

route::get('/contact', [HomeController::class, 'contactUs'])->name('contact-us');




// route::get('/admin/invoice', [AdminController::class, 'showInvoices'])->name('admin-invoice');
// Route::get('/admin/products',[ProductController::class, 'getItems'])->name('get-back-items');
// Route::get('/admin/settings', [SettingsController::class, 'index'])->name('settings.index');
// Route::post('/admin/settings', [SettingsController::class, 'store'])->name('settings.store');
// route::get('/admin/orders', [BookingRequestController::class, 'showOrders'])->name('admin-order');

Route::get('/admin/control/', function(){
    return view('back.pages.index');
})->name('dashboard');


