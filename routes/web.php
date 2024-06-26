<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\C_Auth;

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
    return view('Landing.landing');
});

#Auth
Route::group(['prefix'=> 'auth'], function(){
    Route::get('/start', [C_Auth::class, 'start'])->name('start');
    Route::get('/login/{id_roles}', [C_Auth::class, 'login'])->name('login');
    Route::get('/register/{id_roles}', [C_Auth::class, 'register'])->name('register');
});