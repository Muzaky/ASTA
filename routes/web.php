<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\C_Auth;
use App\Http\Controllers\C_User;

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

#AuthGet
Route::group(['prefix'=> 'auth'], function(){
    Route::get('/start', [C_Auth::class, 'start'])->name('start');
    Route::get('/login/{id_roles}', [C_Auth::class, 'login'])->name('login');
    Route::get('/register/{id_roles}', [C_Auth::class, 'register'])->name('register');
    Route::get('/verifemail', [C_Auth::class, 'verifemail'])->name('verifemail');
});

#AuthPost
Route::group(['prefix'=> 'auth'], function(){
    Route::post('/authlogin', [C_Auth::class, 'authlogin'])->name('authlogin');
    Route::post('/authregister', [C_Auth::class, 'authregister'])->name('authregister');
});

#UserGet
Route::group(['prefix'=> 'user'], function(){
    Route::get('main', [C_User::class, 'main'])->name('main');
});