<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Establecimiento;

class establecimientoDynamicController extends Controller
{

    public function searchAEstab(Request $request){
        if(is_null($request->get('term'))){
        	if($request->get('state') == "1"){
        		$querys = Establecimiento::select('id_tipologia', 'nombre')->get();
        	}else{
        		$querys = Establecimiento::select('id_tipologia', 'nombre')->where('estado','=','true')->get();
        	}
        }else{
        	if($request->get('state') == "1"){
        		$querys = Establecimiento::select('id_tipologia', 'nombre')->where('nombre', 'LIKE', '%' . $request->get('term') . '%')->get();
        	}else{
        		$querys = Establecimiento::select('id_tipologia', 'nombre')->where([['nombre', 'LIKE', '%' . $request->get('term') . '%'],['estado','=','true']])->get();
        	}
        }
        
        $data = [];

        foreach ($querys as $query) {
            $data[] = [
                'label' => $query->nombre,
                'id' => $query->id_tipologia
            ];
        }
        return $data;
    }

    public function searchEstab(Request $request){
        if(is_null($request->get('term'))){
        	$querys = Establecimiento::select('id_tipologia', 'nombre')->get();
        }else{
        	$querys = Establecimiento::select('id_tipologia', 'nombre')->where('nombre', 'LIKE', '%' . $request->get('term') . '%')->get();
        }
        
        $data = [];

        foreach ($querys as $query) {
            $data[] = [
                'label' => $query->nombre,
                'id' => $query->id_tipologia
            ];
        }
        return $data;
    }

    //Obtener info de una tipología traida por un ID (Info propia)
    public function getSelectedEstab(Request $request){
        $id = $request->get('id');
        $sTipologia = Establecimiento::select('id_tipologia', 'nombre', 'descripcion', 'estado')->where('id_tipologia', '=', $id)->get();

        return $sTipologia;
    }

    //Obtener tipologias
    public function fillAdminPoi(){
        $tipologias = Establecimiento::select('id_tipologia','nombre')->get();
        return $tipologias;
    }

}
