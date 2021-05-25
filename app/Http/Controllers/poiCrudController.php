<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminPoiCreateRequest;
use App\Http\Requests\AdminPoiModifyRequest;
use App\Models\Log;
use Carbon\Carbon;
use App\Models\Municipio;
use App\Models\Poi;
//use App\Models\Poi_Seq;
use App\Models\Poi_Tipologia;
use App\Models\Tipologia;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Storage;

class poiCrudController extends Controller
{

    public function redirecToSection($section){
        return view('adminPoi', ['section' => $section]);
    }

    public function store(AdminPoiCreateRequest $request)
    {
        $requestV = $request->validated();
        //Comprobar que tipologias seleccionadas existen
        $errorvTipo = false;
        $tipoTam = count($requestV['tipo']);
        for($i=0;$i < $tipoTam;$i++){
            $ctSsTipo = Tipologia::select('id_tipologia')->where([['id_tipologia','=',($requestV['tipo'])[$i]],['estado','=','true']])->count();
            if($ctSsTipo==0){
                $errorvTipo = true;
                break;
            }
        }
        
        $errorName = false;
        if(!$errorvTipo){
            //Comprobar que el poi no tenga el mismo nombre a otro poi
            $nctNamePoi = Poi::select('nombre')->whereRaw('UPPER(nombre)=UPPER(\''.$requestV['name'].'\')')->count();
            if($nctNamePoi>0){
                $errorName = true;
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
        if($errorName || $errorvTipo || $errorLongCord || $errorvMun){
            if($errorName)
                array_push($errores, "El nombre del PoI duplicado.");
            if($errorvTipo)
                array_push($errores, "Una o varias de las tipologias seleccionadas no existen.");
            if($errorLongCord)
                array_push($errores, "La longitud de las coordenadas deben ser menores a 9.");
            if($errorvMun)
                array_push($errores, "El municipio escogido no se encuentra registrado.");
            return view('adminPoi', ['section' => 'agregar', 'errores' => $errores]);
        }else{
            $nextVal = Poi_Seq::select('last_value','is_called')->get();
            if(($nextVal[0])->is_called)
                ($nextVal[0])->last_value++;
            $ext = $requestV['image']->getClientOriginalExtension();
            $path = $requestV['image']->storeAs('poiPhotos', ($nextVal[0])->last_value . '.' . $ext,'poiPhotos');
            Poi::create([
                'nombre' => $requestV["name"],
                'coordenadax' => $requestV["cx"],
                'coordenaday' => $requestV["cy"],
                'tiempoestancia' => $requestV["time"],
                'descripcion' => $requestV["description"],
                'imagen' => $path,
                'estado' => true,
                'fk_id_municipio' => $requestV["town"]
            ]);

            for ($i=0; $i < $tipoTam; $i++) { 
                Poi_Tipologia::create([
                    'fk_id_poi' => ($nextVal[0])->last_value,
                    'fk_id_tipologia' => ($requestV["tipo"])[$i],
                    'estado' => true
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

    public function update(AdminPoiModifyRequest $request)
    {
        $requestV = $request->validated();

        //Comprobar que el poi existe
        $errorvPoi = false;
        $countPoi=Poi::select('id_poi')->where('id_poi','=',$requestV['id'])->count();
        if($countPoi==0){
            $errorvPoi = true;
        }

        //Comprobar que tipologias seleccionadas existen
        $errorvTipo = false;
        $stipoTam = count($requestV['tipo']);
        for($i=0;$i < $stipoTam;$i++){
            $ctSsTipo = Tipologia::select('id_tipologia')->where([['id_tipologia','=',($requestV['tipo'])[$i]],['estado','=','true']])->count();
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
        if($errorvMun || $errorvPoi || $errorvTipo || $errorLongCord){
            if($errorvMun)
                array_push($errores, "El municipio escogido no se encuentra registrado.");
            if($errorEstancia)
                array_push($errores, "El tiempo de estancia supera las 12 horas.");
            if($errorvPoi)
                array_push($errores, "El ID del PoI no existe.");
            if($errorLongCord)
                array_push($errores, "La longitud de las coordenadas deben ser menores a 9.");
            return view('adminPoi', ['section' => 'modificar', 'errores' => $errores]);
        }else{
            $estado = ($requestV["state"]==0) ? false : true;
            //*
            if ($request->hasFile('image'))
            {
                $pathImg = Poi::select('imagen')->where('id_poi','=',$requestV["id"])->get();
                Storage::disk('poiPhotos')->delete($pathImg[0]->imagen);
                $ext = $requestV['image']->getClientOriginalExtension();
                $path = $requestV['image']->storeAs('poiPhotos', $requestV["id"] . '.' . $ext,'poiPhotos');
                Poi::where('id_poi', $requestV["id"])->update([
                    'imagen' => $path
                ]);
            }
            //*
            
            Poi::where('id_poi', $requestV["id"])->update([
                'nombre' => $requestV["name"],
                'coordenadax' => $requestV["cx"],
                'coordenaday' => $requestV["cy"],
                'tiempoestancia' => $requestV["time"],
                'descripcion' => $requestV["description"],
                'estado' => $estado,
                'fk_id_municipio' => $requestV["town"]
            ]);

            Poi_Tipologia::where('fk_id_poi','=',$requestV["id"])->update([
                        'estado' => false
                    ]); 
            for ($i=0; $i < $stipoTam; $i++) {
                $ctPxT = Poi_Tipologia::select('fk_id_tipologia')->where([['fk_id_poi','=',$requestV["id"]],['fk_id_tipologia','=',($requestV["tipo"])[$i]]])->count();
                if(empty($ctPxT)){
                    Poi_Tipologia::create([
                        'fk_id_poi' => $requestV["id"],
                        'fk_id_tipologia' => ($requestV["tipo"])[$i],
                        'estado' => true
                    ]);
                }else{
                    Poi_Tipologia::where([['fk_id_poi','=',$requestV["id"]],['fk_id_tipologia','=',($requestV["tipo"])[$i]]])->update([
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
