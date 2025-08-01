<?php

use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::prefix('recipe')->group(function () {
        Route::post('/store', [RecipeController::class, 'store'])->name('recipe.create');
        Route::post('/update', [RecipeController::class, 'update'])->name('recipe.update');
    });
});
