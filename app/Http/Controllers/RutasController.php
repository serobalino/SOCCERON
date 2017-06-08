<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RutasController extends Controller{

//lista de actividades y route es de donde obtnego informacion
  public function index(){
    $lista  = [
      'comprobarLogin'  =>  ['url'=>route('comprobar'),'metodo'=>'get'],
      'login'           =>  ['url'=>route('login.submit'),'metodo'=>'post'],
      'loginfb'         =>  ['url'=>route('loginfb.submit'),'metodo'=>'post'],
      'registrar'       =>  ['url'=>route('register.submit'),'metodo'=>'post'],
      'registrarfb'     =>  ['url'=>route('registerfb.submit'),'metodo'=>'post'],
      'logout'          =>  ['url'=>route('logout'),'metodo'=>'delete'],
      'activar'         =>  ['url'=>route('activar'),'metodo'=>'post']
    ];
    return $lista;
  }

  public function funcionesjugador(){
    $lista =[
      'desactivar'      =>  ['url'=>route('desactivar'),'metodo'=>'get'],
      'modificarjugador'=>  ['url'=>route('modificar'),'metodo'=>'post'],
      'perfil'          =>  ['url'=>route('ver'),'metodo'=>'get'],

      'ver_cancha'      =>  ['url'=>route('ver.cancha'),'metodo'=>'get'],
      'gua_cancha'      =>  ['url'=>route('guardar.cancha'),'metodo'=>'post'],
      'eli_cancha'      =>  ['url'=>route('eliminar.cancha'),'metodo'=>'delete'],

      'unir'            =>  ['url'=>route('unir'),'metodo'=>'post'],
      'desunir'         =>  ['url'=>route('desunir'),'metodo'=>'delete'],
      'lista'           =>  ['url'=>route('ver.partida'),'metodo'=>'get'],
      'des_partida'     =>  ['url'=>route('estado'),'metodo'=>'get'],

      'ver_partida'     =>  ['url'=>route('ver.partida'),'metodo'=>'get'],
      'gua_partida'     =>  ['url'=>route('guardar.partida'),'metodo'=>'post'],
      'eli_partida'     =>  ['url'=>route('eliminar.partida'),'metodo'=>'delete'],

    ];
    return $lista;
    }

}
