<?php

use App\Http\Controllers\FormController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Basic Routes
Route::view('/index', 'index')->name('index');
Route::view('/about', 'about')->name('about');
Route::view('/shop', 'shop')->name('shop');
Route::view('/blog', 'blog')->name('blog');
Route::view('/cart', 'cart')->name('cart');
Route::view('/checkout', 'checkout')->name('checkout');
Route::view('/contact', 'contact')->name('contact');

// Form Submission Route
Route::post('/submit-contact', [FormController::class, 'submit'])->name('submit.contact');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/send-otp', [AuthController::class, 'sendOtp'])->name('send.otp');
Route::get('/verify-otp', [AuthController::class, 'showOtpForm'])->name('verify.otp');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('verify.otp.submit'); // ✅ Fixed route name
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Authenticated Routes
Route::get('/orders', function () {
    return view('orders');
})->middleware('auth');

// Redirect After Login (default homepage)
Route::get('/', function () {
    return redirect()->route('index')->with('success', 'Logged in successfully!');
})->middleware('auth');
