<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\MiningController;
use App\Http\Controllers\Api\FaqController;
use App\Http\Controllers\Api\AdminController;

//settings

Route::get('/settings', [AdminController::class, 'settings']);



Route::get('/countries', [CountryController::class, 'index']);
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/otp-verify', [RegisterController::class, 'verifyOtp']);
Route::post('/check-email',[RegisterController::class,'checkEmail']);
Route::post('/check-phoneno',[RegisterController::class,'checkPhone']);
Route::post('/forgot-password', [RegisterController::class, 'forgotsendOtp']);
Route::post('/reset-password', [RegisterController::class, 'resetPassword']);
Route::post('/forgototp-verify', [RegisterController::class, 'verifyForgotOtp']);
Route::get('/verify-email/{token}', [RegisterController::class,'verifyEmail']);
Route::post('/Login',[LoginController::class,'login']);
Route::get('/faqs', [FaqController::class, 'faqs']);

Route::middleware('auth:sanctum')->group(function () {
    
     Route::post('/device-token', [RegisterController::class, 'deviceToken']);
     Route::post('/send-notification', [RegisterController::class, 'sendTestNotification']);
   Route::delete('/delete-account', [RegisterController::class, 'deleteAccount']);
    Route::post('/mining/activate', [MiningController::class, 'activate']);
    Route::get('/mining/dashboard', [MiningController::class, 'dashboard']);
    Route::get('/mining/progress', [MiningController::class, 'progress']);
     Route::post('/change-password', [MiningController::class, 'changePassword']);
     Route::get('/profile', [MiningController::class, 'profile']);
     Route::post('/update-profile', [MiningController::class, 'updateProfile']);
     Route::post('/update-profile-photo', [MiningController::class, 'updateProfilePhoto']);
     Route::get('/mining-history', [MiningController::class, 'miningHistory']);
Route::get('/notifications', [MiningController::class, 'getNotifications']);

Route::post('/admin/update-coin', [MiningController::class, 'updateCoin']);
});

