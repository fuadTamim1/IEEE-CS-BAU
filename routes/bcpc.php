<?php

use App\Http\Controllers\Bcpc\BcpcController;
use Illuminate\Support\Facades\Route;

Route::get('/bcpc', [BcpcController::class, 'show'])->name('bcpc');

Route::post('/bcpc/register', [BcpcController::class, 'register'])
    ->middleware('throttle:3,60')
    ->name('bcpc.register');

Route::post('/coming-soon/register', [BcpcController::class, 'register'])
    ->middleware('throttle:3,60');

Route::redirect('/coming-soon', '/bcpc', 301)->name('coming-soon');
