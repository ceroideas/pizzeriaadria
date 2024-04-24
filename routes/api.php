<?php

use App\Http\Controllers\V1\ProductsControllers;
use App\Http\Controllers\V1\StoreCategoryController;
use App\Http\Controllers\V1\AuthController;
use App\Http\Controllers\V1\OrdersController;
use App\Http\Controllers\V1\AlergenosController;
use App\Http\Controllers\V1\RedsysController;
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
        Route::post('/toggleFavorites',  [ProductsControllers::class, 'toggleFavorites'])->middleware('auth:api');
        Route::get('/getFavorites',  [ProductsControllers::class, 'getFavorites'])->middleware('auth:api');
        Route::get('/getRecommended',  [ProductsControllers::class, 'getRecommended']);
        Route::get('/getById',  [ProductsControllers::class, 'getById']);
        Route::get('/getByAlergeno',  [ProductsControllers::class, 'getByAlergenoId']);
        Route::get('/searchByName',  [ProductsControllers::class, 'searchByName']);
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

    //Order
    Route::group([ 'middleware' => 'auth:api', 'prefix' => 'order' ], function ($router) {
        Route::get('/all', [OrdersController::class, 'index']);
        Route::get('getCurrent', [OrdersController::class, 'currentOrder']);
        Route::post('addProduct', [OrdersController::class, 'addProducts']);
        Route::post('deleteProduct', [OrdersController::class, 'deleteProduct']);
        Route::post('changeOrderStatus', [OrdersController::class, 'changeOrderStatus']);
    });

    //Alergenos
    Route::group([ 'middleware' => 'api', 'prefix' => 'alergenos' ], function ($router) {
        Route::get('/', [AlergenosController::class, 'index']);
    });

    // Redsys
    Route::group([ 'middleware' => 'auth:api', 'prefix' => 'payments' ], function ($router) {
        Route::get('/', [RedsysController::class, 'makePayment']);
        // Route::post('/', [RedsysController::class, 'makePayment']);
    });
});
