<?php

use App\Http\Controllers\Api\V1\CategoryController;

Route::middleware(['auth:api'])->group(function(){
    Route::resource('categories', CategoryController::class, ['except' => ['edit', 'create']]);
});