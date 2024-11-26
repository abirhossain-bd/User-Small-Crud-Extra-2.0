<?php

use App\Http\Controllers\UserApiController;
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

Route::get('user/list',[UserApiController::class,'index']);
Route::post('user/store',[UserApiController::class,'store']);
Route::post('user/update/{id}',[UserApiController::class,'update']);
Route::get('user/delete/{id}',[UserApiController::class,'delete']);

