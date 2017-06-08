<?php

namespace App\Http\Controllers;

use Validator;
use App\Equipo;
use App\Partida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PartidasController extends Controller{

    /*
     * funcion que lista todas las partidas activas
     * con una descricion de jugadores inscritos y el detalle de la cancha
     *
     * */
    public function index(){
        $partidas   =   DB::table('partidas')
                            ->join('canchas','canchas.id_ca','=','partidas.id_ca')
                            ->where('estado_pa',true)
                            ->select(DB::raw("id_pa id_,empieza_pa,jugadores_pa,(SELECT COUNT(*) FROM equipos WHERE id_pa=id_) actuales_pa,descripcion_ca,sector_ca,tipo_ca,latitud_ca,longitu_ca"))->get();
        return $partidas;

    }

    /*
     * funcion que ingresa una nueva partida
     * se recibe en @elemento
     *                  cancha=> codigo de cancha
     *                  fecha
     *                  jugadores
     *
     * */
    public function store(Request $elementos){
        $validacion = Validator::make($elementos->all(), [
            'cancha'    => 'required|numeric',
            'fecha'     => 'required',
            'jugadores' => 'required|numeric',
        ]);
        if($validacion->fails())
            return (['estado'=>false,'mensaje'=>'Faltan campos']);
        else{
            $partida    =   new Partida();
            $partida->id_ca         =   $elementos->cancha;
            $partida->empieza_pa    =   $elementos->fecha;
            $partida->jugadores_pa  =   $elementos->jugadores;
            if($partida->save())
                return (['estado'=>true,'mensaje'=>"Se guardo correctamente el Partido"]);
            else
                return (['estado'=>false,'mensaje'=>"No se pudo guardar el Partido, reintente"]);
        }
    }

    /*
     * funcion que elimina una partida
     * verifica que no tenga jugadores registrados antes
     * se recibe @elemnto
     *              codigo=> codigo de cancha
     *
     * */
    public function delete(Request $elementos){
        $validacion = Validator::make($elementos->all(), [
            'codigo'      => 'required|numeric',
        ]);
        if($validacion->fails())
            return (['estado'=>false,'mensaje'=>'Falta el codigo de Partida']);
        else{
            $jugadores   =   Equipo::where('id_pa',$elementos->codigo)->get();
            if(count($jugadores))
                return (['estado'=>false,'mensaje'=>'No se puede borrar el Partido se encuentra registrado jugadores']);
            else{
                $partido =   Partida::find($elementos->codigo);
                if($partido){
                    $partido->delete();
                    return (['estado'=>true,'mensaje'=>'Se borro el Partido correctamente']);
                }else
                    return (['estado'=>false,'mensaje'=>'No existe el Partido']);
            }
        }

    }

    /*
     * funcion que cambia el estado a un partida
     * verifica que no tenga jugadores registrados antes
     * se recibe @elemnto
     *              codigo=> codigo de cancha
     *
     * */
    public function status(Request $elementos){
        $validacion = Validator::make($elementos->all(), [
            'codigo'      => 'required|numeric',
        ]);
        if($validacion->fails())
            return (['estado'=>false,'mensaje'=>'Falta el codigo de Partida']);
        else{
            $partido =   Partida::find($elementos->codigo);
            if($partido){
                $partido->estado_pa =   false;
                $partido->save();
                return (['estado'=>true,'mensaje'=>'Se ha desactivado el Partido']);
            }else
                return (['estado'=>false,'mensaje'=>'No existe el Partido']);
            }
    }
}
