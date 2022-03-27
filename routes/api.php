<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\FrontEndController;
use App\Http\Controllers\API\V1\CustomersController;
use App\Http\Controllers\API\V1\RestaurantController;

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

//Customer Auth Routes without required Token
Route::post('/login', [CustomersController::class, 'customersLogin']);
Route::post('/register', [CustomersController::class, 'customersRegistration']);
Route::post('/get-outletBy-domain', [FrontEndController::class, 'getOutletDataByDomain']);
Route::any('/restaurant-menu', [RestaurantController::class, 'getMenu']);
//Client Routes with required token authentication by Sanctum
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('update-profile', [CustomersController::class, 'updateProfile']);
    Route::post('update-password', [CustomersController::class, 'updatePassword']);
});
