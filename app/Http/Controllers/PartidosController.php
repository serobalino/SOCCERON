<?php

namespace App\Http\Controllers;

use App\Partido;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PartidosController extends Controller
{
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
        $partido->fecha_part = $datos['fechaPartido'];

        if($partido->save())
          return (['return'=>true,'mensaje'=>'Se registro con exito']);
        else
          return (['return'=>false,'mensaje'=>'Partido no se pudo registrar reintente']);
      }
    }
    public function modificarpartida(Request $datos){
      return "hols";
    }
    public function eliminarpartida(){
      return "hola";
    }
    public function mostrarpartida(){
      return "hola";
    }
}
