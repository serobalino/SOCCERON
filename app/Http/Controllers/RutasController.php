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
      'logout'          =>  ['url'=>route('logout'),'metodo'=>'delete'],
      'activar'         =>  ['url'=>route('activar'),'metodo'=>'post']
    ];
    return $lista;
  }

  public function funcionesjugador(){
    $lista =[
      'desactivar'      =>  ['url'=>route('desactivar'),'metodo'=>'get'],
      'modificarjugador'=>  ['url'=>route('modificar'),'metodo'=>'post'],
      'verjugador'      =>  ['url'=>route('ver'),'metodo'=>'get'],
      'unirse_partida'  =>  ['url'=>route('unir'),'metodo'=>'post'],
      'ver_partida'     =>  ['url'=>route('ver.partida'),'metodo'=>'get'],
      'ver_equipo'      =>  ['url'=>route('ver.equipo'),'metodo'=>'get'],
      'ver_cancha'      =>  ['url'=>route('ver.cancha'),'metodo'=>'get']
    ];
    return $lista;
    }

    public function funcionespartida(){
      $lista=[
        'crearpartida'        -> ['url'=>('crear.partida'),'metodo'=>'post'],
        'modificarpartida'    -> ['url'=>('modificar.partida'),'metodo'=>'post'],
        'eliminarpartida'     -> ['url'=>('eliminar.partida'),'metodo'=>'delete'],
        'mostrarpartida'      -> ['url'=>('mostrarpartida'),'metodo'=>'get']
      ];
    }
}
