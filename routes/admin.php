<?php

use App\Http\Controllers\Driver\CarController;
use App\Http\Controllers\Admin\RouteController;
use App\Http\Controllers\Admin\TripController;
use App\Http\Controllers\Admin\TripStopController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Driver\UserBusTripController;
use App\Http\Controllers\User\RequestController;
use App\Http\Controllers\User\UserController;
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


Route::group(['middleware' => ['auth:sanctum', 'Admin_Role']], function () {
    ////////////////////////////////// Start Route
    Route::post('add-route', [RouteController::class, 'AddRoute']);
    Route::post('edit-route', [RouteController::class, 'EditRoute']);
    Route::post('get-route-by-id', [RouteController::class, 'GetRouteById']);
    Route::get('get-all-routes', [RouteController::class, 'GetAllRoutes']);
    ////////////////////////////////// End Route

    ////////////////////////////////// Start Trip
    Route::post('add-trip', [TripController::class, 'AddTrip']);
    Route::post('edit-trip', [TripController::class, 'EditTrip']);
    Route::post('get-trip-by-id', [TripController::class, 'GetTripById']);
    Route::get('get-all-trips', [TripController::class, 'GetAllTrips']);
    ////////////////////////////////// End Trip
    /////////////Stop here
    ////////////////////////////////// Start TripStop
    Route::post('add-trip-stop', [TripStopController::class, 'AddTripStop']);
    Route::post('edit-trip-stop', [TripStopController::class, 'EditTripStop']);
    Route::post('get-trip-stop-by-id', [TripStopController::class, 'GetTripStopById']);
    Route::post('get-all-trip-stops', [TripStopController::class, 'GetAllTripStops']);
    ////////////////////////////////// End TripStop

    ////////////////////////////////// Start Vehicle
    Route::post('add-vehicle', [VehicleController::class, 'AddVehicle']);
    Route::post('edit-vehicle', [VehicleController::class, 'EditVehicle']);
    Route::post('get-vehicle-by-id', [VehicleController::class, 'GetVehicleById']);
    Route::post('get-all-vehicles', [VehicleController::class, 'GetAllVehicles']);
    ////////////////////////////////// End Vehicle

    ////////////////////////////////// Start User
    Route::post('count-users', [UserController::class, 'GetCountUser']);
    Route::post('count-drivers', [UserController::class, 'GetCountDriver']);
    ////////////////////////////////// End User


    /////////////////////////////// Start UserBusTrip
    Route::post('get-user-bus-trip-by-id', [UserBusTripController::class, 'GetUserBusTripById']);
    Route::post('get-all-user-bus-trips', [userbustripController::class, 'GetAllUserBusTrips']);
    Route::post('get-all-users-to-bus-trip', [userbustripController::class, 'GetAllUsersToBusTrip']);
    Route::post('get-all-bus-trips-to-user', [userbustripController::class, 'GetAllBusTripsToUser']);
    ////////////////////////////////// End UserBusTrip

    Route::post('get-all-accepted-Requests', [RequestController::class, 'GetAllAcceptedRequests']);
    Route::post('get-all-archived-Requests', [RequestController::class, 'GetAllArchivedRequests']);
    Route::post('get-all-waiting-Requests', [RequestController::class, 'GetAllWaitingRequests']);
});
