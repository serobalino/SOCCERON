<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Jugador;

class JugadoresController extends Controller{
  public function index(){
    $cualquiera=Jugador::all();
      return $cualquiera;
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
  public function modificarjugador(){
    return "asdasd";
  }
  public function verjugador(){
    return Auth::user();
  }
  public function unirsepartida(){
    return "unirsepartida";
  }
  public function verpartida(){
    return "verpartida";
  }
  public function verequipo(){
    return "verquipo";
  }
  public function vercancha(){
    return "vercancha";
  }
}
