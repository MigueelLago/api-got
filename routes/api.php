<?php

use App\Http\Controllers\Api\HousesController;
use Illuminate\Http\Request;
use Illuminate\Routing\RouteGroup;
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


Route::prefix('admin')->group(function(){

    Route::post('/houses', [HousesController::class, 'store']);
    Route::get('/houses', [HousesController::class, 'index']);
    Route::delete('/houses/{id}', [HousesController::class, 'destroy']);
    Route::put('/houses/{id}', [HousesController::class, 'update']);
});
