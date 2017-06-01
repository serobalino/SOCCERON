<?php

namespace App\Http\Controllers\Auth;

use App\Jugador;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegistrarJugador extends Controller{
    use RegistersUsers;

    protected $redirectTo = '/#login';

    public function __construct(){
        $this->middleware('guest');
    }

    protected function validator(array $data){
        $a= Validator::make($data, [
            'nombre' => 'required|max:20',
            'correo' => 'required|email|max:100',
            'contrasena' => 'required|min:6',
        ]);
        return($a);
    }

    protected function create(array $data){
      $jugador = new Jugador;
      $jugador->nombre_ju     = $data['nombre'];
      $jugador->correo_ju     = $data['correo'];
      $jugador->contrasena_ju = bcrypt($data['contrasena']);
      $jugador->save();
    }
}
