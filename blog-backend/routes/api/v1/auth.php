<?php

Route::prefix('auth')->group(function(){
    /**
     * auth actions routes
     */
    Route::post('register', [\App\Http\Controllers\Api\Auth\RegisterController::class, 'register']);

    Route::post('login', [\App\Http\Controllers\Api\Auth\LoginController::class, 'login']);

    Route::middleware('auth:api')->group(function(){
        Route::get('profile', [\App\Http\Controllers\Api\Auth\ProfileController::class, 'profile']);
        Route::post('logout', [\App\Http\Controllers\Api\Auth\LoginController::class, 'logout']);
    });

    /**
     * email verifcations routes
     */
    Route::get('email/verify/{id}', [App\Http\Controllers\Api\Auth\EmailVerificationController::class, 'verify'])->name('verification.verify');
    Route::get('email/resend', [EmailVerificApp\Http\Controllers\Api\Auth\EmailVerificationControllerationController::class, 'resend'])->name('verification.resend');
});
