<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'frontend.'], function () {
    includeRouteFiles(__DIR__.'/frontend/');
});

Route::group(['as' => 'auth.'], function () {
    Route::get('login', fn() => view('auth.login'))->name('index');
    Route::get('register', fn() => view('auth.register'))->name('register.index');
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('login', [AuthController::class, 'login'])->name('login');

    Route::middleware('auth')->get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('forgot-password', [AuthController::class, 'forgotPasswordIndex'])->name('password.request');
    Route::post('forgot-password', [AuthController::class, 'forgotPasswordStore'])->name('password.email');
    Route::get('reset-password/{token}', [AuthController::class, 'resetPasswordIndex'])->name('password.reset');
    Route::post('reset-password', [AuthController::class, 'resetPasswordStore'])->name('password.update');

    Route::group(['prefix' => 'profile', 'as' => 'profile.', 'middleware' => ['auth']], function () {
        Route::get('', fn() => view('auth.profile'))->name('index');
        Route::patch('', [AuthController::class, 'update'])->name('update');
        Route::patch('password', [AuthController::class, 'password'])->name('password');
        Route::post('logout-others', [AuthController::class, 'logoutOthers'])->name('logout-others');
        Route::delete('account', [AuthController::class, 'deleteAccount'])->name('delete');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('verify-email', [AuthController::class, 'verifyEmailIndex'])->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', [AuthController::class, 'verifyEmailStore'])->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
    Route::post('email/verification-notification', [AuthController::class, 'verifyEmailResend'])->middleware('throttle:6,1')->name('verification.send');
});

Route::group(['prefix' => 'admin', 'as' => 'backend.', 'middleware' => ['auth', 'admin']], function () {
    includeRouteFiles(__DIR__.'/backend/');
});

Route::group(['prefix' => 'design-system', 'as' => 'design-system.'], function () {
    includeRouteFiles(__DIR__.'/design-system/');
});
