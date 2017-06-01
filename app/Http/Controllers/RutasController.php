<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RutasController extends Controller{

  public function index(){
    $lista  = [
      'comprobarLogin'  =>  route('comprobar'),
      'login'           =>  route('login.submit'),
      'registrar'       =>  route('register.submit'),
      'logout'          =>  route('logout'),
    ];
    return $lista;
  }
}
