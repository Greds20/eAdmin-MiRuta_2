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
        $querysP = Poi::select('id_poi', 'nombre', 'coordenadax', 'coordenaday', 'tiempoestancia', 'descripcion', 'estado', 'fk_id_municipio','imagen')->where('id_poi', '=', $id)->get();

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
        $quantity = $request->get('quantity');
        if($quantity=="1"){
            $querys = Poi::select('id_poi', 'nombre')->get();
            return $querys;
        }else{
            $querys = Poi::select('id_poi', 'nombre')->where('estado','=','true')->get();
            return $querys;
        }
    }

    //Obtener info de un PoI traido por un ID (Info propia, municipio especifico, tipologia especifica, PoixTipologia del ID)
    public function getAllSelectedPoi(Request $request){
        $id = $request->get('id');

        $querysP = Poi::select('id_poi', 'nombre', 'coordenadax', 'coordenaday', 'tiempoestancia', 'descripcion', 'estado', 'fk_id_municipio', 'imagen')->where('id_poi', '=', $id)->get();

        $querysM = Municipio::get();
        $querysT = Tipologia::get();

        $querysPT = Poi_Tipologia::select('fk_id_tipologia')->where('fk_id_poi', '=', $id)->where('estado', '=', true)->get();

        $dataM = [];

        foreach ($querysM as $queryM) {
            if($queryM->id_municipio == $querysP[0]->fk_id_municipio){
                $dataM[] = [
                    'nombre' => $queryM->nombre,
                    'id' => $queryM->id_municipio
                ];
            }
        }

        $dataPT = [];

        foreach ($querysPT as $queryPT) {
            foreach ($querysT as $queryT) {
                if($queryPT->fk_id_tipologia == $queryT->id_tipologia){
                    $dataPT[] = [
                        'nombre' => $queryT->nombre,
                        'id' => $queryT->id_tipologia
                    ];
                }
            }
        }
        return [$querysP, $dataM, $dataPT];
    }

    

}
