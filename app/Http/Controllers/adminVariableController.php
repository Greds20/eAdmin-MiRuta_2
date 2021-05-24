<?php

namespace App\Http\Controllers;

use App\Models\Factor;
use App\Models\Factor_Variable;
use App\Models\Formula;
use App\Http\Requests\CreateVariableRequest;
use App\Http\Requests\ModifyVariableRequest;
use App\Models\Log;
use App\Models\Variable;
use Carbon\Carbon;
use Illuminate\Http\Request;

class adminVariableController extends Controller
{
    public function addVariable(Request $request){
        if($request->idform == "1"){
            return redirect()->route('adminFactor.redirecToSection', ['section' => 'modificar', 'errores' => ["La fórmula delaPeña no se puede modificar."]]);
        }
    	$form=(Formula::select('id_formula','nombre')->where('id_formula','=',$request->idform)->get())[0];
        $fac = Factor::select('id_factor','nombre','peso','valormaximo')->leftjoin('factor_variable', 'id_factor', '=', 'fk_id_factor')->whereNull('fk_id_factor')->where([['fk_id_formula', '=', $request->idform],['factor.estado','=',true]])->get();
        $var = Variable::select('id_variable','variable.nombre','variable.valormaximo')->leftjoin('factor_variable','fk_id_variable','=','id_variable')->leftjoin('factor','id_factor','=','fk_id_factor')->where([['fk_id_formula','=',$request->idform],['variable.estado','=',true]])->groupBy('id_variable')->get();
    	return view('adminForm', ['section' => $request->section, 'idform'=>$form, 'facs'=>$fac, 'vars'=>$var]);
    }

    public function modVariable(Request $request){
        if($request->idform == "1"){
            return redirect()->route('adminFactor.redirecToSection', ['section' => 'modificar', 'errores' => ["La fórmula delaPeña no se puede modificar."]]);
        }
    	$sVar = (Variable::select('id_variable','nombre','valormaximo')->where('id_variable','=',$request->idV)->get())[0];
        $sfac = Factor::select('id_factor','nombre','descripcion','valorminimo','valormaximo','peso','estado')->leftjoin('factor_variable','fk_id_factor','=','id_factor')->where('fk_id_variable','=',$request->idV)->get();
    	$form=(Formula::select('id_formula','nombre')->where('id_formula','=',$request->idform)->get())[0];
    	return view('adminForm', ['section' => $request->section, 'idform' => $form, 'svar' => $sVar, 'sfacs' => $sfac]);
    }

    public function store(CreateVariableRequest $request){
        $requestV = $request->validated();

        //Comprobar que el ID de la fórmula no sea 1 (delaPeña)
        $errorFormX = ($request->idform == "1") ? true : false;

        //Comprobar que la fórmula exista
        $form = Formula::select('id_formula','nombre')->where('id_formula','=',$request->idform)->get();
        if(count($form)==0){
            return redirect()->route('adminFactor.redirecToSection', ['section' => 'modificar', 'errores' => ["No se encuentra el ID de la fórmula."]]);
        }
        $form = $form[0]; 

        //Comprobar la nueva variable no tenga el mismo nombre en la BBDD
        $ctNameVar = Variable::select('id_variable')->where('nombre','=',$requestV['nameNV'])->count();
        $errorNameVar = ($ctNameVar>0) ? true : false;

        //Comprobar que ningun subfactor tenga el mismo nombre
        $errorNameF = false;
        for ($i=0; $i < count($requestV['nameSF']); $i++) { 
            $ctNameSF = Factor::select('id_factor')->where('nombre','=',($requestV['nameSF'])[$i])->count();
            if($ctNameSF>0){
                $errorNameF = true;
                break;
            }
        }

        //Comprobar que las variables sean las mismas que estan en la BBDD
        $errorVarvDB = false;
        $IdV = Variable::select('id_variable','variable.nombre','variable.valormaximo')->leftjoin('factor_variable','fk_id_variable','=','id_variable')->leftjoin('factor','id_factor','=','fk_id_factor')->where([['fk_id_formula','=',$request->idform],['variable.estado','=',true]])->groupBy('id_variable')->get();
        if(isset($requestV['idV'])){
            if(count($requestV['idV']) == count($IdV)){
                for ($i=0; $i < count($requestV['idV']); $i++) { 
                    if(($requestV['idV'])[$i] != $IdV[$i]->id_variable){
                        $errorVarvDB = true;
                        break;
                    }
                }
            }else{
                $errorVarvDB = true;
            }
        }

        //Comprobar que los factores sean las mismas que están en la BBDD
        $errorFacvDB = false;
        $IdF = Factor::select('id_factor','nombre','peso','valormaximo')->leftjoin('factor_variable', 'id_factor', '=', 'fk_id_factor')->whereNull('fk_id_factor')->where([['fk_id_formula', '=', $request->idform],['factor.estado','=',true]])->get();
        if(isset($requestV['idF'])){
            if(count($requestV['idF']) == count($IdF)){
                for ($i=0; $i < count($requestV['idF']); $i++) { 
                    if(($requestV['idF'])[$i] != $IdF[$i]->id_factor){
                        $errorFacvDB = true;
                        break;
                    }
                }
            }else{
                $errorFacvDB = true;
            }
        }

        //Comprobar que el valor min y max sean correctos
        $errorMinvMax = false;
        for ($i=0; $i < count($requestV['vminSF']); $i++) { 
            if(($requestV['vminSF'])[$i]>=($requestV['vmaxSF'])[$i]){
                $errorMinvMax = true;
                break;
            }
        }
        
        //Comprobar que la sumatoria sea 100
        $sum = $requestV['vmaxNV'];
        if(isset($requestV['idF'])){
            for ($i=0; $i < count($requestV['vmaxF']); $i++) { 
                $sum = ($requestV['vmaxF'])[$i] * ($requestV['weightF'])[$i] + $sum;
            }
        }
        if(isset($requestV['idV'])){
            for ($i=0; $i < count($requestV['vmaxV']); $i++) { 
                $sum = ($requestV['vmaxV'])[$i] + $sum;
            }
        }
        $errorSum = ($sum == 100) ? false : true;

        //Comprobar que los datos de las tablas tengan la misma cantidad de celdas en cada columna
        $errorCtRowxCell = false;
        $ctTbSF = count($requestV['nameSF']) + count($requestV['descriptionSF']) + count($requestV['vminSF']) + count($requestV['vmaxSF']) + count($requestV['weightSF']);
        if(isset($requestV['idV'])){
            $ctTbV = count($requestV['idV']) + count($requestV['vmaxV']);
            if(isset($requestV['idF'])){
                $ctTbF = count($requestV['idF']) + count($requestV['vmaxF']) + count($requestV['weightF']);
                if(($ctTbF/3 != count($requestV['idF'])) || ($ctTbV/2 != count($requestV['idV'])) || ($ctTbSF/5 != count($requestV['nameSF']))){
                    $errorCtRowxCell = true;
                }
            }else{
                if(($ctTbV/2 != count($requestV['idV'])) || ($ctTbSF/5 != count($requestV['nameSF']))){
                    $errorCtRowxCell = true;
                }
            }
        }else{
            if(isset($requestV['idF'])){
                $ctTbF = count($requestV['idF']) + count($requestV['vmaxF']) + count($requestV['weightF']);
                if(($ctTbF/3 != count($requestV['idF'])) || ($ctTbSF/5 != count($requestV['nameSF']))){
                    $errorCtRowxCell = true;
                }
            }else{
                if($ctTbSF/5 != count($requestV['nameSF'])){
                    $errorCtRowxCell = true;
                }
            }
        }

        //Comprobar que los nombres de los subfactores son diferentes
        $errorNameTbSF = false;
        for ($i=0; $i < count($requestV['nameSF']); $i++) { 
            for ($j=$i+1; $j < count($requestV['nameSF']); $j++) { 
                $errorNameTbSF = (($requestV['nameSF'])[$i] == ($requestV['nameSF'])[$j]) ? true : false;
            }
        }

        $errores = [];
        if($errorNameVar || $errorNameF || $errorVarvDB || $errorFacvDB || $errorMinvMax || $errorSum || $errorCtRowxCell || $errorNameTbSF || $errorFormX){
            if($errorNameVar)
                array_push($errores, "El nombre de la nueva variable ya existe.");
            if($errorNameF)
                array_push($errores, "El nombre de los subfactores ya existen en la base de datos.");
            if($errorVarvDB)
                array_push($errores, "Las variables no corresponden a las variables de la base de datos.");
            if($errorFacvDB)
                array_push($errores, "Los factores no corresponden a los factores de la base de datos.");
            if($errorMinvMax)
                array_push($errores, "El valor minimo de los subfactores es mayor o igual al valor máximo.");
            if($errorSum)
                array_push($errores, "La sumatoria de la fórmula es diferente a 100%.");
            if($errorCtRowxCell)
                array_push($errores, "El número de filas no son los mismos para todas las columnas.");
            if($errorNameTbSF)
                array_push($errores, "Existen una o varias coincidencias en los nombres de los subfactores.");
            if($errorFormX)
                array_push($errores, "La fórmula delaPeña no se puede modificar.");
            return view('adminForm', ['section' => 'agregar-variable', 'idform'=>$form, 'facs'=>$IdF, 'vars'=>$IdV, 'errores' => $errores]);
        }else{
            if(isset($requestV['idF'])){
                for($i = 0; $i < count($requestV['idF']); $i++){
                    Factor::where('id_factor', ($requestV['idF'])[$i])->update([
                        'valormaximo' => ($requestV['vmaxF'])[$i],
                        'peso' => ($requestV['weightF'])[$i]
                    ]);
                }
            }
            if(isset($requestV['idV'])){
                for($i = 0; $i < count($requestV['idV']); $i++){
                    Variable::where('id_variable', ($requestV['idV'])[$i])->update([
                        'valormaximo' => ($requestV['vmaxV'])[$i]
                    ]);
                }
            }
            $idNewV = Variable::create([
                'nombre' => $requestV['nameNV'],
                'descripcion' => $requestV['descriptionNV'],
                'valormaximo' => $requestV['vmaxNV'],
                'estado' => true
            ]);
            for($i = 0; $i < count($requestV['nameSF']); $i++){
                $idNewSF = Factor::create([
                    'nombre' => ($requestV['nameSF'])[$i],
                    'descripcion' => ($requestV['descriptionSF'])[$i],
                    'valorminimo' => ($requestV['vminSF'])[$i],
                    'valormaximo' => ($requestV['vmaxSF'])[$i],
                    'peso' => ($requestV['weightSF'])[$i],
                    'estado' => true,
                    'fk_id_formula' => $request->idform
                ]);
                Factor_Variable::create([
                    'fk_id_factor' => $idNewSF->id_factor,
                    'fk_id_variable' => $idNewV->id_variable
                ]);
            }
            Log::create([
                'fecha' => Carbon::now()->toDateString(),
                'hora' => Carbon::now()->toTimeString(),
                'fk_id_administrador' => '1',
                'fk_id_seccion' => '1',
                'fk_id_evento' => '1'
            ]);
            return redirect()->route('adminFactor.redirecToSection', ['section' => 'modificar']);
        }
    }

    public function update(ModifyVariableRequest $request){
        $requestV = $request->validated();

        //Comprobar que el ID de la fórmula no sea 1 (delaPeña)
        $errorFormX = ($request->idform == "1") ? true : false;

        //Comprobar que la formula existe
        $form = Formula::select('id_formula','nombre')->where('id_formula','=',$request->idform)->get();
        if(count($form)==0){
            return redirect()->route('adminFactor.redirecToSection', ['section' => 'modificar', 'errores' => ["No se encuentra el ID de la fórmula."]]);
        }
        $form = $form[0];

        //Comprobar que la variable existe
        $sVar = Variable::select('id_variable','nombre','valormaximo')->where('id_variable','=',$request->idV)->get();
        if(count($sVar)==0){
            return view('adminForm', ['section' => 'modificar', 'errores' => ["No se encuentra el ID de la variable."]]);
        }
        $sVar = $sVar[0];

        //Comprobar que los datos de las tablas tengan la misma cantidad de celdas en cada columna
        $errorCtRowxCell = false;
        $ctTbSF = count($requestV['nameSF']) + count($requestV['descriptionSF']) + count($requestV['vminSF']) + count($requestV['vmaxSF']) + count($requestV['weightSF']);
        if($ctTbSF/5 != count($requestV['nameSF'])){
            $errorCtRowxCell = true;
        }
        $ctTbIdxS = count($requestV['idSF']) + count($requestV['stateSF']);
        if($ctTbIdxS/2 != count($requestV['idSF'])){
            $errorCtRowxCell = true;
        }

        //Comprobar que los nombres sean diferentes en la tabla
        $errorNameTbSF = false;
        for ($i=0; $i < count($requestV['nameSF']); $i++) { 
            for ($j=$i+1; $j < count($requestV['nameSF']); $j++) { 
                $errorNameTbSF = (($requestV['nameSF'])[$i] == ($requestV['nameSF'])[$j]) ? true : false;
            }
        }

        //Comprobar que los factores sean las mismas que están en la BBDD
        $errorSfacvDB = false;
        $sfac = Factor::select('id_factor','nombre','descripcion','valorminimo','valormaximo','peso','estado')->leftjoin('factor_variable','fk_id_factor','=','id_factor')->where('fk_id_variable','=',$request->idV)->get();
        if(count($requestV['idSF']) == count($sfac)){
            for ($i=0; $i < count($requestV['idSF']); $i++) { 
                if(($requestV['idSF'])[$i] != $sfac[$i]->id_factor){
                    $errorSfacvDB = true;
                    break;
                }
            }
        }else{
            $errorSfacvDB = true;
        }

        //Comprobar que no se dupliquen los nombre con los de la BBDD
        $errorSfNamexBd = false;
        for ($i=0; $i < count($requestV['idSF']); $i++) { 
            for ($j=0; $j < count($sfac); $j++) { 
                if(($requestV['nameSF'])[$i] == $sfac[$j]->nombre){
                    if(($requestV['idSF'])[$i]!=$sfac[$j]->id_factor){
                        $errorSfNamexBd = true;
                        break;
                    }
                }
            }
        }

        for ($i=count($requestV['idSF']); $i < count($requestV['nameSF']); $i++) { 
            for ($j=0; $j < count($sfac); $j++) { 
                if(($requestV['nameSF'])[$i] == $sfac[$j]->nombre){
                    $errorSfNamexBd = true;
                    break;
                }
            }
        }

        //El valor minimo debe ser menor que el valor maximo
        $errorMinvMax = false;
        for ($i=0; $i < count($requestV['vminSF']); $i++) { 
            if(($requestV['vminSF'])[$i]>=($requestV['vmaxSF'])[$i]){
                $errorMinvMax = true;
                break;
            }
        }

        //Comprobar que el estado sea true o false
        $errorState = false;
        for ($i=0; $i < count($requestV['stateSF']); $i++) { 
            if(($requestV['stateSF'])[$i]!="true" && ($requestV['stateSF'])[$i]!="false"){
               $errorState = true;
               break; 
            }
        }

        $errores = [];
        if($errorMinvMax || $errorSfNamexBd || $errorSfacvDB || $errorNameTbSF || $errorCtRowxCell || $errorState || $errorFormX){
            if($errorNameTbSF)
                array_push($errores, "El nombre de los subfactores están duplicados.");
            if($errorSfNamexBd)
                array_push($errores, "El nombre de los subfactores ya existen en la base de datos.");
            if($errorSfacvDB)
                array_push($errores, "Los subfactores no corresponden a las subfactores de la base de datos.");
            if($errorMinvMax)
                array_push($errores, "El valor minimo de los subfactores es mayor o igual al valor máximo.");
            if($errorCtRowxCell)
                array_push($errores, "El número de filas no son los mismos para todas las columnas.");
            if($errorState)
                array_push($errores, "El estado del subfactor es incorrecto.");
            if($errorFormX)
                array_push($errores, "La fórmula delaPeña no se puede modificar.");
            return view('adminForm', ['section' => 'mod-variable', 'idform' => $form, 'svar' => $sVar, 'sfacs' => $sfac, 'errores' => $errores]);
        }else{
            for($i = 0; $i < count($requestV['idSF']); $i++){
                Factor::where('id_factor', ($requestV['idSF'])[$i])->update([
                    'nombre' => ($requestV['nameSF'])[$i],
                    'descripcion' => ($requestV['descriptionSF'])[$i],
                    'valorminimo' => ($requestV['vminSF'])[$i],
                    'valormaximo' => ($requestV['vmaxSF'])[$i],
                    'peso' => ($requestV['weightSF'])[$i],
                    'estado' => ($requestV['stateSF'])[$i]
                ]);
            }
            for($i = count($requestV['idSF']); $i < count($requestV['nameSF']); $i++){
                $idNewSF = Factor::create([
                    'nombre' => ($requestV['nameSF'])[$i],
                    'descripcion' => ($requestV['descriptionSF'])[$i],
                    'valorminimo' => ($requestV['vminSF'])[$i],
                    'valormaximo' => ($requestV['vmaxSF'])[$i],
                    'peso' => ($requestV['weightSF'])[$i],
                    'estado' => true,
                    'fk_id_formula' => $request->idform
                ]);
                Factor_Variable::create([
                    'fk_id_factor' => $idNewSF->id_factor,
                    'fk_id_variable' => $request->idV
                ]);
            }
            Log::create([
                'fecha' => Carbon::now()->toDateString(),
                'hora' => Carbon::now()->toTimeString(),
                'fk_id_administrador' => '1',
                'fk_id_seccion' => '1',
                'fk_id_evento' => '2'
            ]);
            return redirect()->route('adminFactor.redirecToSection', ['section' => 'modificar']);
        }

    }
}
