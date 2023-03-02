<?php

use Illuminate\Support\Facades\Route;

Route::get('/{any}', [\App\Http\Controllers\CheckoutController::class, 'index'])->where('any', '.*');
