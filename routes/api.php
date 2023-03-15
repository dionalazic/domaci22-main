<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CarTestController;
use App\Http\Controllers\UserController;
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

Route::get('/users',[UserController::class,'index']);

Route::get('/users/{id}', [UserController::class,'show']);

Route::get('/users/{id}/cars', [UserController::class,'showCars']);

//Route::get('/cars', [CarController::class, 'index']);

//Route::get('/cars/{id}', [CarController::class,'show']);



Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

//grupne rute sa ogranicenjem: Ne moze se pristupiti rutama ako nije autorizovan korisnik
Route::group(['middleware'=>['auth:sanctum']], function(){

    Route::get('/profile', function(Request $request){
        return auth()->user();
    });

    Route::resource('cars', CarController::class)->only(['update', 'store', 'destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);

});

//za prikaz kola (moze svako da pristupi)
Route::resource('cars', CarController::class)->only(['index']);


