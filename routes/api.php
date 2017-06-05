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

//realizamos qui porque la aplicacion da un servicio
//si fuera en web es porque ocupo servicios ya exsistentes

Route::get('/','RutasController@index');
Route::get('/comprobar', 'Auth\AutenticacionJugador@checklog')->name('comprobar');
Route::get('/ingresar', 'Auth\AutenticacionJugador@checklog')->name('login');
Route::post('/ingresar', 'Auth\AutenticacionJugador@login')->name('login.submit');
Route::post('/ingresarfb','Auth\AutenticacionJugador@fblogin')->name('loginfb.submit');
Route::delete('/ingresar', 'Auth\AutenticacionJugador@logout')->name('logout');
Route::post('/registrar', 'Auth\RegistrarJugador@crear')->name('register.submit');
Route::get('/jugadores', 'JugadoresController@index')->name('inicio');
Route::post('/registrarfb', 'Auth\RegistrarJugador@fb')->name('registerfb.submit');



Route::get('/jugador', 'RutasController@funcionesjugador')-> name('funciones');//muestra todas las funciones del jugador
Route::get('/desactivarjugador','JugadoresController@desactivarjugador')->name('desactivar');
Route::post('/modificarjugador', 'JugadoresController@modificarjugador')-> name('modificar');
Route::get('/verjugador', 'JugadoresController@verjugador')-> name('ver');
Route::post('/unirjugador', 'JugadoresController@unirsepartida')-> name('unir');
Route::get('/partidajugador', 'JugadoresController@verpartida')-> name('ver.partida');
Route::get('/equipojugador', 'JugadoresController@verequipo')-> name('ver.equipo');
Route::get('/canchajugador', 'JugadoresController@vercancha')-> name('ver.cancha');
