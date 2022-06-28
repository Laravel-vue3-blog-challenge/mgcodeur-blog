<?php

Route::prefix('auth')->group(function(){
    /**
     * auth actions routes
     */
    Route::post('register', [\App\Http\Controllers\Api\V1\Auth\RegisterController::class, 'register']);
    Route::post('login', [\App\Http\Controllers\Api\V1\Auth\LoginController::class, 'login']);

    /**
     * connected auth actions
     */
    Route::middleware('auth:api')->group(function(){
        Route::get('profile', [\App\Http\Controllers\Api\V1\Auth\ProfileController::class, 'profile']);
        Route::post('logout', [\App\Http\Controllers\Api\V1\Auth\LoginController::class, 'logout']);
    });

    /**
     * auth email verifcations routes
     */
    Route::get('email/verify/{id}', [\App\Http\Controllers\Api\V1\Auth\EmailVerificationController::class, 'verify'])->name('verification.verify');
    Route::get('email/resend', [App\Http\Controllers\Api\V1\Auth\EmailVerificationController::class, 'resend'])->name('verification.resend');
});
