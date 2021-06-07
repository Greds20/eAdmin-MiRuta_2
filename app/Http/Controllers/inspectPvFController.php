<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poi;
use App\Models\Factor;
use App\Models\Poi_Factor;

class inspectPvFController extends Controller
{
    public function inspectPoivFactor(){
        $nfactores = Factor::select('id_factor')->leftjoin('formula','id_formula','=','fk_id_formula')->where([['factor.estado','=',1],['formula.estado','=',1]])->count();
        $pois = Poi::select('id_poi','nombre')->where('estado', '=', 1)->get();

        $warning = false;
        for($i = 0; $i<count($pois); $i++){
            $nPxF = Poi_Factor::select('fk_id_poi')->leftjoin('factor','id_factor','=','fk_id_factor')->leftjoin('formula','id_formula','=','fk_id_formula')->where([['factor.estado', '=', 1],['formula.estado','=',1],['fk_id_poi','=',$pois[$i]->id_poi]])->count();
            if($nPxF != $nfactores){
                $warning = true;
                break;
            }
        }

        return $warning;
    }
}
