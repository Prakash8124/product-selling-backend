<?php

use App\Http\Controllers\CartController;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth')->get('/user', function (Request $request) {


    return response()->json(Products::find(7)->categories);

});

Route::group([
    'middleware' => 'api',
], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('register', [AuthController::class, 'register']);

    Route::get('products', [ProductController::class, 'products']);
    Route::post('product/{id}', [ProductController::class, 'product']);

    
    Route::get('cart', [CartController::class, 'getCart']);
    Route::post('cart', [CartController::class, 'addCart']);
});
