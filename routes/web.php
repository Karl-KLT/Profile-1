<?php

use App\Mail\sendVerifyCodeMail;
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
use URL as FacadesURL;

if(env('APP_ENV') == 'production') {

    FacadesURL::forceScheme('https');
}

Route::get('/', function () {
    return view('welcome');
})->name('Home');

// Route::get('/view_verificationEmail', function () {
//     return new sendVerifyCodeMail('0000','Karl');
// });

Route::fallback(function(){return redirect(route('Home'));});
