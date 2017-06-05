<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EquiposController extends Controller
{
  public function index()
  {
    $datosEq=Equipo::all();
      return $datosEq;
  }
  public function ingresar(Request $datos){
    $datosEq = new Equipo();
    $datosEq->id_eq    = $datos->id;
    $datosEq->descripcion_eq   = $datos->descripcion;
    $datosEq->fecha_eq    = $datos->fecha;

    if($cualquiera->save())
      return "Se guardo correctamente";
    else
      return "No se guardo";
  }


}
