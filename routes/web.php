<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;
use Illuminate\Support\Facades\Route;

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

Route::post('/user-registration',[UserController::class, 'UserRegistration']);
Route::post('/user-login',[UserController::class, 'UserLogin']);
Route::post('/send-otp',[UserController::class, 'SendOTPCode']);
Route::post('/verify-otp',[UserController::class, 'VerifyOTP']);

//Token verify
Route::post('/reset-password',[UserController::class, 'ResetPassword'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/user-profile',[UserController::class, 'UserProfile'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/user-update',[UserController::class, 'UpdateProfile'])->middleware([TokenVerificationMiddleware::class]);


//user logout
Route::get('/logout',[UserController::class, 'UserLogOut']);



//page route
Route::get('/userLogin',[UserController::class, 'LoginPage']);
Route::get('/userRegistration',[UserController::class, 'RegistrationPage']);
Route::get('/sendOtp',[UserController::class, 'SendOtpPage']);
Route::get('/verifyOTP',[UserController::class, 'VerifyOTPPage']);
Route::get('/resetPassword',[UserController::class, 'ResetPasswordPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/dashboard',[DashboardController::class, 'DashboardPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/userProfile',[UserController::class, 'ProfilePage'])->middleware([TokenVerificationMiddleware::class]);