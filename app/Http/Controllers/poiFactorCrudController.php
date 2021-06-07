<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poi;
use App\Models\Factor;
use App\Models\Poi_Factor;
use App\Http\Requests\AdminPoiFactorRequest;
use App\Models\Log;
use Carbon\Carbon;

class poiFactorCrudController extends Controller
{
    public function redirecToSection($section){
        return view('adminPoiFactor', ['section' => $section]);
    }

    public function match(AdminPoiFactorRequest $request){
    	
        $requestV = $request->validated();

    	//Comprobar que el poi existe
    	$errorvPoi = false;
    	$idpoi = Poi::select('id_poi')->where([['id_poi', '=', $requestV['idpoi']],['estado','=',1]])->count();
    	if($idpoi == 0){
    		$errorvPoi = true;
    	}

    	//Comprobar que los factores existen
    	$errorvFactor = false;
    	$idTam = count($requestV['id']);
    	for($i=0; $i<$idTam; $i++){
    		$idfactorValider = Factor::select('id_factor')->where([['id_factor','=',($requestV['id'])[$i]],['estado','=',1]])->get();
    		if(empty($idfactorValider)){
    			$errorvFactor = true;
    			break;
    		}
    	}

    	$errorlimite = false;
    	$errorRelacion = false;
    	$errorCIdxV = false;

    	if(!$errorvPoi && !$errorvFactor){

	    	//Comprobar que los valores de los factores estén dentro del limite
	    	for($i=0; $i<$idTam; $i++){
	    		$maxmin = Factor::select('valorMinimo','valorMaximo')->where('id_factor','=',($requestV['id'])[$i])->get();
	    		if($maxmin[0]->valorMinimo > ($requestV['valor'])[$i] || $maxmin[0]->valorMaximo < ($requestV['valor'])[$i]){
	    			$errorlimite = true;
	    			break;
	    		}
	    	}

	    	//Comprobar que factores del formulario no estén relacionados con el poi
	    	for($i=0; $i<$idTam; $i++){
	    		$nPxF = Poi_Factor::select('valor')->where([['fk_id_poi','=',$requestV['idpoi']],['fk_id_factor','=', ($requestV['id'])[$i]]])->count();
	    		if($nPxF>0){
	    			$errorRelacion = true;
	    			break;
	    		}
	    	}

	    	//Comprobar que el valor y los ID sean la misma cantidad
	    	$errorCIdxV = ($idTam == count($requestV['valor'])) ? false : true;
    	}

    	$errores = [];
        if($errorvPoi || $errorvFactor || $errorlimite || $errorRelacion || $errorCIdxV){
            if($errorvPoi)
                array_push($errores, "El ID del PoI no existe.");
            if($errorvFactor)
                array_push($errores, "EL ID de un factor no existe.");
            if($errorlimite)
                array_push($errores, "El valor seleccionado de un factor sobrepasa el maximo y el minimo valor.");
            if($errorRelacion)
                array_push($errores, "Los PoI-Factores ya se encuentran emparejados.");
            if($errorCIdxV)
                array_push($errores, "La cantidad IDs y valores son diferentes.");
            return view('adminFactorPoi', ['section' => 'emparejar', 'errores' => $errores]);
        }else{
        	for($i=0; $i<$idTam; $i++){
        		Poi_Factor::create([
	            'fk_id_poi' => $requestV['idpoi'],
	            'fk_id_factor' => ($requestV['id'])[$i],
	            'valor' => ($requestV['valor'])[$i]
	        	]);
        	}
            Log::create([
                'fecha' => Carbon::now()->toDateString(),
                'hora' => Carbon::now()->toTimeString(),
                'fk_id_administrador' => '1',
                'fk_id_seccion' => '4',
                'fk_id_evento' => '1'
            ]);
        	return redirect()->route('poiFactorCrud.redirecToSection', ['section' => 'emparejar']);
        }
    }


    public function update(AdminPoiFactorRequest $request)
    {
        $requestV = $request->validated();
        
        //Comprobar que el id del poi existe

        $poiCount = Poi::select('id_poi')->where([['id_poi','=',$requestV['idpoi']],['estado','=',1]])->count();
        $errorvPoi = ($poiCount==0) ? true : false;

        //Comprobar que el id de los factores existen
        $errorvFac = false;
        $idTam = count($requestV['id']);
        for ($i=0; $i < $idTam; $i++) { 
            $facCount = Factor::select('id_factor')->where([['id_factor','=',($requestV['id'])[$i]],['estado','=',1]])->count();
            if($facCount==0){
                $errorvFac = true;
                break;
            }
        }


        $errorvPoixFac = false;
        $errorvMinMax = false;
        $errorCountFxV = false;
        if(!$errorvPoi && !$errorvFac){
            //Comprobar que los ids de los factores y poi estén relacionados en poi_formula  
            for ($i=0; $i < $idTam; $i++) { 
                $poixFacCount = Poi_Factor::select('fk_id_factor')->where([['fk_id_poi','=',$requestV['idpoi']],['fk_id_factor','=',($requestV['id'])[$i]]])->count();
                if($poixFacCount==0){
                    $errorvPoixFac = true;
                    break;
                }
            }

            //Comprobar que el valor está dentro de los limites
            for ($i=0; $i < $idTam; $i++) { 
                $minmaxFac = Factor::select('valorMinimo','valorMaximo')->where('id_factor','=',($requestV['id'])[$i])->get();
                if($minmaxFac[0]->valorminimo <= ($requestV['valor'])[$i] || $minmaxFac[0]->valormaximo >= ($requestV['id'])[$i]){
                }else{
                    $errorvMinMax = true;
                    break;
                }
            }

            //Comprobar que los factores tienen el mismo tamaño que los valores
            if($idTam!=count($requestV['valor'])){
                $errorCountFxV = true;
            }
        }

        //Agregar errores a un array y volve a la pagina si se encontraron errores
        $errores = [];
        if($errorvPoi || $errorvFac || $errorvPoixFac || $errorvMinMax || $errorCountFxV){
            if($errorvPoi)
                array_push($errores, "El ID del PoI no existe.");
            if($errorvFac)
                array_push($errores, "El ID de un factor no existe.");
            if($errorvPoixFac)
                array_push($errores, "El PoI y los factores no están relacionados.");
            if($errorvMinMax)
                array_push($errores, "EL valor sobrepasa los limites.");
            if($errorCountFxV)
                array_push($errores, "La cantidad de factores y valores son diferentes.");
            return view('adminPoiFactor', ['section' => 'modificar', 'errores' => $errores]);
        }else{
            for($i = 0; $i < $idTam; $i++){
                Poi_Factor::where([['fk_id_factor', '=', ($requestV['id'])[$i]],['fk_id_poi','=',$requestV['idpoi']]])->update([
                    'valor' => ($requestV['valor'])[$i]
                ]);
            }
            Log::create([
                'fecha' => Carbon::now()->toDateString(),
                'hora' => Carbon::now()->toTimeString(),
                'fk_id_administrador' => '1',
                'fk_id_seccion' => '4',
                'fk_id_evento' => '2'
            ]);
            return redirect()->route('poiFactorCrud.redirecToSection', ['section' => 'modificar']);
        }
    }
}
