<?php

use App\Models\User;
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



Route::prefix('Auth')->group(function(){

    Route::post('/login','AuthController@login');

    Route::post('/updateOrCreate','AuthController@updateOrCreate');

    Route::post('/me','AuthController@me');

});

Route::prefix('Skills')->namespace('Clients')->group(function(){

    Route::get('getList','SkillsController@getList');

    Route::post('updateOrCreate','SkillsController@updateOrCreate');

});




