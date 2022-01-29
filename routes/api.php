<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Product Resource
// Route::resource('products', ProductController::class);

/* Register user */
Route::post('/register', [AuthController::class, 'register']);

/* login user */
Route::post('/login', [AuthController::class, 'login']);

/* Get all Products */
Route::get('/products', [ProductController::class, 'index']);
/* view a Product */
Route::get('/products/{id}', [ProductController::class, 'show']);
/* Search Products */
Route::get('/products/search/{name}', [ProductController::class, 'search']);

/* Auth sanctum group middleware */
Route::group(['middleware' => ['auth:sanctum']], function () {
    // post a Product
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);
    /* user logout */
    Route::post('/logout', [AuthController::class, 'logout']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
