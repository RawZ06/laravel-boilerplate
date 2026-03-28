<?php

use Illuminate\Support\Facades\Route;

Route::get('/',        fn() => view('design-system.index'))->name('index');
Route::get('/buttons', fn() => view('design-system.buttons'))->name('buttons');
Route::get('/form',    fn() => view('design-system.form'))->name('form');
Route::get('/table',    fn() => view('design-system.table'))->name('table');
Route::get('/feedback',    fn() => view('design-system.feedback'))->name('feedback');
Route::get('/overlay',    fn() => view('design-system.overlay'))->name('overlay');
Route::get('/nav',    fn() => view('design-system.nav'))->name('nav');
