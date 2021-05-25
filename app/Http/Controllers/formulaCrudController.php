<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Factor;
use App\Models\Variable;
use App\Models\Formula;
use App\Http\Requests\ModifyFormulaRequest;
use App\Http\Requests\CreateFormulaRequest;
use App\Models\Log;
use App\Models\Factor_Variable;
use Carbon\Carbon;

class formulaCrudController extends Controller
{
    public function redirecToSection(Request $request){
        return view('adminFormula', ['section' => $request->section]);
    }

    public function store(CreateFormulaRequest $request)
    {
        $requestV = $request->validated();

        //Comprobar que el nombre de la formula no se repita
        $errorNameForm = false;
        $ctName = Formula::select('nombre')->whereRaw('UPPER(nombre)=UPPER(\''.$requestV['nameForm'].'\')')->count();
        $errorNameForm = ($ctName==0) ? false : true;
        
        //Comprobar que el minimo sea menor que el maximo
        $errorMayor = false;
        for($i=0; $i<count($requestV['vminF']); $i++){
            if(($requestV['vminF'])[$i]>=($requestV['vmaxF'])[$i]){
                $errorMayor=true;
                break;
            }
        }
        for($i=0; $i<count($requestV['vminSF']); $i++){
            if(($requestV['vminSF'])[$i]>=($requestV['vmaxSF'])[$i]){
                $errorMayor=true;
                break;
            }
        }

        //Comprobar que la operación sea 100%
        $contProm = 0;
        if(isset($requestV['idV'])){
            for($i = 0; $i<count($requestV['vmaxV']); $i++){
                $contProm = ($requestV['vmaxV'])[$i] + $contProm;
            }
        }
        for($i = 0; $i<count($requestV['weightF']); $i++){
            $contProm = ($requestV['vmaxF'])[$i] * ($requestV['weightF'])[$i] + $contProm;
        }
        $errorSum=false;
        if($contProm != 100){
            $errorSum = true;
        }

        //Comprobar mismo tamaño de los datos llegados
        $errorTamDifF = false;
        $contTam = count($requestV['nameF']) + count($requestV['descriptionF']) + count($requestV['vminF']) + count($requestV['vmaxF']) + count($requestV['weightF']);
        $contTam = $contTam / 5;
        if(count($requestV['nameF'])!=$contTam){
            $errorTamDifF = true;
        }
        $errorTamDifV = false;
        if(isset($requestV['nameV'])){
            $contTam = count($requestV['nameV']) + count($requestV['descriptionV']) + count($requestV['vmaxV']);
            $contTam = $contTam / 3;
            if(count($requestV['nameV'])!=$contTam){
                $errorTamDifV = true;
            }
        }
        $errorTamDifSF = false;
        if(isset($requestV['nameSF'])){
            $contTam = count($requestV['nameSF']) + count($requestV['descriptionSF']) + count($requestV['vminSF']) + count($requestV['vmaxSF']) + count($requestV['weightSF']);
            $contTam = $contTam / 5;
            if(count($requestV['nameSF'])!=$contTam){
                $errorTamDifSF = true;
            }
        }      

        //Comprobar que el tamaño de SF sea igual a la sumatoria de la cantidad de subfactores
        $sumCSF=0;
        for($i=0;$i<count($requestV['nSfactor']);$i++){
            $sumCSF=($requestV['nSfactor'])[$i]+$sumCSF;
        }
        $errorSumCSFxSF = false;
        if(isset($requestV['nameSF'])){
            if($sumCSF!=count($requestV['nameSF'])){
                $errorSumCSFxSF = true;
            }
        }else{
            if($sumCSF!=0){
                $errorSumCSFxSF = true;
            }
        }

        //Agregar errores a un array y volve a la pagina si se encontraron errores
        $errores = [];
        if($errorNameForm || $errorMayor || $errorSum || $errorTamDifF || $errorTamDifV || $errorTamDifSF || $errorSumCSFxSF){
            if($errorNameForm)
                array_push($errores, "El nombre de la fórmula está duplicado.");
            if($errorMayor)
                array_push($errores, "Los valores min. y max. están invertidos.");
            if($errorSum)
                array_push($errores, "El promedio es mayor a 100%.");
            if($errorTamDifF)
                array_push($errores, "No han sido llenados todos los campos en la tabla de factores.");
            if($errorTamDifV)
                array_push($errores, "No han sido llenados todos los campos en la tabla de variables.");
            if($errorTamDifSF)
                array_push($errores, "No han sido llenados todos los campos en la tabla de subfactores.");
            if($errorSumCSFxSF)
                array_push($errores, "La cantidad de subfactores y los subfactores no coinciden.");
            return view('adminFormula', ['section' => 'agregar', 'errores' => $errores]);
        }else{
            $idform = (Formula::create([
                            'nombre' => $requestV['nameForm'],
                            'descripcion' => $requestV['descForm'],
                            'estado' => true
                        ]))->id_formula;
            for($i = 0; $i < count($requestV['nameF']); $i++){
                Factor::create([
                    'nombre' => ($requestV['nameF'])[$i],
                    'descripcion' => ($requestV['descriptionF'])[$i],
                    'valorminimo' => ($requestV['vminF'])[$i],
                    'valormaximo' => ($requestV['vmaxF'])[$i],
                    'peso' => ($requestV['weightF'])[$i],
                    'estado' => true,
                    'fk_id_formula' => $idform
                ]);
            }
            $vSave = [];
            if(isset($requestV['nameV'])){
                for($i = 0; $i < count($requestV['nameV']); $i++){
                    $vSave[] = (Variable::create([
                                    'nombre' => ($requestV['nameV'])[$i],
                                    'descripcion' => ($requestV['descriptionV'])[$i],
                                    'valormaximo' => ($requestV['vmaxV'])[$i],
                                    'peso' => ($requestV['weightV'])[$i],
                                    'estado' => true
                                ]))->id_variable;
                }
            }
            if(isset($requestV['nameV'])){
                $cont=0;
                for($i = 0; $i < count($requestV['nSfactor']); $i++){
                    for($j = 0; $j < ($requestV['nSfactor'])[$i]; $j++){
                        $nFac = (Factor::create([
                                    'nombre' => ($requestV['nameSF'])[$cont],
                                    'descripcion' => ($requestV['descriptionSF'])[$cont],
                                    'valorminimo' => ($requestV['vminSF'])[$cont],
                                    'valormaximo' => ($requestV['vmaxSF'])[$cont],
                                    'peso' => ($requestV['weightSF'])[$cont],
                                    'estado' => true,
                                    'fk_id_formula' => $idform
                                ]))->id_factor;
                        Factor_Variable::create([
                            'fk_id_factor' => $nFac,
                            'fk_id_variable' => $vSave[$i]
                        ]);
                        $cont++;
                    }
                }
            }
            Log::create([
                'fecha' => Carbon::now()->toDateString(),
                'hora' => Carbon::now()->toTimeString(),
                'fk_id_administrador' => '1',
                'fk_id_seccion' => '1',
                'fk_id_evento' => '1'
            ]);
            return redirect()->route('formulaCrud.redirecToSection', ['section' => 'agregar']);
        }
        
    }

    public function update(ModifyFormulaRequest $request)
    {
        $requestV = $request->validated();

        //Comprobar que el ID de la fórmula no sea 1 (Algoritmo heuristico)
        $errorFormX = ($requestV['idform'] == "1") ? true : false;

        //Comprobar que el ID de la formula existe
        $ctIdForm = Formula::select('id_formula')->where('id_formula','=',$requestV['idform'])->count();
        $errorIdvForm = ($ctIdForm==0) ? true : false;

        //Comprobar que el nombre de la formula no se repita
        $errorNameForm = false;
        $ctName = Formula::select('id_formula')->where([['nombre','=',$requestV['nameForm']],['id_formula','<>',$requestV['idform']]])->count();
        $errorNameForm = ($ctName==0) ? false : true;
        
        //Comprobar que el minimo sea menor que el maximo
        $errorMayor = false;
        for($i=0; $i<count($requestV['vminF']); $i++){
            if(($requestV['vminF'])[$i]>=($requestV['vmaxF'])[$i]){
                $errorMayor=true;
                break;
            }
        }
        for($i=0; $i<count($requestV['vminSF']); $i++){
            if(($requestV['vminSF'])[$i]>=($requestV['vmaxSF'])[$i]){
                $errorMayor=true;
                break;
            }
        }

        //Comprobar que la operación sea 100%
        $contProm = 0;
        if(isset($requestV['idV'])){
            for($i = 0; $i<count($requestV['vmaxV']); $i++){
                if(($requestV['stateV'])[$i] == "true"){
                    $contProm = ($requestV['vmaxV'])[$i] + $contProm;
                }
            }
        }
        for($i = 0; $i<count($requestV['weightF']); $i++){
            if(($requestV['stateF'])[$i] == "true"){
                $contProm = ($requestV['vmaxF'])[$i] * ($requestV['weightF'])[$i] + $contProm;
            }
        }
        $errorSum=false;
        if($contProm != 100){
            $errorSum = true;
        }

        //Comprobar mismo tamaño de los datos llegados
        $errorTamDifF = false;
        $contTam = count($requestV['nameF']) + count($requestV['descriptionF']) + count($requestV['vminF']) + count($requestV['vmaxF']) + count($requestV['weightF']) + count($requestV['stateF']);
        $contTam = $contTam / 6;
        if(count($requestV['nameF'])!=$contTam){
            $errorTamDifF = true;
        }
        $errorTamDifV = false;
        if(isset($requestV['nameV'])){
            $contTam = count($requestV['nameV']) + count($requestV['descriptionV']) + count($requestV['vmaxV']) + count($requestV['stateV']);
            $contTam = $contTam / 4;
            if(count($requestV['nameV'])!=$contTam){
                $errorTamDifV = true;
            }
        }
        $errorTamDifSF = false;
        if(isset($requestV['nameSF'])){
            $contTam = count($requestV['nameSF']) + count($requestV['descriptionSF']) + count($requestV['vminSF']) + count($requestV['vmaxSF']) + count($requestV['weightSF']) + count($requestV['stateSF']);
            $contTam = $contTam / 6;
            if(count($requestV['nameSF'])!=$contTam){
                $errorTamDifSF = true;
            }
        }

        //Comprobar que el estado sea true o false 
        $errorState = false;
        for ($i=0; $i < count($requestV['stateF']); $i++) { 
            if(($requestV['stateF'])[$i]!="true" && ($requestV['stateF'])[$i]!="false"){
               $errorState = true;
               break; 
            }
        }
        if(isset($requestV['nameV'])){
            for ($i=0; $i < count($requestV['stateV']); $i++) { 
                if(($requestV['stateV'])[$i]!="true" && ($requestV['stateV'])[$i]!="false"){
                   $errorState = true;
                   break; 
                }
            }
        }
        if(isset($requestV['nameSF'])){
            for ($i=0; $i < count($requestV['stateSF']); $i++) { 
                if(($requestV['stateSF'])[$i]!="true" && ($requestV['stateSF'])[$i]!="false"){
                   $errorState = true;
                   break; 
                }
            }
        }        

        //Comprobar que el tamaño de SF sea igual a la sumatoria de la cantidad de subfactores
        $sumCSF=0;
        for($i=0;$i<count($requestV['nSfactor']);$i++){
            $sumCSF=($requestV['nSfactor'])[$i]+$sumCSF;
        }
        $errorSumCSFxSF = false;
        if(isset($requestV['nameSF'])){
            if($sumCSF!=count($requestV['nameSF'])){
                $errorSumCSFxSF = true;
            }
        }else{
            if($sumCSF!=0){
                $errorSumCSFxSF = true;
            }
        }

        //Comprobar que las primeras filas corresponde a los registros de la BBDD
        // $errorIdvF = false;
        // $errorIdvV = false;
        // $idsFac = (isset($request->all)) ? Factor::select('id_factor')->leftjoin('factor_variable', 'id_factor', '=', 'fk_id_factor')->whereNull('fk_id_factor')->where('fk_id_formula', '=', $requestV['idform'])->get() : Factor::select('id_factor')->leftjoin('factor_variable', 'id_factor', '=', 'fk_id_factor')->whereNull('fk_id_factor')->where([['fk_id_formula', '=', $requestV['idform']],['factor.estado','=',true]])->get();
        // if(isset($requestV['idV'])){
        //     $idsVar = (isset($request->all)) ? Variable::select('id_variable')->leftjoin('factor_variable','fk_id_variable','=','id_variable')->leftjoin('factor','id_factor','=','fk_id_factor')->where('fk_id_formula','=',$requestV['idform'])->groupBy('id_variable')->get() : Variable::select('id_variable')->leftjoin('factor_variable','fk_id_variable','=','id_variable')->leftjoin('factor','id_factor','=','fk_id_factor')->where([['fk_id_formula','=',$requestV['idform']],['variable.estado','=',true]])->groupBy('id_variable')->get();
        //     $ctDb = 0;
        //     for ($i=0; $i < count($requestV['idV']); $i++) { 
        //         if(is_null(($requestV['idV'])[$i])){
        //             break;
        //         }else{
        //             if(($requestV['idV'])[$i] != $idsVar[$i]->id_variable){
        //                 $errorIdvV = true;
        //                 break;
        //             }else{
        //                 $ctDb++;
        //             }
        //         }
        //     }
        //     if($ctDb!=count($idsVar)){
        //         $errorIdvV = true;
        //     }
        // }
        // $ctDb = 0;
        // for ($i=0; $i < count($requestV['idF']); $i++) {
        //     if(is_null(($requestV['idF'])[$i])){
        //         break;
        //     }else{
        //         if(($requestV['idF'])[$i] != $idsFac[$i]->id_factor){
        //             $errorIdvF = true;
        //             break;
        //         }else{
        //             $ctDb++;    
        //         }
        //     }
        // }
        // if($ctDb!=count($idsFac)){
        //     $errorIdvF = true;
        // }

        //Agregar errores a un array y volve a la pagina si se encontraron errores
        $errores = [];
        if($errorIdvForm || $errorMayor || $errorSum || $errorTamDifF || $errorTamDifV || $errorTamDifSF || $errorNameForm || $errorState || $errorFormX || $errorSumCSFxSF){
            if($errorIdvForm)
                array_push($errores, "El ID de la fórmula no existe.");
            if($errorMayor)
                array_push($errores, "Los valores min. y max. están invertidos.");
            if($errorSum)
                array_push($errores, "El promedio es mayor a 100%.");
            if($errorTamDifF)
                array_push($errores, "No han sido llenados todos los campos en la tabla de factores.");
            if($errorTamDifV)
                array_push($errores, "No han sido llenados todos los campos en la tabla de variables.");
            if($errorTamDifSF)
                array_push($errores, "No han sido llenados todos los campos en la tabla de subfactores.");
            if($errorNameForm)
                array_push($errores, "El nombre de la fórmula está duplicado.");
            if($errorState)
                array_push($errores, "El estado de los registros es incorrecto.");
            if($errorFormX)
                array_push($errores, "La fórmula 'Algoritmo heurístico' no se puede modificar.");
            if($errorSumCSFxSF)
                array_push($errores, "La cantidad de subfactores y los subfactores no coinciden.");
            return view('adminFormula', ['section' => 'modificar', 'errores' => $errores]);
        }else{
            Formula::where('id_formula', $requestV['idform'])->update([
                'nombre' => $requestV['nameForm'],
                'descripcion' => $requestV['descForm'],
                'estado' => $requestV['stateForm']
            ]);
            for($i = 0; $i < count($requestV['idF']); $i++){
                Factor::where('id_factor', ($requestV['idF'])[$i])->update([
                    'nombre' => ($requestV['nameF'])[$i],
                    'descripcion' => ($requestV['descriptionF'])[$i],
                    'valorminimo' => ($requestV['vminF'])[$i],
                    'valormaximo' => ($requestV['vmaxF'])[$i],
                    'peso' => ($requestV['weightF'])[$i],
                    'estado' => ($requestV['stateF'])[$i]
                ]);
            }
            for($i = count($requestV['idF']); $i < count($requestV['nameF']); $i++){
                Factor::create([
                    'nombre' => ($requestV['nameF'])[$i],
                    'descripcion' => ($requestV['descriptionF'])[$i],
                    'valorminimo' => ($requestV['vminF'])[$i],
                    'valormaximo' => ($requestV['vmaxF'])[$i],
                    'peso' => ($requestV['weightF'])[$i],
                    'estado' => true,
                    'fk_id_formula' => $requestV['idform']
                ]);
            }
            $vSave = [];
            if(isset($requestV['idV'])){
                for($i = 0; $i < count($requestV['idV']); $i++){
                    Variable::where('id_variable', ($requestV['idV'])[$i])->update([
                        'nombre' => ($requestV['nameV'])[$i],
                        'descripcion' => ($requestV['descriptionV'])[$i],
                        'valormaximo' => ($requestV['vmaxV'])[$i],
                        'estado' => ($requestV['stateV'])[$i]
                    ]);
                    $vSave[] = ($requestV['idV'])[$i];
                }
                for($i = count($requestV['idV']); $i < count($requestV['nameV']); $i++){
                    $vSave[] = (Variable::create([
                                    'nombre' => ($requestV['nameV'])[$i],
                                    'descripcion' => ($requestV['descriptionV'])[$i],
                                    'valormaximo' => ($requestV['vmaxV'])[$i],
                                    'estado' => true
                                ]))->id_variable;
                }
            }else if(isset($requestV['nameV'])){
                for($i = 0; $i < count($requestV['nameV']); $i++){
                    $vSave[] = (Variable::create([
                                    'nombre' => ($requestV['nameV'])[$i],
                                    'descripcion' => ($requestV['descriptionV'])[$i],
                                    'valormaximo' => ($requestV['vmaxV'])[$i],
                                    'peso' => ($requestV['weightV'])[$i],
                                    'estado' => true
                                ]))->id_variable;
                }
            }
            if(isset($requestV['nameV'])){
                $cont=0;
                for($i = 0; $i < count($requestV['nSfactor']); $i++){
                    for($j = 0; $j < ($requestV['nSfactor'])[$i]; $j++){
                        if(($requestV['idSF'])[$cont] == 0){
                            $nFac = (Factor::create([
                                        'nombre' => ($requestV['nameSF'])[$cont],
                                        'descripcion' => ($requestV['descriptionSF'])[$cont],
                                        'valorminimo' => ($requestV['vminSF'])[$cont],
                                        'valormaximo' => ($requestV['vmaxSF'])[$cont],
                                        'peso' => ($requestV['weightSF'])[$cont],
                                        'estado' => true,
                                        'fk_id_formula' => $requestV['idform']
                                    ]))->id_factor;
                            Factor_Variable::create([
                                'fk_id_factor' => $nFac,
                                'fk_id_variable' => $vSave[$i]
                            ]);
                        }else{
                            Factor::where('id_factor', ($requestV['idSF'])[$cont])->update([
                                'nombre' => ($requestV['nameSF'])[$cont],
                                'descripcion' => ($requestV['descriptionSF'])[$cont],
                                'valorminimo' => ($requestV['vminSF'])[$cont],
                                'valormaximo' => ($requestV['vmaxSF'])[$cont],
                                'peso' => ($requestV['weightSF'])[$cont],
                                'estado' => ($requestV['stateSF'])[$cont]
                            ]);
                        }
                        $cont++;
                    }
                }
            }
            Log::create([
                'fecha' => Carbon::now()->toDateString(),
                'hora' => Carbon::now()->toTimeString(),
                'fk_id_administrador' => '1',
                'fk_id_seccion' => '1',
                'fk_id_evento' => '2'
            ]);
            return redirect()->route('formulaCrud.redirecToSection', ['section' => 'modificar']);
        }
        
    }
}
