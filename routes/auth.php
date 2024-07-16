<?php

use App\Http\Controllers\Auth\AuthController;
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

Route::post('register-passenger', [AuthController::class, 'RegisterPassenger']);
Route::post('register-driver', [AuthController::class, 'RegisterDriver']);
Route::post('register-admin', [AuthController::class, 'RegisterAdmin']);
Route::post('login', [AuthController::class, 'Login']);