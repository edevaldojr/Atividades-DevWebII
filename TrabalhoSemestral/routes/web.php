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
    return view('templates.main')->with('titulo', "Dashboard");
})->middleware(['auth']);

Route::resource('/carros', '\App\Http\Controllers\CarroController')->middleware(['auth']);

Route::resource('/vagas', '\App\Http\Controllers\VagasController')->middleware(['auth']);

Route::resource('/estacionar', '\App\Http\Controllers\EstacionarController')->middleware(['auth']);


require __DIR__.'/auth.php';
