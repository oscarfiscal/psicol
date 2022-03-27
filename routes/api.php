<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\controllers\BuyerController;
use App\Http\controllers\EventController;
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

//rutas para el controlador de comprador
Route::get('/compradores', [App\Http\Controllers\api\BuyerController::class, 'index']);
Route::post('/comprador',[App\Http\Controllers\api\BuyerController::class,'store']);

//rutas para evento
Route::get('/eventos', [App\Http\Controllers\api\EventController::class, 'index']);
Route::post('/evento',[App\Http\Controllers\api\EventController::class,'store']);
