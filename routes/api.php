<?php

use App\Http\Controllers\ApiAutController;
use App\Http\Controllers\ApiCategoriesController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get("categories",[ApiCategoriesController::class,"allApi"]);
Route::post("categories/create",[ApiCategoriesController::class,"createApi"]);
Route::put("categories/update/{id}",[ApiCategoriesController::class,"update"]);
Route::delete("categories/delete/{id}",[ApiCategoriesController::class,"delete"]);


//register

