<?php

use App\Http\Controllers\ApiProductController;
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

Route::controller(ApiProductController::class)->group(function(){
    Route::get("products" , "all");
    Route::get("products/{id}" , "show");

    Route::post("products" , "store");

    Route::put("products/{id}" , "update");

    Route::delete("products/{id}" , "delete");
});
