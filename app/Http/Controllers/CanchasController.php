<?php

namespace App\Http\Controllers;

use Validator;
use App\Cancha;
use App\Partida;
use Illuminate\Http\Request;

class CanchasController extends Controller{

    /*
     * funcion sin paramentros
     *  devuelve el listado de canchas registradas en la base de datos
     * */
    public function index(){
        $canchas  =   Cancha::all();
        return $canchas;
    }

    /*
     * funcion que elimina una cancha
     * primero verifica que la cancha no haya sido usada en una partida
     *
     * resive @elemnto donde se encuentra el id de la cancha a eliminar
     * */
    public function delete(Request $elemento){
        $validacion = Validator::make($elemento->all(), [
            'codigo'      => 'required|numeric',
        ]);
        if($validacion->fails())
            return (['estado'=>false,'mensaje'=>'Falta el codigo de cancha']);
        else{
            $partidas   =   Partida::where('id_ca',$elemento->codigo)->get();
            if(count($partidas))
                return (['estado'=>false,'mensaje'=>'No se puede borrar la cancha ya se encuentra registra una partida']);
            else{
                $cancha =   Cancha::find($elemento->codigo);
                if($cancha){
                    $cancha->delete();
                    return (['estado'=>true,'mensaje'=>'Se borro la cancha correctamente']);
                }else
                    return (['estado'=>false,'mensaje'=>'No existe la cancha']);
            }
        }
    }

    /*
     * funcion que guarda una cancha en la base
     * recibe @elemnto donde
     *              descripcion
     *              sector
     *              tipo
     *              latitud
     *              longitud
     * */
    public function store(Request $elemento){
        $validacion = Validator::make($elemento->all(), [
            'descripcion'   => 'required',
            'latitud'       => 'required|numeric',
            'longitud'      => 'required|numeric',
        ]);
        if($validacion->fails())
            return (['estado'=>false,'mensaje'=>'Faltan campos']);
        else{
            $cancha =   new Cancha();
            $cancha->descripcion_ca =   $elemento->descripcion;
            $cancha->sector_ca      =   $elemento->sector;
            $cancha->tipo_ca        =   $elemento->tipo;
            $cancha->latitud_ca     =   $elemento->latitud;
            $cancha->longitu_ca     =   $elemento->longitud;
            $nombre=$cancha->descripcion_ca;
            if($cancha->save())
                return (['estado'=>true,'mensaje'=>"Se guardo correctamente $nombre"]);
            else
                return (['estado'=>false,'mensaje'=>"No se pudo guardar $nombre, reintente"]);
        }
    }
}
