<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'frontend.'], function () {
    includeRouteFiles(__DIR__.'/frontend/');
});

Route::group(['as' => 'auth.'], function () {
    Route::get('login', fn() => view('auth.login'))->name('index');
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::middleware('auth')->get('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::group(['prefix' => 'admin', 'as' => 'backend.', 'middleware' => 'auth'], function () {
    includeRouteFiles(__DIR__.'/backend/');
});

Route::group(['prefix' => 'design-system', 'as' => 'design-system.'], function () {
    includeRouteFiles(__DIR__.'/design-system/');
});
