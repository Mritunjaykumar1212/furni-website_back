<?php

use App\Http\Controllers\FormController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

//  koi bhi access kar sakta hai
Route::view('/', 'index')->name('index');
Route::view('/home', 'index')->name('index');


//  Auth Routes
Route::get('/login', function () {
    if (Auth::check()) {
        return redirect()->route('index'); // Agar already login hai to index bhej do
    }
    return view('auth.login');
})->name('login');

Route::post('/send-otp', [AuthController::class, 'sendOtp'])->name('send.otp');
Route::get('/verify-otp', [AuthController::class, 'showOtpForm'])->name('verify.otp');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('verify.otp.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//  Form Submission 
Route::post('/submit-contact', [FormController::class, 'submit'])->name('submit.contact');

//  sirf login hone ke baad hi access honge
Route::middleware(['valid'::class])->group(function () {
    Route::view('/about', 'about')->name('about');
    Route::view('/shop', 'shop')->name('shop');
    Route::view('/blog', 'blog')->name('blog');
    Route::view('/cart', 'cart')->name('cart');
    Route::view('/checkout', 'checkout')->name('checkout');
    Route::view('/contact', 'contact')->name('contact');
    Route::view('/orders', 'orders')->name('orders');

    //login ke baad hi '/' chalega
    // Route::get('/', function () {
    //     return redirect()->route('index')->with('success', 'Logged in successfully!');
    // });
});
