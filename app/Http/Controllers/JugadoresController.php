<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Jugador;

class JugadoresController extends Controller{

  public function __construct(){
    $this->middleware('auth:jug');
  }

  public function index()
  {
    $cualquiera=Jugador::all();
      return $cualquiera;
  }
  public function ingresar(Request $datos){
    $cualquiera = new Jugador();
    $cualquiera->cedula_ju    = $datos->cedula;
    $cualquiera->nombre_ju    = $datos->nombres;
    $cualquiera->correo_ju    = $datos->email;
    $cualquiera->contrasena_ju= $datos->password;
    if($cualquiera->save())
      return "Se guardo correctamente";
    else
      return "No se guardo";
  }

}
