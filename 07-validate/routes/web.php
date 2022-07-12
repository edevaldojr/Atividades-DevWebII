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
})->name('index');

Route::resource('clientes', 'App\Http\Controllers\ClienteController');

Route::resource('veterinarios', 'App\Http\Controllers\VeterinarioController');

Route::resource('especialidades', 'App\Http\Controllers\EspecialidadeController');
