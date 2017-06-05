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

      'desactivar'      =>  ['url'=>route('desactivar'),'metodo'=>'get'],
      'modificar'       =>  ['url'=>route('modificar'),'metodo'=>'post'];
      'modificar'       =>  ['url'=>route('ver'),'metodo'=>'get'];
      'unirse_partida'  =>  ['url'=>route('unirse'),'unir'=>'post'];
      'ver_partida'     =>  ['url'=>route('ver_partida'),'ver.partida'=>'get'];
      'ver_equipo'      =>  ['url'=>route('ver_equipo'),'ver.equipo'=>'get'];
      'ver_cancha'      =>  ['url'=>route('ver_cancha'),'ver.cancha' = 'get'];
    ];
    }
}
