<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Validator;
use App\Equipo;
use App\Partida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;

class PartidasController extends Controller{

    /*
     * funcion que lista todas las partidas activas menos las del jguador
     * con una descricion de jugadores inscritos y el detalle de la cancha
     *
     * */
    public function index1(){
        $partidas   =   DB::table('partidas')
                            ->join('canchas','canchas.id_ca','=','partidas.id_ca')
                            ->where('estado_pa',true)
                            ->select(DB::raw("id_pa id_,empieza_pa,jugadores_pa,(SELECT COUNT(*) FROM equipos WHERE id_pa=id_) actuales_pa,descripcion_ca,sector_ca,tipo_ca,latitud_ca,longitu_ca"))->get();

        Date::setLocale('es');

        $usuario = Auth::id();
        foreach ($partidas as $item){
            $subsonsulta            =   Equipo::join('jugadores','jugadores.id_ju','=','equipos.id_ju')->where('id_pa',$item->id_)->where('creador_co',true)->get();
            $subsonsulta2           =   Equipo::where('id_pa',$item->id_)->where('id_ju',$usuario)->get();
            if($subsonsulta[0]->id_ju!==$usuario){
                $a['id_']               =   $item->id_;
                $a['empieza_pa']        =   Date::createFromFormat('Y-m-d H:i:s',$item->empieza_pa)->diffForHumans();
                $a['dia_pa']            =   Date::createFromFormat('Y-m-d H:i:s',$item->empieza_pa)->format('l d F Y');
                $a['hora_pa']           =   Date::createFromFormat('Y-m-d H:i:s',$item->empieza_pa)->format('H:i');
                $a['jugadores_pa']      =   $item->jugadores_pa;
                $a['actuales_pa']       =   $item->actuales_pa;
                $a['descripcion_ca']    =   $item->descripcion_ca;
                $a['sector_ca']         =   $item->sector_ca;
                $a['tipo_ca']           =   $item->tipo_ca;
                $a['latitud_ca']        =   $item->latitud_ca;
                $a['longitu_ca']        =   $item->longitu_ca;
                $a['creador']           =   $subsonsulta[0]->nombre_ju;
                $a['registrado']        =   count($subsonsulta2);
                $b[]                    =   $a;
            }
        }
        if(!isset($b))
            return [];
        else
            return $b;
    }

    /*
     * partidas activas del jugador
     *
     * */

    public function index2(){
        $partidas   =   DB::table('partidas')
            ->join('canchas','canchas.id_ca','=','partidas.id_ca')
            ->select(DB::raw("id_pa id_,empieza_pa,jugadores_pa,(SELECT COUNT(*) FROM equipos WHERE id_pa=id_) actuales_pa,descripcion_ca,sector_ca,tipo_ca,latitud_ca,longitu_ca"))->get();
        Date::setLocale('es');

        $usuario = Auth::id();
        foreach ($partidas as $item){
            $subsonsulta            =   Equipo::join('jugadores','jugadores.id_ju','=','equipos.id_ju')->where('id_pa',$item->id_)->where('creador_co',true)->get();
            if($subsonsulta[0]->id_ju===$usuario){
                $a['id_']               =   $item->id_;
                $a['empieza_pa']        =   Date::createFromFormat('Y-m-d H:i:s',$item->empieza_pa)->diffForHumans();
                $a['dia_pa']            =   Date::createFromFormat('Y-m-d H:i:s',$item->empieza_pa)->format('l d F Y');
                $a['hora_pa']           =   Date::createFromFormat('Y-m-d H:i:s',$item->empieza_pa)->format('H:i');
                $a['jugadores_pa']      =   $item->jugadores_pa;
                $a['actuales_pa']       =   $item->actuales_pa;
                $a['descripcion_ca']    =   $item->descripcion_ca;
                $a['sector_ca']         =   $item->sector_ca;
                $a['tipo_ca']           =   $item->tipo_ca;
                $a['latitud_ca']        =   $item->latitud_ca;
                $a['longitu_ca']        =   $item->longitu_ca;
                $a['creador']           =   $subsonsulta[0]->nombre_ju;
                $b[]                    =   $a;
            }
        }
        if(!isset($b))
            return [];
        else
            return $b;
    }

    /*
     * devuelve el resultado de una partida
     *
     *
     *
     *
     * */
    public function show($id){
        $partidas   =   DB::table('partidas')
            ->join('canchas','canchas.id_ca','=','partidas.id_ca')
            ->where('id_pa',$id)
            ->select(DB::raw("id_pa id_,empieza_pa,jugadores_pa,estado_pa,(SELECT COUNT(*) FROM equipos WHERE id_pa=id_) actuales_pa,descripcion_ca,sector_ca,tipo_ca,latitud_ca,longitu_ca"))->first();

        Date::setLocale('es');

        $usuario = Auth::id();

                $subsonsulta            =   Equipo::join('jugadores','jugadores.id_ju','=','equipos.id_ju')->where('id_pa',$partidas->id_)->where('creador_co',true)->first();
                $a['id_']               =   $partidas->id_;
                $a['empieza_pa']        =   Date::createFromFormat('Y-m-d H:i:s',$partidas->empieza_pa)->diffForHumans();
                $a['dia_pa']            =   Date::createFromFormat('Y-m-d H:i:s',$partidas->empieza_pa)->format('l d F Y');
                $a['hora_pa']           =   Date::createFromFormat('Y-m-d H:i:s',$partidas->empieza_pa)->format('H:i');
                $a['jugadores_pa']      =   $partidas->jugadores_pa;
                $a['actuales_pa']       =   $partidas->actuales_pa;
                $a['descripcion_ca']    =   $partidas->descripcion_ca;
                $a['sector_ca']         =   $partidas->sector_ca;
                $a['tipo_ca']           =   $partidas->tipo_ca;
                $a['latitud_ca']        =   $partidas->latitud_ca;
                $a['longitu_ca']        =   $partidas->longitu_ca;
                $a['fb_ju']             =   $subsonsulta->fb_ju;
                $a['registrados']       =   Equipo::join('jugadores','jugadores.id_ju','=','equipos.id_ju')->where('id_pa',$partidas->id_)->get();

                $a['activo']            =   $partidas->estado_pa;

                if($subsonsulta->id_ju===$usuario) {
                    $a['creador']       =   'Yo';
                    $a['estado']        =   -1;//creador    DESACTIVAR PARTIDA
                }else {
                    $a['creador']       =   $subsonsulta->nombre_ju;
                    $numero             =   Equipo::where('id_pa',$partidas->id_)->where('id_ju',$usuario)->get();
                    if(count($numero)===0)
                        $a['estado']    =   0;//unierse     UNIRSE
                    else
                        $a['estado']    =   1;//des         DESUNIRSE
                }
        return $a;
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
            //validación de patido guardado
            if($partida->save()) {
                $equipo =   new Equipo();
                $equipo->id_pa      =   $partida->id_pa;
                $equipo->id_ju      =   Auth::id();
                $equipo->creador_co =   true;
                $equipo->save();

                return (['estado' => true, 'mensaje' => "Se guardo correctamente el Partido"]);
            }else
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
      //valida la partida por codigo
        $validacion = Validator::make($elementos->all(), [
            'codigo'      => 'required|numeric',
        ]);//si la validacion falla es porque no se ha ingresado un codigo de la partida
        //y no se podra cambiar el estado de la partida
        if($validacion->fails())
            return (['estado'=>false,'mensaje'=>'Falta el codigo de Partida']);//se mostrara el siguiente mensaje
        else{
            $partido =   Partida::find($elementos->codigo);//busca la partida por codigo
            if($partido){
                $partido->estado_pa =   false;//la partida cambia de estado a falso
                $partido->save();//se guardo el cambio realizado
                return (['estado'=>true,'mensaje'=>'Se ha desactivado el Partido']);// al desactivar la partida su estado cambia y se muestra
                //se muestra el emnsaje de desactiva
            }else
            //caso contrario no se cambiara el estado porque pueda que la partida ni exista
                return (['estado'=>false,'mensaje'=>'No existe el Partido']);
          }
    }


    /**
     *
     *
     *
     *
     *
     * */
    public function dardeBaja(){
        //$query  =   Partida::where('empieza_pa',)
        Date::setLocale('es');
        $a = Date::now()->format('Y-m-d H:i:s');

        $query  =   Partida::where('empieza_pa','<',$a)->update(['estado_pa' => 0]);

        return $query;
    }
}
