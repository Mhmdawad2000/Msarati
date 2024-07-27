<?php

use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Driver\BusController;
use App\Http\Controllers\Driver\BusTripController;
use App\Http\Controllers\Driver\CarController;
use App\Http\Controllers\Driver\UserBusTripController;
use App\Http\Controllers\User\ChatController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => ['auth:sanctum']], function () {
    //////////////////////////////////////////////////////// Begin Messages
    Route::post('send-message', [ChatController::class, 'sendMessage'])->middleware('auth:sanctum');
    Route::post('get-all-the-messages-to-user', [ChatController::class, 'GetAllTheMessagesToUser'])->middleware('auth:sanctum');
    Route::get('get-main-page-chat', [ChatController::class, 'MainPage'])->middleware('auth:sanctum');
    //////////////////////////////////////////////////////// Begin Messages

    Route::post('get-bus-trip-by-id', [BusTripController::class, 'GetBusTripById']);
    Route::post('get-all-the-trips-to-bus', [BusTripController::class, 'GetAllTheTripsToBus']);

    Route::post('get-bus-by-id', [BusController::class, 'GetBusById']);
    Route::get('get-all-buses', [BusController::class, 'GetAllBuses']);

    Route::post('get-vehicle-by-id', [VehicleController::class, 'GetVehicleById']);
    Route::get('get-all-vehicles', [VehicleController::class, 'GetAllVehicles']);

    // Route::post('get-car-route-by-id', [CarRouteController::class, 'GetCarRouteById']);

    Route::post('get-car-by-id', [CarController::class, 'GetCarById']);
    Route::get('get-all-cars', [CarController::class, 'GetAllCars']);
});
