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
    $cualquiera->id_ju    = $datos->id;
    $cualquiera->nombre_ju    = $datos->nombres;
    $cualquiera->correo_ju    = $datos->email;
    $cualquiera->token_ju= $datos->tokens;
    $cualquiera->fb_ju= $datos->facebook;
    $cualquiera->estado_ju= $datos->estad;

    if($cualquiera->save())
      return "Se guardo correctamente";
    else
      return "No se guardo";
  }
  public function desactivarjugador($datos)
  {

  }
  public function modificarjugador()
  {

  }
  public function verjugador()
  {
    return "hla";
  }

  public function unirsepartida()
  {
    return "unirsepartida";

  }
  public function verpartida()
  {
    return "verpartida";
  }
  public function verequipo()
  {
    return "verquipo";
  }
  public function vercancha()
  {
    return "vercancha";
  }
}
