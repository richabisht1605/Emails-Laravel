<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\OTPVerificationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register-user', [RegisterController::class, 'register']);
Route::get('otp/verify/{user}', [OTPVerificationController::class, 'show'])->name('otp.verify');
Route::post('otp-verify/{user}', [OTPVerificationController::class, 'verify']);
Route::get('/home', [HomeController::class, 'showHomePage'])->name('home');
// Define the route for resending OTP
Route::get('/otp-resend/{user}', [OTPVerificationController::class, 'resendOtp'])->name('otp.resend');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/postLogin', [LoginController::class, 'postLogin'])->name('login.submit');
