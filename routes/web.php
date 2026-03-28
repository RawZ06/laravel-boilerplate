<?php

use Illuminate\Support\Facades\Route;

Route::group(['as' => 'frontend.'], function () {
    includeRouteFiles(__DIR__.'/frontend/');
});

Route::group(['prefix' => 'admin', 'as' => 'backend.'], function () {
    includeRouteFiles(__DIR__.'/backend/');
});

Route::group(['prefix' => 'design-system', 'as' => 'design-system.'], function () {
    includeRouteFiles(__DIR__.'/design-system/');
});
