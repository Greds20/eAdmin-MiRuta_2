<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poi;
use App\Models\Formula;
use App\Models\Poi_Formula;

class poiFactorDynamicController extends Controller
{

    public function getSPoiNoF(Request $request){
    	$poiId = $request->get('id');
        $poiN = $request->get('name');

        $formula = Formula::select('id_formula','nombre','valorminimo','valormaximo')->where([['estado', '=', 'true'],['id_formula','<>', $NTP[0]->fk_id_ntp]])->get();

        $PxF = Poi::select('id_formula', 'poi.nombre as nombre')->join('poi_formula','id_poi','=','fk_id_poi')->join('formula','id_formula','=','fk_id_formula')->where([['poi.estado','=','true'],['formula.estado','=','true'], ['poi.id_poi','=', $poiId]])->get();

        $PxFTam = count($PxF);
        $PvF = [$poiId, $poiN];
        
        if(empty($PxF)){
            for($i=0; $i<$formTam; $i++){
                $PvF[] = [$formula[$i]->id_formula, $formula[$i]->nombre, $formula[$i]->valorminimo, $formula[$i]->valormaximo];
            }
        }else{
        	$existe = false;
            for($i=0; $i<count($formula); $i++){
                for($j=0; $j<$PxFTam; $j++){
                    if($PxF[$j]->id_formula==$formula[$i]->id_formula){
                        $existe = true;
                    }
                }
                if(!$existe){
                	$PvF[] = [$formula[$i]->id_formula, $formula[$i]->nombre, $formula[$i]->valorminimo, $formula[$i]->valormaximo];
                }else{
                	$existe = false;
                }
            }
        }
        return $PvF;
    }


    // public function getPoisNoF(){
    //     $poi = Poi::select('id_poi','nombre')->where('estado', '=', 'true')->get();

    //     $NTP = Formula_Formula::select('fk_id_ntp')->take(1)->get();

    //     $formula = Formula::select('id_formula')->where([['estado', '=', 'true'],['id_formula','<>', $NTP[0]->fk_id_ntp]])->get();

    //     $PxF = Poi::select('id_poi','id_formula')->join('poi_formula','id_poi','=','fk_id_poi')->join('formula','id_formula','=','fk_id_formula')->where([['poi.estado','=','true'],['formula.estado','=','true']])->get();


    //     $formTam = count($formula);
    //     $PxFTam = count($PxF);
    //     $poiTam = count($poi);
    //     $cont = 0;
    //     //Pois sin pareja completa
    //     $poiUC;
    //     //Factores de pois incompletos auxiliar
    //     $PxFI_aux = [];
    //     //Factores de pois incompletos
    //     $PxFI = [];
    //     //Comprobar que los pois estén emparejados con todos los factores y guardar los pois inconpletos con su respectivo factor
    //     for($i=0; $i<$poiTam; $i++){
    //         $PvF = $formula;
    //     	$cont = 0;
    //     	for($j=0; $j<$PxFTam; $j++){
	   //      	if($poi[$i]->id_poi==$PxF[$j]->id_poi){
	   //      		$cont++;
    //                 $PxFI_aux[] = $PxF[$j]->id_formula; 
	   //      	}
    //     	}
    //     	if($cont < $formTam){
    //     		$poiUC[] = ['poi' => $poi[$i]->id_poi, 'nombre' => $poi[$i]->nombre];
    //             $PxFI[] = $PxFI_aux;
    //     	}
    //         $PxFI_aux = [];
    //     }
        
    //     return $poiUC;
    // }

    public function getPoisNoF(){
        $PvF = Poi::select('id_poi','nombre')->leftjoin()where('estado', '=', 'true')->get();
        
        return $poiUC;
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
            $pois = Poi::select('id_poi', 'poi.nombre')->leftjoin('poi_formula', 'id_poi','=','fk_id_poi')->leftjoin('formula','id_formula','=','fk_id_formula')->whereNotNull('fk_id_formula')->where('poi.estado','=','true')->get();
            

        }else{
            $pois = Poi::select('id_poi', 'poi.nombre')->leftjoin('poi_formula', 'id_poi','=','fk_id_poi')->leftjoin('formula','id_formula','=','fk_id_formula')->whereNotNull('fk_id_formula')->where([['poi.nombre', 'LIKE', '%' . $term . '%'],['poi.estado','=','true']])->get();
        }
        
        $data = [];
        $controlador = "";
        foreach ($pois as $poi) {
            if($controlador!=$poi->nombre){
                $data[] = [
                    'label' => $poi->nombre,
                    'id' => $poi->id_poi
                ];
                $controlador=$poi->nombre;
            }
        }
        return $data;
    }

    public function getFactoreSPoi(Request $request){
        $PxF = Poi::select('fk_id_formula','formula.nombre as nombre','valor','valorminimo', 'valormaximo')->join('poi_formula','id_poi','=','fk_id_poi')->join('formula','id_formula','=','fk_id_formula')->where([['poi.estado','=','true'],['formula.estado','=','true'],['fk_id_poi','=',$request->id]])->get();
        $sPxF = [$request->id, $request->name, $PxF];
        return $sPxF;
    }

    public function searchAPois(Request $request){
        $term = $request->get('term');
        if(is_null($term)){
            $pois = Poi::select('id_poi', 'poi.nombre')->where('poi.estado','=','true')->get();
        }else{
            $pois = Poi::select('id_poi', 'poi.nombre')->where([['nombre', 'LIKE', '%' . $term . '%'],['poi.estado','=','true']])->get();
        }
        $data = [];
        foreach ($pois as $poi) {
            $data[] = [
                'label' => $poi->nombre,
                'id' => $poi->id_poi
            ];   
        }
        return $data;
    }

    public function getFacxsPoi(Request $request){
        $poiId = $request->get('id');

        $NTP = Formula_Formula::select('fk_id_ntp')->take(1)->get();

        $PxF = Poi::select('formula.nombre as nombre', 'valor')->join('poi_formula','id_poi','=','fk_id_poi')->join('formula','id_formula','=','fk_id_formula')->where([['formula.estado','=','true'], ['poi.id_poi','=', $poiId], ['id_formula','<>', $NTP[0]->fk_id_ntp]])->get();

        $F = [$poiId, $PxF];
        
        return $F;
    }
}
