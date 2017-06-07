<?php

namespace App\Http\Controllers;
use App\Partidos;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Partidos;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class PartidosController extends Controller
{
<<<<<<< HEAD
    public function index(){
      $part=Partidos::all();
      return $part;
    }
=======

  public function __construct(){
      $this->middleware('guest');
  }

  public function crearpartida(Request $datos){
    $validacion = Validator::make($datos->all(), [
        'idEquipo'      => 'required',
        'idCancha'      => 'required',
        'fechaPartido'  => 'required',
    ]);
    if ($validacion->fails()) {
      return (['return'=>false,'mensaje'=>'Faltan campos']);
    }
    else{
        $partido = new Partido;
        $partido->id_eq     = $datos['idEquipo'];
        $partido->id_can     = $datos['idCancha'];
        $partido->fecha_part = bcrypt($datos['fechaPartido']);
        if($partido->save())
          return (['return'=>true,'mensaje'=>'Se registro con exito']);
        else
          return (['return'=>false,'mensaje'=>'Partido no se pudo registrar reintente']);
      }
    }


>>>>>>> origin/master
    public function crearpartida(Request $datos){
      $part = new Jugador();
      $part->id_part    = $datos->id;
      $part->id_eq    = $datos->ideo;
      $part->id_ca    = $datos->idc;
      $part->fecha_part= $datos->fecha;
      $part->estado_ju= $datos->estadp;

      if(part->save())
        return "Se creo la partida correctamente";
      else
        return "No se creo la partida";
    }
    public function modificarpartida(Request $datos){
      return "hols";
    }
    public function eliminarpartida(){
      return "hola";
    }
    public function mostrarpartida(){
    $variable=Modelo::where('estado',true)->get();
    return $variable;
    }
}
