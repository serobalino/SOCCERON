<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Jugador;

class JugadoresController extends Controller{
  public function index()
  {
    $cualquiera=Jugador::all();
      return $cualquiera;
  }
  /*public function ingresar(Request $datos){
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
  }*/
  //select con limit 1 ->first()
  public function activarjugador(Request $datos){
    $validacion = Validator::make($datos->all(), [
        'correo'      => 'required|email',
    ]);
    if($validacion->fails()){
      return (['estado'=>false,'mensaje'=>'Faltan campos o estan incorrectos','vista'=>'login']);
    }else{
      $cualquiera = Jugador::where('correo_ju',$datos->correo)->first();//select de id autentificado
      if (count($cualquiera)) {
        $cualquiera->estado_ju=true;
        $cualquiera->save();//guarda o actualizar en la base
        return (['estado'=>true,'mensaje'=>'Se ha activado la cuenta','vista'=>'login']);
      }
      else {
        return (['estado'=>false,'mensaje'=>'La cuenta no existe','vista'=>'register.submit']);
  }
}
}
public function desactivarjugador(){
     $cualquiera = Jugador::find(Auth::id());//select de id autentificado
     $cualquiera->estado_ju=false;
     if ($cualquiera->save()) {
       Auth::guard('jug')->logout();//deslogueo
       return (['estado'=>true,'mensaje'=>'Se ha desactivado la cuenta','vista'=>'login']);
     }
    else {
       return (['estado'=>false,'mensaje'=>'Error','vista'=>'inicio']);
 }
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
  public function verequipo()
  {
    return "verquipo";
  }
  public function vercancha()
  {
    return "vercancha";
  }
}
