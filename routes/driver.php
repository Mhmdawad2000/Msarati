<?php

use App\Http\Controllers\Driver\CarController;
use App\Http\Controllers\Admin\RouteController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Driver\BusController;
use App\Http\Controllers\Driver\BusTripController;
use App\Http\Controllers\Driver\CarRouteController;
use App\Http\Controllers\Driver\UserBusTripController;
use App\Http\Controllers\User\RequestController;
use App\Models\Request;
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


Route::group(['middleware' => ['auth:sanctum', 'Driver_Role']], function () {
    ////////////////////////////////// Start Car
    Route::post('add-car', [CarController::class, 'AddCar']);
    Route::post('edit-car', [CarController::class, 'EditCar']);
    ////////////////////////////////// End Car

    ////////////////////////////////// Start CarRoute
    Route::post('add-route-to-car', [CarRouteController::class, 'AddRouteToCar']);
    Route::post('edit-route-to-car', [CarRouteController::class, 'EditRouteToCar']);
    ////////////////////////////////// End CarRoute

    ////////////////////////////////// Start Bus
    Route::post('add-bus', [BusController::class, 'AddBus']);
    Route::post('edit-bus', [BusController::class, 'EditBus']);
    ////////////////////////////////// End Bus

    ////////////////////////////////// Start BusTrip
    Route::post('add-bus-trip', [BusTripController::class, 'AddBusTrip']);
    Route::post('edit-bus-trip', [BusTripController::class, 'EditBusTrip']);
    Route::post('edit-bus-trip', [BusTripController::class, 'EditBusTrip']);
    Route::post('add-bus-trip-to-archive', [BusTripController::class, 'AddBusTripToArchive']);
    ////////////////////////////////// End BusTrip

    /////////////////////////////// Start UserBusTrip
    Route::post('add-user-bus-trip', [UserBusTripController::class, 'AddUserBusTrip']);
    Route::post('edit-user-bus-trip', [userbustripController::class, 'EditUserBusTrip']);
    ////////////////////////////////// End UserBusTrip

    Route::post('accept-request', [RequestController::class, 'AcceptRequest']);
    Route::post('get-all-waiting-Requests', [RequestController::class, 'GetAllWaitingRequests']);

    Route::post('get-route-by-id', [RouteController::class, 'GetRouteById']);
    Route::post('get-all-routes', [RouteController::class, 'GetAllRoutes']);

    Route::post('get-vehicle-by-id', [VehicleController::class, 'GetVehicleById']);
    Route::post('get-all-vehicles', [VehicleController::class, 'GetAllVehicles']);
});