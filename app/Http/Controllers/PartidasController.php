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
        if($validacion->fails())//si la validación falla, no se podrá ingresar una partida
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
       //validaciones necesarias sobre el usuario logueado
       //ademas de codigo ingresado para poder eliminar
         $validacion = Validator::make($elementos->all(), [
             'codigo'      => 'required|numeric',
         ]);
         //si la validacion falla, entonces no se podra eliminar una partida que no existe

         if($validacion->fails())
             return (['estado'=>false,'mensaje'=>'Falta el codigo de Partida']);
             //de lo contrario se eliminara con exito la partida segun el codigo ingresado
         else{
             $jugadores   =   Equipo::where('id_pa',$elementos->codigo)->get();//se realiza una validacion x si hay jugadores registrados en la partida
             //no se podra eliminar una partida en la que tenga varios jugadores asignados ya q borraria tb a los jugadores
             if(count($jugadores))
                 return (['estado'=>false,'mensaje'=>'No se puede borrar el Partido se encuentra registrado jugadores']);//si la partida consta de jugadores no se borraria
                 //en ese caso se podria eliminar la partida si tiene un estado inactivo
                 //nuevamente se hace la verificacion x codigo de partida
             else{
                 $partido =   Partida::find($elementos->codigo);//se busca la partida x el codigo ingresado
                 if($partido){
                     $partido->delete();//si se encuentra la partida correctamente se procedera a cambiar su estado
                     //cambiamos el estado de la partida para que se pueda eliminar sin problemas
                     //siempre y cuando el estado de la partida este en false, se borrara la partida sin ningun problemas
                     //ya no tendremos que preocuparnos de los jugadores registrados
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
