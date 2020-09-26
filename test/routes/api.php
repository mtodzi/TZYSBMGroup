<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\ItemController;

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
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('registration', 'App\Http\Controllers\AuthController@registration');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('me', 'App\Http\Controllers\AuthController@me');
});

Route::middleware('auth:api')->get('/shipment', [ShipmentController::class, 'index']);
Route::middleware('auth:api')->post('/shipment', [ShipmentController::class, 'store']);
Route::middleware('auth:api')->get('/shipment/{id}', [ShipmentController::class, 'show']);
Route::middleware('auth:api')->put('/shipment/{id}', [ShipmentController::class, 'update']);
Route::middleware('auth:api')->delete('/shipment/{id}', [ShipmentController::class, 'destroy']);
Route::middleware('auth:api')->post('/shipment/{id}/send', [ShipmentController::class, 'send']);

Route::middleware('auth:api')->get('/item/shipment/{shipment_id}', [ItemController::class, 'index']);
Route::middleware('auth:api')->post('/item', [ItemController::class, 'store']);
Route::middleware('auth:api')->get('/item/{id}', [ItemController::class, 'show']);
Route::middleware('auth:api')->put('/item/{id}', [ItemController::class, 'update']);
Route::middleware('auth:api')->delete('/item/{id}', [ItemController::class, 'destroy']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
