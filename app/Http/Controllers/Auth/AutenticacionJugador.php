<?php

namespace App\Http\Controllers\Auth;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class AutenticacionJugador extends Controller{
    use AuthenticatesUsers;
    public function __construct(){
        $this->middleware(['guest'],['except' => 'logout']);
    }
    public function login(Request $request){
        if(Auth::guard('jug')->attempt(['correo_ju'=>$request->email,'password'=>$request->contrasena],true))
          return (['estado'=>true,'mensaje'=>'Credenciales Correctos','vista'=>'inicio','info'=>Auth::user()]);
        else
          return (['estado'=>false,'mensaje'=>'Credenciales Incorrectos','vista'=>'login','url'=>route('login')]);
    }
    public function checklog(){
      if (Auth::viaRemember() || Auth::check())
        return (['estado'=>true,'mensaje'=>'Credenciales guardados','vista'=>'inicio','info'=>Auth::user()]);
      else
        return (['estado'=>true,'mensaje'=>'Credenciales no guardados','vista'=>'login','url'=>route('login')]);
    }
    public function logout(){
      Auth::guard('jug')->logout();
      return (['estado'=>false,'mensaje'=>'Sesion cerrada','vista'=>'login']);
    }
}
