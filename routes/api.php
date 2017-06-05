<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:jue')->get('/jugador', function (Request $request) {
    return $request->user();
});*/
Route::get('/','RutasController@index');

Route::get('/comprobar', 'Auth\AutenticacionJugador@checklog')->name('comprobar');

Route::get('/ingresar', 'Auth\AutenticacionJugador@checklog')->name('login');
Route::post('/ingresar', 'Auth\AutenticacionJugador@login')->name('login.submit');
Route::post('/ingresarfb','Auth\AutenticacionJugador@fblogin')->name('loginfb.submit');
Route::delete('/ingresar', 'Auth\AutenticacionJugador@logout')->name('logout');
Route::post('/registrar', 'Auth\RegistrarJugador@crear')->name('register.submit');
Route::get('/jugadores', 'JugadoresController@index')->name('inicio');
Route::post('/registrarfb', 'Auth\RegistrarJugador@fb')->name('registerfb.submit');
