<?php

namespace App\Http\Controllers;

use App\Http\Requests\poiRequest;
use App\Models\Log;
use Carbon\Carbon;
use App\Models\Municipio;
use App\Models\Poi;
use App\Models\Poi_AI;
use App\Models\Poi_Tipologia;
use App\Models\Tipologia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class poiCrudController extends Controller
{

    public function redirecToSection($section){
        return view('adminPoi', ['section' => $section]);
    }

    public function store(poiRequest $request)
    {
        $requestV = $request->validated();
        $requestEx = $request->validate([
            'image' => 'required'
        ],[
            'image.required' => 'La imagen es requerida.',
        ]);

        //Comprobar que tipologias seleccionadas existen
        $errorvTipo = false;
        $tipoTam = count($requestV['tipo']);
        for($i=0;$i < $tipoTam;$i++){
            $ctSsTipo = Tipologia::select('id_tipologia')->where([['id_tipologia','=',($requestV['tipo'])[$i]],['estado','=','1']])->count();
            if($ctSsTipo==0){
                $errorvTipo = true;
                break;
            }
        }
        
        //Comprobar que el poi no tenga el mismo nombre a otro poi
        $errorName = false;
        $nctNamePoi = Poi::select('nombre')->where('nombre','=',$requestV['name'])->count();
        if($nctNamePoi>0){
            $errorName = true;
        }

        //Comprobar que el municipio seleccionado exista
        $errorvMun = false;
        $ctMun = Municipio::select('id_municipio')->where('id_municipio','=',$requestV['town'])->count();
        if($ctMun==0){
            $errorvMun = true;
        }

        //Longitud de las coordenadas
        $errorLongCord = false;
        if(strlen($requestV["cx"])>9){
            $errorLongCord = true;
        }else if(strlen($requestV["cy"])>9){
            $errorLongCord = true;
        }

        $errores = [];
        if($errorName || $errorvTipo || $errorLongCord || $errorvMun){
            if($errorName)
                array_push($errores, "Ya existe el punto de interés.");
            if($errorvTipo)
                array_push($errores, "Una o varias de las tipologias seleccionadas no existen.");
            if($errorLongCord)
                array_push($errores, "Longitud de coordenadas excedido.");
            if($errorvMun)
                array_push($errores, "El municipio escogido no se encuentra registrado.");
            return view('adminPoi', ['section' => 'agregar', 'errores' => $errores]);
        }else{
            $nextVal = (Poi_AI::select('AUTO_INCREMENT')->where([['TABLE_SCHEMA','=','ruta'],['TABLE_NAME','=','poi']])->get())[0]->AUTO_INCREMENT;
            $ext = $requestV['image']->getClientOriginalExtension();
            $path = $requestV['image']->storeAs('/', $nextVal . '.' . $ext,'poiImages');
            Poi::create([
                'nombre' => $requestV["name"],
                'coordenadax' => $requestV["cx"],
                'coordenaday' => $requestV["cy"],
                'tiempoestancia' => $requestV["time"],
                'costo' => $requestV["cost"],
                'descripcion' => $requestV["description"],
                'imagen' => $path,
                'estado' => 1,
                'fk_id_municipio' => $requestV["town"]
            ]);

            for ($i=0; $i < $tipoTam; $i++) { 
                Poi_Tipologia::create([
                    'fk_id_poi' => $nextVal,
                    'fk_id_tipologia' => ($requestV["tipo"])[$i],
                    'estado' => 1
                ]);
            }

            Log::create([
                'fecha' => Carbon::now()->toDateString(),
                'hora' => Carbon::now()->toTimeString(),
                'fk_id_administrador' => '1',
                'fk_id_seccion' => '2',
                'fk_id_evento' => '1'
            ]);
            return redirect()->route('poiCrud.redirecToSection', ['section' => 'agregar']);
        }
    }

    public function update(poiRequest $request)
    {
        $requestV = $request->validated();
        $requestEx = $request->validate([
            'id' => 'required|integer|min:0|max:32767',
            'state' => 'required|integer|digits_between:0,1'
        ],[
            'id.required' => 'El ID es requerido.',
            'id.integer' => 'El ID debe estar en números enteros.',
            'id.min' => 'El ID debe ser mayor a 0.',
            'id.max' => 'El ID súpera el límite establecido.',

            'state.required' => 'El estado es requerido.',
            'state.integer' => 'El estado debe estar en números enteros.',
            'state.digits_between' => 'El estado no está dentro del rango establecido.'
        ]);

        //Comprobar que el poi existe
        $errorvPoi = false;
        $countPoi=Poi::select('id_poi')->where('id_poi','=',$requestEx['id'])->count();
        if($countPoi==0){
            $errorvPoi = true;
        }

        //Comprobar que el nombre del poi no se repita
        $errorRName = false;
        $nctNamePoi = Poi::select('nombre')->where([['nombre','=',$requestV['name']],['id_poi','<>',$requestEx['id']]])->count();
        if($nctNamePoi>0){
            $errorRName = true;
        }

        //Comprobar que tipologias seleccionadas existen
        $errorvTipo = false;
        $stipoTam = count($requestV['tipo']);
        for($i=0;$i < $stipoTam;$i++){
            $ctSsTipo = Tipologia::select('id_tipologia')->where([['id_tipologia','=',($requestV['tipo'])[$i]],['estado','=',1]])->count();
            if($ctSsTipo==0){
                $errorvTipo = true;
                break;
            }
        }

        //Comprobar que el municipio exista
        $errorvMun = false;
        $ctMun = Municipio::select('id_municipio')->where('id_municipio','=',$requestV['town'])->count();
        if($ctMun==0){
            $errorvMun = true;
        }

        //Longitud de las coordenadas
        $errorLongCord = false;
        if(strlen($requestV["cx"])>9){
            $errorLongCord = true;
        }else if(strlen($requestV["cy"])>9){
            $errorLongCord = true;
        }

        $errores = [];
        if($errorvMun || $errorvPoi || $errorvTipo || $errorLongCord || $errorRName){
            if($errorvMun)
                array_push($errores, "El municipio escogido no se encuentra registrado.");
            if($errorEstancia)
                array_push($errores, "Tiempo de estancia excedido.");
            if($errorvPoi)
                array_push($errores, "El ID no existe.");
            if($errorLongCord)
                array_push($errores, "Longitud de las coordenadas excedido.");
            if($errorRName)
                array_push($errores, "Nombre de duplicado.");
            return view('adminPoi', ['section' => 'modificar', 'errores' => $errores]);
        }else{
            $path = (Poi::select('imagen')->where('id_poi','=',$requestEx["id"])->get())[0]->imagen;
            if ($request->hasFile('image'))
            {
                Storage::disk('poiImages')->delete($path);
                $ext = $requestV['image']->getClientOriginalExtension();
                $path = $requestV['image']->storeAs('/', $requestEx["id"] . '.' . $ext,'poiImages');
            }
            
            Poi::where('id_poi', $requestEx["id"])->update([
                'nombre' => $requestV["name"],
                'coordenadax' => $requestV["cx"],
                'coordenaday' => $requestV["cy"],
                'tiempoestancia' => $requestV["time"],
                'imagen' => $path,
                'descripcion' => $requestV["description"],
                'estado' => $requestEx["state"],
                'fk_id_municipio' => $requestV["town"]
            ]);

            Poi_Tipologia::where('fk_id_poi','=',$requestEx["id"])->update([
                        'estado' => false
                    ]); 
            for ($i=0; $i < $stipoTam; $i++) {
                $ctPxT = Poi_Tipologia::select('fk_id_tipologia')->where([['fk_id_poi','=',$requestEx["id"]],['fk_id_tipologia','=',($requestV["tipo"])[$i]]])->count();
                if(empty($ctPxT)){
                    Poi_Tipologia::create([
                        'fk_id_poi' => $requestEx["id"],
                        'fk_id_tipologia' => ($requestV["tipo"])[$i],
                        'estado' => true
                    ]);
                }else{
                    Poi_Tipologia::where([['fk_id_poi','=',$requestEx["id"]],['fk_id_tipologia','=',($requestV["tipo"])[$i]]])->update([
                        'estado' => true
                    ]); 
                }
            }
            Log::create([
                'fecha' => Carbon::now()->toDateString(),
                'hora' => Carbon::now()->toTimeString(),
                'fk_id_administrador' => '1',
                'fk_id_seccion' => '2',
                'fk_id_evento' => '2'
            ]);
            return redirect()->route('poiCrud.redirecToSection', ['section' => 'modificar']);
        }
    }
}
