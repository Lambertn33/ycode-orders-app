<?php

use App\Http\Controllers\Collections\CollectionsController;
use App\Http\Controllers\Shop\ShopController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(CollectionsController::class)->prefix('collections')->group(function() {
  Route::get('/', 'getAllCollections');
  Route::get('/products/list', 'getAllProducts');
  Route::get('/{collectionName}', 'getCollection');
});

Route::controller(ShopController::class)->prefix('shop')->group(function() {
  Route::prefix('cart/{userId}')->group(function() {
    Route::get('/', 'getMyCart');
    Route::post('/', 'addProductToCart');
  });
});

