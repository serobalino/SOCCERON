<?php

namespace App\Http\Controllers;
use App\Partidos;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PartidosController extends Controller
{
    public function crearpartida(Request $datos){
      return "hola";
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
