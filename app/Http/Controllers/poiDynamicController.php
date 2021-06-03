<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poi;
use App\Models\Municipio;
use App\Models\Tipologia;
use App\Models\Poi_Tipologia;

class poiDynamicController extends Controller
{

    //Obtener PoIs de acuerdo a lo que se escribe (Info propia (ID, nombre))
    public function searchPoi(Request $request){

        $term = $request->get('term');
        if(is_null($term)){
            $querys = Poi::select('id_poi', 'nombre')->get();
        }else{
            $querys = Poi::select('id_poi', 'nombre')->where('nombre', 'LIKE', '%' . $term . '%')->get();
        }
        
        $data = [];

        foreach ($querys as $query) {
            $data[] = [
                'label' => $query->nombre,
                'id' => $query->id_poi
            ];
        }
        return $data;
    }


    //Obtener info de un PoI traido por un ID (Info propia, PoixTipologia)
    public function getSelectedPoi(Request $request){
        $id = $request->get('id');
        $querysP = Poi::select('id_poi', 'nombre', 'coordenadax', 'coordenaday', 'costo', 'tiempoestancia', 'descripcion', 'estado', 'fk_id_municipio','imagen')->where('id_poi', '=', $id)->get();

        $querysPT = Poi_Tipologia::select('fk_id_tipologia')->where('fk_id_poi', '=', $id)->where('estado', '=', true)->get();

        return [$querysP, $querysPT];
    }


    //Obtener info de todos los Municipios y Tipologias (Info propia de las dos)
    public function fillAdminPoi(){
        $querysM = Municipio::get();
        $querysT = Tipologia::get();

        return [$querysM, $querysT];
    }


    //Obtener info de todos los PoIs (Info de PoI (ID, nombre))
    public function getAllPois(Request $request){
        $all = $request->get('quantity');
        if($all=="1"){
            $pois = Poi::select('id_poi', 'nombre')->get();
            return $pois;
        }else{
            $pois = Poi::select('id_poi', 'nombre')->where('estado','=',1)->get();
            return $pois;
        }
    }

    //Obtener info de un PoI traido por un ID (Info propia, municipio especifico, tipologia especifica, PoixTipologia del ID)
    public function getAllSelectedPoi(Request $request){
        $id = $request->get('id');

        $poi = Poi::select('nombre', 'coordenadax', 'coordenaday', 'costo', 'tiempoestancia', 'descripcion', 'estado', 'imagen')->where('id_poi', '=', $id)->get();

        $tipologias =Tipologia::select('nombre')->leftjoin('poi_tipologia','fk_id_tipologia','=','id_tipologia')->where([['fk_id_poi','=',$id],['poi_tipologia.estado','=',1],['tipologia.estado','=',1]])->get();

        $municipio = Poi::select('municipio.nombre')->leftjoin('municipio','id_municipio','=','fk_id_municipio')->where('id_poi','=',$id)->get();

        return [$poi, $municipio, $tipologias];
    }

    

}
