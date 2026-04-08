<?php

use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('backend.index'))->name('index');
Route::resource('users', UserController::class);

Route::resource('roles', \App\Http\Controllers\Backend\RoleController::class);