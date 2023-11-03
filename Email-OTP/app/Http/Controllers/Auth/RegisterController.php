<?php

namespace App\Http\Controllers\Auth;

use App\Mail\OTPMail;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validate registration data here

        // Check if a user with the same email already exists
        $existingUser = User::where('email', $request->email)->first();

        if ($existingUser) {
            // User with the same email already exists, redirect to login page
            return redirect()->route('login')->with('error', 'An account with this email already exists. Please proceed to login.');
        }

        // Generate a random numeric OTP with 6 digits
        $otp = rand(100000, 999999);

        // Set the expiration time (e.g., 15 minutes from now)
        $otpExpiresAt = now()->addMinutes(1);

        // Create a new user and store the numeric OTP and its expiration time in the database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'otp' => $otp, // Store the numeric OTP
            'otp_expires_at' => $otpExpiresAt, // Store the expiration time
        ]);

        // Send the numeric OTP to the user's email
        Mail::to($user->email)->send(new OTPMail($otp));

        return redirect()->route('otp.verify', ['user' => $user]);
    }


}
