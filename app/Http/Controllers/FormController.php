<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormData;

class FormController extends Controller
{
    public function submit(Request $request)
    {
        // Optional: Validate
        $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|email',
            'message'    => 'required',
        ]);

        // Save to database
        FormData::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'message'    => $request->message,
        ]);

        return redirect()->route('contact')->with('success', 'Form submitted successfully!');
    }
}
