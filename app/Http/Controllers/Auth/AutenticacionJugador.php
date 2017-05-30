<?php

namespace App\Http\Controllers\Auth;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class AutentificarJugador extends Controller{
    use AuthenticatesUsers;
    public function __construct(){
        $this->middleware(['guest'],['except' => 'logout']);
    }
    public function login(Request $request){
        if(Auth::guard('jua')->attempt(['cedula_ju'=>$request->cedula,'password'=>$request->contrasena],true))
            return redirect()->intended(route('jugador.inicio'));
    }
    public function logout(){
        Auth::guard('jua')->logout();
        return redirect('/');
    }
}
