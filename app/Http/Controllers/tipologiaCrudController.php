<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tipologia;
use App\Http\Requests\CreateTipologiaRequest;
use App\Http\Requests\ModifyTipologiaRequest;
use App\Models\Log;
use Carbon\Carbon;

class tipologiaCrudController extends Controller
{
    public function redirecToSection($section){
        return view('adminTipology', ['section' => $section]);
    }

    public function store(CreateTipologiaRequest $request)
    {
        $requestV = $request->validated();

        //Comprobar que la tipologia no tenga el mismo nombre a otra tipologia
        $errorName = false;
        $nctNameTip = Tipologia::select('nombre')->whereRaw('UPPER(nombre)=UPPER(\''.$requestV['name'].'\')')->count();
        if($nctNameTip>0){
            $errorName = true;
        }

        $errores = [];
        if($errorName){
            if($errorName)
                array_push($errores, "Nombre de tipologia duplicado.");
            return view('adminTipology', ['section' => 'agregar', 'errores' => $errores]);
        }else{
            Tipologia::create([
                'nombre' => $requestV["name"],
                'descripcion' => $requestV["description"],
                'estado' => true
            ]);
            Log::create([
                'fecha' => Carbon::now()->toDateString(),
                'hora' => Carbon::now()->toTimeString(),
                'fk_id_administrador' => '1',
                'fk_id_seccion' => '3',
                'fk_id_evento' => '1'
            ]);
            return redirect()->route('tipologiaCrud.redirecToSection', ['section' => 'agregar']);
        }
    }

    public function update(ModifyTipologiaRequest $request)
    {
        $requestV = $request->validated();

        //Comprobar que la tipologia existe
        $errorvTip = false;
        $countTip=Tipologia::select('id_tipologia')->where('id_tipologia','=',$requestV['id'])->count();
        if($countTip==0){
            $errorvTip = true;
        }
        
        $errorName = false;
        if(!$errorvTip){
            //Comprobar que la tipologia no tenga el mismo nombre a otra tipologia
            $nctNameTip = Tipologia::select('nombre')->whereRaw('UPPER(nombre)=UPPER(\''.$requestV['name'].'\')')->count();
            if($nctNameTip>0){
                $errorName = true;
            }
        }

        $errores = [];
        if($errorvTip || $errorName){
            if($errorvTip)
                array_push($errores, "El ID de la tipología no existe.");
            if($errorName)
                array_push($errores, "Nombre de tipologia duplicado.");
            return view('adminTipology', ['section' => 'modificar', 'errores' => $errores]);
        }else{
            $estado = ($requestV["state"]==0) ? false : true;
            Tipologia::where('id_tipologia', $requestV["id"])->update([
                'nombre' => $requestV["name"],
                'descripcion' => $requestV["description"],
                'estado' => $estado,
            ]);
            Log::create([
                'fecha' => Carbon::now()->toDateString(),
                'hora' => Carbon::now()->toTimeString(),
                'fk_id_administrador' => '1',
                'fk_id_seccion' => '3',
                'fk_id_evento' => '2'
            ]);
            return redirect()->route('tipologiaCrud.redirecToSection', ['section' => 'modificar']);
        }
    }
}
