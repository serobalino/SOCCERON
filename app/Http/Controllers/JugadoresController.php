<?php

namespace App\Http\Controllers;
use Validator;
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
  public function modificarjugador(Request $datos)
  {
    $validacion = Validator::make($datos->all(), [
        'nombre'      => 'required',
        'contrasena'  => 'required',
    ]);
    if ($validacion->fails()) {
      return (['return'=>false,'mensaje'=>'Faltan campos']);
    }
    else{
      $jugador  = Jugador::find(Auth::id());//extrae el id cuando esta logueado y los datos de la base con todos los campos

          $jugador->nombre_ju     = $datos->nombre;
          $jugador->contrasena_ju = bcrypt($datos->contrasena);

          if($jugador->save())
            return (['return'=>true,'mensaje'=>'Se registro con exito']);
          else
            return (['return'=>false,'mensaje'=>'No se pudo registrar reintente']);
  }
}
  public function verjugador()
  {
    return Auth::user();
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
