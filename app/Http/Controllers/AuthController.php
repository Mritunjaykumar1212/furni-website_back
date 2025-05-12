<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;  

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
           
            $user->otp = Str::random(6); 
            $user->otp_expiration = now()->addMinutes(5); 
            $user->save();
        }
    
      
        Mail::raw("Your OTP is: {$user->otp}", function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Your OTP for Login');
        });
    
       
        Session::put('email', $user->email);

    
        return redirect()->route('verify.otp')->with('success', 'OTP sent to your email');
    }

  
    public function showOtpForm()
    {
        return view('auth.otp'); 
    }


    public function verifyOtp(Request $request)
    {
      
        $request->validate([
            'otp' => 'required'
        ]);
    
       
        $user = User::where('email', Session::get('email'))
                    ->where('otp', $request->otp)
                    ->where('otp_expiration', '>=', now()) 
                    ->first();
    
        if (!$user) {
          
            return back()->with('error', 'Invalid or expired OTP');
        }
    
       
        $user->is_verified = true;
        $user->otp = null;
        $user->otp_expiration = null;
        $user->save();
    
       
        Auth::login($user);

       
        return redirect('/')->with('success', 'Logged in successfully!');
    }

   
    public function logout(Request $request)
    {
        Auth::logout();      
        Session::flush();    
        return redirect('/login')->with('success', 'Logged out successfully!');
    }
}
