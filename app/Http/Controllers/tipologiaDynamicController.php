<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tipologia;

class tipologiaDynamicController extends Controller
{

    public function searchATip(Request $request){
        if(is_null($request->get('term'))){
        	if($request->get('state') == "1"){
        		$querys = Tipologia::select('id_tipologia', 'nombre')->get();
        	}else{
        		$querys = Tipologia::select('id_tipologia', 'nombre')->where('estado','=','true')->get();
        	}
        }else{
        	if($request->get('state') == "1"){
        		$querys = Tipologia::select('id_tipologia', 'nombre')->where('nombre', 'LIKE', '%' . $request->get('term') . '%')->get();
        	}else{
        		$querys = Tipologia::select('id_tipologia', 'nombre')->where([['nombre', 'LIKE', '%' . $request->get('term') . '%'],['estado','=','true']])->get();
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

    public function searchTip(Request $request){
        if(is_null($request->get('term'))){
        	$querys = Tipologia::select('id_tipologia', 'nombre')->get();
        }else{
        	$querys = Tipologia::select('id_tipologia', 'nombre')->where('nombre', 'LIKE', '%' . $request->get('term') . '%')->get();
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
    public function getSelectedTip(Request $request){
        $id = $request->get('id');
        $sTipologia = Tipologia::select('id_tipologia', 'nombre', 'descripcion', 'estado')->where('id_tipologia', '=', $id)->get();

        return $sTipologia;
    }

    //Obtener tipologias
    public function fillAdminPoi(){
        $tipologias = Tipologia::select('id_tipologia','nombre')->get();
        return $tipologias;
    }

}
