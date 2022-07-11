<?php

Route::prefix('auth')->group(function(){
    /**
     * auth actions routes
     */
    Route::post('register', [\App\Http\Controllers\Api\V1\Auth\RegisterController::class, 'register']);
    Route::post('login', [\App\Http\Controllers\Api\V1\Auth\LoginController::class, 'login']);

    
    Route::middleware('auth:api')->group(function(){
        /**
         * connected auth actions
         */
        Route::get('profile', [\App\Http\Controllers\Api\V1\Auth\ProfileController::class, 'profile']);
        Route::post('logout', [\App\Http\Controllers\Api\V1\Auth\LoginController::class, 'logout']);

        
    });

    /**
     * auth email verifcations routes
     */
    Route::get('email/resend', [App\Http\Controllers\Api\V1\Auth\EmailVerificationController::class, 'resend'])->middleware('auth:api')->name('verification.resend');
    Route::get('email/verify/{id}', [\App\Http\Controllers\Api\V1\Auth\EmailVerificationController::class, 'verify'])->name('verification.verify'); 
});
