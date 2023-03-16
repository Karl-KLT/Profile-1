<?php

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
use URL;

if(env('APP_ENV') == 'production') {
    URL::forceScheme('https');
}

Route::get('/', function () {
    return view('welcome');
})->name('Home');



Route::fallback(function(){return redirect(route('Home'));});
