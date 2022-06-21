<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('Jocs/jocs');
});

Route::get('/sales', function () {
    return view('Sales/sales');
});


Route::get('/jocs',[\App\Http\Controllers\JocController::class,'index'])->name('jocs');

Route::resource('jocs', \App\Http\Controllers\JocController::class)->middleware('auth');

Route::get('/reserves',[\App\Http\Controllers\ReservaController::class,'index'])->name('reserva');
Route::get('/userReserva',[\App\Http\Controllers\ReservaController::class,'takeUserLoged'])->name('reserva');
Route::get('/reserve',[\App\Http\Controllers\ReservaController::class,'takeResValo'])->name('reserva');
Route::resource('reserva', \App\Http\Controllers\ReservaController::class)->middleware('auth');

Route::get('/sales', [\App\Http\Controllers\SalaController::class, 'index'])->name('sala');
Route::resource('sala', \App\Http\Controllers\SalaController::class)->middleware('auth');

Route::get('/valoracio',[\App\Http\Controllers\ValoracioController::class,'index'])->name('valoracio');
Route::resource('valoracio', \App\Http\Controllers\ValoracioController::class)->middleware('auth');


Auth::routes();

Route::get('/users', [\App\Http\Controllers\UserController::class, 'view'])->name('user');
Route::get('/profile', [\App\Http\Controllers\UserController::class, 'goProfile'])->name('user');
Route::get('/usergetUs', [\App\Http\Controllers\UserController::class, 'usergetUs'])->name('user');


Route::resource('users', \App\Http\Controllers\UserController::class)->middleware('auth');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

