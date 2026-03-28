<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('admin.index'))->name('index');
