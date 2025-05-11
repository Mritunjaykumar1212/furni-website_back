<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;  // Ensure to include this for Str::random()

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if (!$user) {
            return back()->with('error', 'No user found with that email');
        } else {
            $user->otp = str::random(6); // Secure OTP
            $user->otp_expiration = now()->addMinutes(5); // Set expiration time for OTP (5 minutes)
            $user->save();
        }
    
        // Send OTP email
        Mail::raw("Your OTP is: {$user->otp}", function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Your OTP for Login');
        });
    
        Session::put('email', $user->email);
        return redirect()->route('verify.otp')->with('success', 'OTP sent to your email');
    }
    public function showOtpForm()
{
    return view('auth.otp'); // Yeh view tu resources/views/auth/otp.blade.php mein banayega
}
public function logout(Request $request)
{
    Auth::logout();
    Session::flush();
    return redirect('/login')->with('success', 'Logged out successfully!');
}

    
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required'
        ]);
    
        $user = User::where('email', Session::get('email'))
                    ->where('otp', $request->otp)
                    ->where('otp_expiration', '>=', now()) // Check if OTP is still valid
                    ->first();
    
        if (!$user) {
            return back()->with('error', 'Invalid or expired OTP');
        }
    
        $user->is_verified = true;
        $user->otp = null; // Clear OTP
        $user->otp_expiration = null; // Clear expiration
        $user->save();
    
        Auth::login($user);
        return redirect('/')->with('success', 'Logged in successfully!');
    }
}
