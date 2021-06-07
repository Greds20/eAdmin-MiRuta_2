<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seccion;
use App\Models\Log;
use App\Models\Evento;
use App\Models\Log_AI;
use App\Models\Administrador;

class logDynamicController extends Controller
{
    public function fillLogElements(){
    	//Traer la fecha del primer registro de Log
    	$firstDate = Log::select('fecha')->where('id_log','=',1)->get();
    	//Traer la fecha del último registro de Log
        $lastId = ((Log_AI::select('AUTO_INCREMENT')->where([['TABLE_SCHEMA','=','ruta'],['TABLE_NAME','=','log']])->get())[0]->AUTO_INCREMENT)-1;
    	$lastDate = Log::select('fecha')->where('id_log','=',$lastId)->get();
    	//Traer todos los eventos
    	$events = Evento::get();
    	//Traer todas las secciones
    	$sections = Seccion::get();
    	return [$firstDate, $lastDate, $events, $sections];
    }

    public function searchUser(Request $request){
        if(is_null($request->get('term'))){
            $admins = Administrador::select('alias')->where('estado','=',1)->get();
        }else{
            $admins = Administrador::select('alias')->where([['alias', 'LIKE', $request->get('term') . '%'],['estado','=',1]])->get();
        }
        return $admins;
    }

    public function consultLog(Request $request){
        $trueDates = (!is_null($request->desde) && !is_null($request->hasta)) ? true : false;
        $where = '';
        if(!is_null($request->alias)){
            $adminId = (Administrador::select('id_administrador')->where('alias','=',$request->alias)->get())[0]->id_administrador;
            $where = 'fk_id_administrador = ' . $adminId;
        }
        if($request->seccion>0){
            if(!empty($where))
                $where .= ' AND ';
            $where .= 'fk_id_seccion = ' . $request->seccion;
        }
        if($request->evento>0){
            if(!empty($where))
                $where .= ' AND ';
            $where .= 'fk_id_evento = ' . $request->evento;
        }
        if($trueDates){
            if(!empty($where))
                $where .= ' AND ';
            $where .= 'fecha >= \'' . $request->desde . '\' AND ' . 'fecha <= \'' . $request->hasta . '\'';
        }
        if(empty($where)){
            $log = Log::select('alias','fecha','hora','seccion.nombre as seccion','evento.nombre as evento')->leftjoin('administrador','fk_id_administrador','=','id_administrador')->leftjoin('seccion','fk_id_seccion','=','id_seccion')->leftjoin('evento','fk_id_evento','=','id_evento')->get();
        }else{

            $log = Log::select('alias','fecha','hora','seccion.nombre as seccion','evento.nombre as evento')->leftjoin('administrador','fk_id_administrador','=','id_administrador')->leftjoin('seccion','fk_id_seccion','=','id_seccion')->leftjoin('evento','fk_id_evento','=','id_evento')->whereRaw($where)->get();
        }
        
        return $log;
    }
}
