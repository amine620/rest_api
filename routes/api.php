<?php

use App\Http\Controllers\Api\ProductController;
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

Route::post('register',[AuthController::class,'register']);
Route::post('login', [AuthController::class, 'login']);


Route::group(['middleware'=>'auth:sanctum'],function(){

    Route::get('products',[ProductController::class,"index"]);
    Route::post('store', [ProductController::class, "store"]);
    Route::delete('destroy/{id}', [ProductController::class, "destroy"]);
    Route::get('show/{id}', [ProductController::class, "show"]);
    Route::post('update/{id}', [ProductController::class, "update"]);
    Route::get('logout',[AuthController::class,'logout']);
});
