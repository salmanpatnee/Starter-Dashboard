<?php

use Illuminate\Support\Facades\Route;

Route::get('/{any}', App\Http\Controllers\AppController::class)
    ->name('home')
    ->where('any', '.*');
