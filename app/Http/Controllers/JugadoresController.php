<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Jugador;

class JugadoresController extends Controller{

  public function __construct(){
    $this->middleware('auth:jug');
  }
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




    return $cualquiera;

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
