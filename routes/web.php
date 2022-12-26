<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use Whoops\Run;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });



// Route::get('register',[AuthController::class,"registerForm"]);
// Route::post('register',[AuthController::class,"register"]);

// Route::get('login',[AuthController::class,"loginForm"]);
// Route::post('login',[AuthController::class,"login"]);


Route::middleware('auth')->group(function(){
    Route::get('/',[CategoryController::class,"all"]);
    Route::get('/show/{id}',[CategoryController::class,"show"]);
    Route::post('logout',[AuthController::class,"logout"]);
});

Route::middleware('is_admin','auth')->group(function(){

    Route::get('/create',[CategoryController::class,"create"]);
    Route::post('store',[CategoryController::class,"store"]);
    Route::get('/edit/{id}',[CategoryController::class,"edit"]);
    Route::put("/update/{id}",[CategoryController::class,"update"]);
    Route::delete("/{id}",[CategoryController::class,"delete"]);
    Route::get("addAdmin",[CategoryController::class,"add"]);
    Route::post("addAdmins",[CategoryController::class,"insert"]);
    Route::get("selectUsers",[CategoryController::class,"select"]);
    Route::get("selectUser/{id}",[CategoryController::class,"selectOne"]);
    Route::delete("/{id}",[CategoryController::class,"deleteUser"]);
});

Route::middleware('guest')->group(function(){
    Route::get('register',[AuthController::class,"registerForm"]);
    Route::post('register',[AuthController::class,"register"]);
    Route::get('login',[AuthController::class,"loginForm"]);
    Route::post('login',[AuthController::class,"login"]);

});

//----------------------------Books------------------------------------------------------//
Route::middleware('auth')->group(function(){
    Route::get('/books',[BookController::class,"all"]);
    Route::get('/showBook/{id}',[BookController::class,"show"]);
    Route::post('logout',[AuthController::class,"logout"]);
});

Route::middleware('is_admin','auth')->group(function(){
    Route::get('/createBook',[BookController::class,"create"]);
    Route::post('book',[BookController::class,"store"]);
    Route::get('/editBook/{id}',[BookController::class,"edit"]);
    Route::put("/updateBook/{id}",[BookController::class,"update"]);
    Route::delete("/books/{id}",[BookController::class,"delete"]);

});
