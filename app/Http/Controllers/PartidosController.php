<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Partidos;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

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
        $partido->fecha_part = bcrypt($datos['fechaPartido']);
        if($partido->save())
          return (['return'=>true,'mensaje'=>'Se registro con exito']);
        else
          return (['return'=>false,'mensaje'=>'No se pudo registrar reintente']);
      }
    }
  }
