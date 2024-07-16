<?php

use App\Http\Controllers\Driver\CarController;
use App\Http\Controllers\Admin\RouteController;
use App\Http\Controllers\Admin\TripController;
use App\Http\Controllers\Admin\TripStopController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\User\PaymentController;
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

Route::group(['middleware' => ['auth:sanctum', 'User_Role']], function () {
    ////////////////////////////////// Start Request
    Route::post('add-Request', [RequestController::class, 'AddRequest']);
    Route::post('edit-Request', [RequestController::class, 'EditmyRequest']);
    Route::post('get-Request-by-id', [RequestController::class, 'GetRequestById']);
    Route::post('get-all-Requests', [RequestController::class, 'GetAllUserRequests']);
    ////////////////////////////////// End Request

    ////////////////////////////////// Start Payment
    Route::post('add-payment', [PaymentController::class, 'Addpayment']);
    Route::post('get-all-waiting-payments', [paymentController::class, 'GetAllpayments']);
    ////////////////////////////////// End Payment

    ////////////////////////////////// Start User
    Route::post('Edit-Profile', [UserController::class, 'EditUser']);
    ////////////////////////////////// End User

});