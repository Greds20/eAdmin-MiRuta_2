<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poi;
use App\Models\Factor;
use App\Models\Poi_Factor;

class poiFactorDynamicController extends Controller
{

    public function getSPoiNoF(Request $request){
        $PxF = Poi_Factor::select('fk_id_factor')->leftjoin('factor','id_factor','=','fk_id_factor')->leftjoin('formula','id_formula','=','fk_id_formula')->where([['fk_id_poi','=',$request->get('id')],['factor.estado','=',1],['formula.estado','=',1]])->get();

        $factores = Factor::select('id_factor','factor.nombre','formula.nombre AS formula','valorMinimo','valorMaximo')->leftjoin('formula','id_formula','=','fk_id_formula')->where([['factor.estado','=',1],['formula.estado','=',1]])->get(); 

        $PvF = [];
        for($i = 0; $i<count($factores); $i++){
            $encontrado = false;
            for($j = 0; $j<count($PxF); $j++){
                if($factores[$i]->id_factor == $PxF[$j]->fk_id_factor){
                    $encontrado = true;
                    break;
                }
            }
            if($encontrado == false){
                $PvF[] = $factores[$i];
            }
        }

        return $PvF;
    }

    public function getPoisNoF(){
        $nfactores = Factor::select('id_factor')->leftjoin('formula','id_formula','=','fk_id_formula')->where([['factor.estado','=',1],['formula.estado','=',1]])->count();
        $pois = Poi::select('id_poi','nombre')->where('estado', '=', 1)->get();

        $poisNoF = [];
        for($i = 0; $i<count($pois); $i++){
            $nPxF = Poi_Factor::select('fk_id_poi')->leftjoin('factor','id_factor','=','fk_id_factor')->leftjoin('formula','id_formula','=','fk_id_formula')->where([['factor.estado', '=', 1],['formula.estado','=',1],['fk_id_poi','=',$pois[$i]->id_poi]])->count();
            if($nPxF != $nfactores){
                $poisNoF[]= $pois[$i];
            }
        }
        return $poisNoF;
    }

    public function inspectPoi(){
        $poi = Poi::select('id_poi')->where('estado', '=', 'true')->get();

        $contForm = Formula::where([['estado', '=', 'true'],['id_formula','<>', $NTP[0]->fk_id_ntp]])->count();

        // Factor::select('id_factor')->leftjoin('poi_factor', 'fk_id_factor', '=', 'id_factor')->leftjoin('poi','id_poi','fk_id_poi')->whereNull('fk_id_poi')->where([['fk_id_formula', '=', $request->id],['factor.estado','=',true]])->get();
        Factor::select('id_factor')->leftjoin('poi_factor', 'fk_id_factor', '=', 'id_factor')->leftjoin('poi','id_poi','fk_id_poi')->whereNull('fk_id_poi')->where([['factor.estado','=',true],['poi.estado','=',true]])->get();

        $warnings=0;
        for ($i=0; $i < count($poi); $i++) { 
            $contPxF = Poi::join('poi_formula','id_poi','=','fk_id_poi')->join('formula','id_formula','=','fk_id_formula')->where([['fk_id_poi','=',$poi[$i]->id_poi],['formula.estado','=','true']])->count();
            if($contPxF<$contForm){
                $warnings++;
                if($warnings > 10){
                    $warnings = "+10";
                    break;
                }
            }
        }
        
        return $warnings;
    }

    public function searchPois(Request $request){
        $term = $request->get('term');
        if(is_null($term)){
            $nfactores = Factor::select('id_factor')->leftjoin('formula','id_formula','=','fk_id_formula')->where([['factor.estado','=',1],['formula.estado','=',1]])->count();
            $pois = Poi::select('id_poi','nombre')->where('estado', '=', 1)->get();

            $PxF = [];
            for($i = 0; $i<count($pois); $i++){
                $nPxF = Poi_Factor::select('fk_id_poi')->leftjoin('factor','id_factor','=','fk_id_factor')->leftjoin('formula','id_formula','=','fk_id_formula')->where([['factor.estado', '=', 1],['formula.estado','=',1],['fk_id_poi','=',$pois[$i]->id_poi]])->count();
                if($nPxF == $nfactores){
                    $PxF[]= $pois[$i];
                }
            }
        }else{
            $nfactores = Factor::select('id_factor')->leftjoin('formula','id_formula','=','fk_id_formula')->where([['factor.estado','=',1],['formula.estado','=',1]])->count();
            $pois = Poi::select('id_poi','nombre')->where([['estado', '=', 1],['nombre', 'LIKE', $term . '%']])->get();

            $PxF = [];
            for($i = 0; $i<count($pois); $i++){
                $nPxF = Poi_Factor::select('fk_id_poi')->leftjoin('factor','id_factor','=','fk_id_factor')->leftjoin('formula','id_formula','=','fk_id_formula')->where([['factor.estado', '=', 1],['formula.estado','=',1],['fk_id_poi','=',$pois[$i]->id_poi]])->count();
                if($nPxF == $nfactores){
                    $PxF[]= $pois[$i];
                }
            }
        }
        return $PxF;
    }

    public function getFactoreSPoi(Request $request){
        $PxF = Factor::select('factor.nombre','id_factor','valor', 'formula.nombre AS formula','valorMinimo', 'valorMaximo')->leftjoin('poi_factor','fk_id_factor','=','id_factor')->leftjoin('formula','id_formula','=','fk_id_formula')->where([['factor.estado','=',1],['formula.estado','=',1],['fk_id_poi','=',$request->id]])->get();
        return $PxF;
    }

    public function getFacxsPoi(Request $request){
        $PxF = Factor::select('factor.nombre','valor', 'formula.nombre AS formula')->leftjoin('poi_factor','fk_id_factor','=','id_factor')->leftjoin('formula','id_formula','=','fk_id_formula')->where([['factor.estado','=',1],['formula.estado','=',1],['fk_id_poi','=',$request->id]])->get();
        return $PxF;
    }
}
