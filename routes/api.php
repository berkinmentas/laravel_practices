<?php

use App\Models\User;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResources([
    'users'=>'App\Http\Controllers\Api\UserController',
    'cars'=>'App\Http\Controllers\Api\CarController',
    //'cars2'=>'App\Http\Resources\CarResource'
]);

Route::apiResource('/users','\App\Http\Controllers\Api\UserController');


Route::apiResource('/cars', '\App\Http\Controllers\Api\CarController');

Route::get('/cars/{user_id}', function ($user_id) {
    return "Product Id: $id, Type: $r_type";
});
