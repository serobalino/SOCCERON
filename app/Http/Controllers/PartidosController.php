<?php

namespace App\Http\Controllers;
use App\Partidos;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PartidosController extends Controller
{
    public function index(){
      $part=Partidos::all();
      return $part;
    }
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
