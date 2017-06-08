<?php

namespace App\Http\Controllers;

use App\Equipo;
use App\Partida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EquiposController extends Controller{

    /*
     * funcion que guarda en equipo
     * cuando un jugador se une a una partida
     * recibe @partida con
     *              partido=> id de partido
     *
     *
     * */
    public function store(Request $partida){
        $validacion = Validator::make($partida->all(), [
            'partido'      => 'required|numeric',
        ]);
        if($validacion->fails())
            return (['estado'=>false,'mensaje'=>'Faltan campos']);
        else{
            $numero     =   Equipo::where('id_pa',$partida->partido)->get();
            $partido    =   Partida::find($partida->partido);
            if(count($numero) < $partido->jugadores_pa){
                $equipo =   new Equipo();
                $equipo->id_pa  =   $partida->partido;
                $equipo->id_ju  =   Auth::id();
                if($equipo->save())
                    return (['estado'=>true,'mensaje'=>"Se a unido a un Partido"]);
                else
                    return (['estado'=>false,'mensaje'=>"No se pudo unir, intente denuevo"]);
            }else{
                return (['estado'=>false,'mensaje'=>"Ya no hay cupo en el Partido"]);
            }
        }
    }

    /*
     * funcion que elimina un registro de equipo
     * verifica primero si existe el registro para eliminarlo
     * recibe @partida con
     *          partido=> ide la partida
     *
     * */
    public function delete(Request $partida){
        $validacion = Validator::make($partida->all(), [
            'partido'      => 'required|numeric',
        ]);
        if($validacion->fails())
            return (['estado'=>false,'mensaje'=>'Falta el codigo de cancha']);
        else{
            $unidas   =   Equipo::where('id_pa',$partida->codigo)->where('id_ju',Auth::id())->get();
            if(count($unidas))
                return (['estado'=>false,'mensaje'=>'Usted no se a unido a ese Partido']);
            else{
                $desunir =   Equipo::where('id_pa',$partida->codigo)->where('id_ju',Auth::id())->delete();
                if($desunir)
                    return (['estado'=>true,'mensaje'=>'Se ha desunido de el Partido']);
                else
                    return (['estado'=>false,'mensaje'=>'No se ha podido desunir, reintente']);
            }
        }
    }

}
