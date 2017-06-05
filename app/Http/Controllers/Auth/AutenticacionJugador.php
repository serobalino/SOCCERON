<?php

namespace App\Http\Controllers\Auth;
use Auth;
use App\Jugador;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class AutenticacionJugador extends Controller{
    use AuthenticatesUsers;
    public function __construct(){
        $this->middleware(['guest'],['except' => 'logout']);
    }
    //hace login
    public function login(Request $request){
        if(Auth::guard('jug')->attempt(['correo_ju'=>$request->correo,'password'=>$request->contrasena],true))
          return (['estado'=>true,'mensaje'=>'Credenciales Correctos','vista'=>'inicio','info'=>Auth::user()]);
        else
          return (['estado'=>false,'mensaje'=>'Credenciales Incorrectos','vista'=>'login','url'=>route('login')]);
    }
    //comprobar que esta logueado
    public function checklog(){
      if (Auth::viaRemember() || Auth::check())
        return (['estado'=>true,'mensaje'=>'Credenciales guardados','vista'=>'inicio','info'=>Auth::user()]);
      else
        return (['estado'=>true,'mensaje'=>'Credenciales no guardados','vista'=>'login','url'=>route('login')]);
    }
    //para logout
    public function logout(){
      Auth::guard('jug')->logout();
      return (['estado'=>false,'mensaje'=>'Sesion cerrada','vista'=>'login']);
    }

    public function fblogin(Request $request){
      $id = Jugador::where('correo_ju',$request->correo)->where('estado_ju',true)->first();
      if($id){
        $id->fb_ju  = $request->fb;
        $id->save();
        Auth::loginUsingId($id->id_ju);
        return (['estado'=>true,'mensaje'=>'Credenciales Correctos','vista'=>'inicio','info'=>Auth::user()]);
      }else
        return (['estado'=>false,'mensaje'=>'Credenciales Incorrectos','vista'=>'registro','url'=>route('registerfb.submit')]);
    }



}
