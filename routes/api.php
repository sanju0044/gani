<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', [UserController::class, 'register']);

/**
* Created route for single user functionality
* Created on 2024-09-21
* Created by Ganesh 
*/

Route::get('checkUserAvailable', [UserController::class, 'checkUserAvailable']);

Route::post('/external-register', [UserController::class, 'externalRegister']);
Route::post('/external-password-update', [UserController::class, 'externalPasswordUpdate']);
Route::post('/check-username-exist-in-ganitalay', [UserController::class, 'checkUserNameExistInGanitalay']);
