<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RutasController extends Controller{

//lista de actividades y route es de donde obtnego informacion
  public function index(){
    $lista  = [
      'comprobarLogin'  =>  ['url'=>route('comprobar'),'metodo'=>'get'],
      'login'           =>  ['url'=>route('login.submit'),'metodo'=>'post'],
      'registrar'       =>  ['url'=>route('register.submit'),'metodo'=>'post'],
      'logout'          =>  ['url'=>route('logout'),'metodo'=>'delete']
    ];
    return $lista;
  }

  public function funcionesjugador(){
    $lista =[

      'desactivar'      =>  route('desactivar'),
      'modificar'       =>  route('modificar'),
      'unirse_partida'  =>  route('unirse'),
      'ver_partida'     =>  route('ver_partida'),
      'ver_equipo'      =>  route('ver_equipo'),
      'ver_cancha'      =>  route('registrar'),
    ];
    }
}
