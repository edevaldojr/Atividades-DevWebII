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
    return view('templates.main')->with('titulo', "");
})->middleware(['auth']);

Route::resource('/carros', '\App\Http\Controllers\CarroController')->middleware(['auth']);

Route::resource('/estacionar', '\App\Http\Controllers\EstacionarController')->middleware(['auth']);

Route::resource('/clientes', '\App\Http\Controllers\ClienteController')->middleware(['auth']);

Route::resource('/funcionarios', '\App\Http\Controllers\FuncionarioController')->middleware(['auth']);

require __DIR__.'/auth.php';
