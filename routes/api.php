<?php

use App\Http\Controllers\V1\ProductsControllers;
use App\Http\Controllers\V1\StoreCategoryController;
use App\Http\Controllers\V1\AuthController;
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
Route::group(['prefix' => 'v1'], function() {

    // PRODUCTOS
    Route::group(['prefix' => 'products'], function() {
        Route::get('/',  [ProductsControllers::class,'index']);
        Route::get('/byCategory',  [ProductsControllers::class,'byCategory']);
    });

    // CATEGORIES
    Route::group(['prefix' => 'categories'], function() {
        Route::get('/',  [StoreCategoryController::class,'index']);
    });

    // AUTH
    Route::group([ 'middleware' => 'api', 'prefix' => 'auth' ], function ($router) {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('register', [AuthController::class, 'register']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
    });

});
