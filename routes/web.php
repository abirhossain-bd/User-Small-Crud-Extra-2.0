<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if(!Auth::user()){

        return view('login');
    }else{
        return redirect('user/list');
    }
});

Route::get('/register',[RegisterController::class,'register']);
Route::post('/register_post',[RegisterController::class,'signup']);


Route::post('/signin',[LoginController::class,'signin']);
Route::get('/logout',[LoginController::class,'logout']);

Route::prefix('/user/')->group(function(){
    Route::get('list',[UserController::class,'index']);
    Route::get('create',[UserController::class,'create']);
    Route::post('create_post',[UserController::class,'store']);
    Route::get('edit/{id}',[UserController::class,'edit']);
    Route::post('update/{id}',[UserController::class,'update']);
    Route::delete('delete/{id}',[UserController::class,'delete']);
    Route::get('show/{id}',[UserController::class,'show']);
  
});
