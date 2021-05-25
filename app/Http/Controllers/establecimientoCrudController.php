<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Establecimiento;
use App\Http\Requests\CreateEstablecimientoRequest;
use App\Http\Requests\ModifyEstablecimientoRequest;
use App\Models\Log;
use Carbon\Carbon;

class establecimientoCrudController extends Controller
{
    public function redirecToSection($section){
        return view('adminEstablishment', ['section' => $section]);
    }

    public function store(CreateEstablecimientoRequest $request)
    {
        $requestV = $request->validated();

        //Comprobar que el establecimiento no tenga el mismo nombre a otro
        $errorName = false;
        $nctNameEstab = Establecimiento::select('nombre')->whereRaw('UPPER(nombre)=UPPER(\''.$requestV['name'].'\')')->count();
        if($nctNameEstab>0){
            $errorName = true;
        }

        $errores = [];
        if($errorName){
            if($errorName)
                array_push($errores, "Nombre de establecimiento duplicado.");
            return view('adminEstablishment', ['section' => 'agregar', 'errores' => $errores]);
        }else{
            Establecimiento::create([
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
            return redirect()->route('establecimientoCrud.redirecToSection', ['section' => 'agregar']);
        }
    }

    public function update(ModifyEstablecimientoRequest $request)
    {
        $requestV = $request->validated();

        //Comprobar que el establecimiento existe
        $errorvEstab = false;
        $countEstab=Establecimiento::select('id_tipologia')->where('id_tipologia','=',$requestV['id'])->count();
        if($countEstab==0){
            $errorvEstab = true;
        }
        
        $errorName = false;
        if(!$errorvEstab){
            //Comprobar que el establecimiento no tenga el mismo nombre a otro
            $nctNameEstab = Establecimiento::select('nombre')->whereRaw('UPPER(nombre)=UPPER(\''.$requestV['name'].'\')')->count();
            if($nctNameEstab>0){
                $errorName = true;
            }
        }

        $errores = [];
        if($errorvEstab || $errorName){
            if($errorvEstab)
                array_push($errores, "El ID del establecimiento no existe.");
            if($errorName)
                array_push($errores, "Nombre de establecimiento duplicado.");
            return view('adminEstablishment', ['section' => 'modificar', 'errores' => $errores]);
        }else{
            $estado = ($requestV["state"]==0) ? false : true;
            Establecimiento::where('id_tipologia', $requestV["id"])->update([
                'nombre' => $requestV["name"],
                'descripcion' => $requestV["description"],
                'estado' => $estado
            ]);
            Log::create([
                'fecha' => Carbon::now()->toDateString(),
                'hora' => Carbon::now()->toTimeString(),
                'fk_id_administrador' => '1',
                'fk_id_seccion' => '3',
                'fk_id_evento' => '2'
            ]);
            return redirect()->route('establecimientoCrud.redirecToSection', ['section' => 'modificar']);
        }
    }
}
