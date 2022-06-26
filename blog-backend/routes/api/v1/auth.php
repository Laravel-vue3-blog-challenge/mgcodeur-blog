<?php

Route::prefix('auth')->group(function(){
    Route::post('register', [\App\Http\Controllers\Auth\RegisterController::class, 'register']);

    Route::post('login', [\App\Http\Controllers\Auth\LoginController::class, 'login']);

    Route::middleware('auth:api')->group(function(){
        Route::get('profile', [\App\Http\Controllers\Auth\ProfileController::class, 'profile']);
        Route::post('logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout']);
    });
});
