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
Route::get('/', 'Auth\AutenticacionJugador@checklog')->name('verificar');

Route::get('/ingresar', 'Auth\AutenticacionJugador@checklog')->name('login');
Route::post('/ingresar', 'Auth\AutenticacionJugador@login')->name('login.submit');
Route::delete('/ingresar', 'Auth\AutenticacionJugador@logout')->name('logout');

Route::post('/registrar', 'Auth\RegistrarJugador@register')->name('register.submit');
Route::get('/jugadores', 'JugadoresController@index')->name('inicio');
