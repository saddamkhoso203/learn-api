<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post(('signup'),[UserAuthController::class,'signup']);
Route::post(('login'),[UserAuthController::class,'login']);


Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::post('Add',[UserController::class,'Adduser']);
    Route::get('/users',[UserController::class,'list']);
    Route::put('Update',[UserController::class,'UpdateUser']);
    Route::delete('Delete/{id}',[UserController::class,'DeleteUser']);
    Route::get('Search/{name}',[UserController::class,'SearchUser']);
    

});
