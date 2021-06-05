<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Establecimiento;
use App\Http\Requests\establecimientoRequest;
use App\Http\Requests\ModifyEstablecimientoRequest;
use App\Models\Log;
use Carbon\Carbon;

class establecimientoController extends Controller
{
    public function redirecToSection($section){
        return view('adminEstablishment', ['section' => $section]);
    }

    public function store(establecimientoRequest $request)
    {
        $requestV = $request->validated();

        //Comprobar que el establecimiento no tenga el mismo nombre a otro
        $errorName = false;
        $nctNameEstab = Establecimiento::select('nombre')->where('nombre','=',$requestV['name'])->count();
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
                'coordenadaX' => $requestV["cx"],
                'coordenadaY' => $requestV["cy"],
                'estado' => 1,
                'fk_id_municipio' => $requestV["town"],
                'fk_id_tipo' => $requestV["type"]
            ]);
            Log::create([
                'fecha' => Carbon::now()->toDateString(),
                'hora' => Carbon::now()->toTimeString(),
                'fk_id_administrador' => '1',
                'fk_id_seccion' => '6',
                'fk_id_evento' => '1'
            ]);
            return redirect()->route('establecimiento.redirecToSection', ['section' => 'agregar']);
        }
    }

    public function update(establecimientoRequest $request)
    {
        $requestV = $request->validated();
        $requestEx = $request->validate([
            'id' => 'required|integer|min:0|max:127',
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


        //Comprobar que el establecimiento existe
        $errorvEstab = false;
        $countEstab=Establecimiento::select('id_establecimiento')->where('id_establecimiento','=',$requestEx['id'])->count();
        if($countEstab==0){
            $errorvEstab = true;
        }
        
        //Comprobar que el establecimiento no tenga el mismo nombre a otro
        $errorName = false;
        $nctNameEstab = Establecimiento::select('nombre')->where([['nombre','=',$requestV['name']],['id_establecimiento','<>',$requestEx['id']]])->count();
        if($nctNameEstab>0){
            $errorName = true;
        }

        $errores = [];
        if($errorvEstab || $errorName){
            if($errorvEstab)
                array_push($errores, "El ID no existe.");
            if($errorName)
                array_push($errores, "Nombre duplicado.");
            return view('adminEstablishment', ['section' => 'modificar', 'errores' => $errores]);
        }else{
            Establecimiento::where('id_establecimiento', $requestEx["id"])->update([
                'nombre' => $requestV["name"],
                'descripcion' => $requestV["description"],
                'coordenadaX' => $requestV["cx"],
                'coordenadaY' => $requestV["cy"],
                'estado' => $requestEx["state"],
                'fk_id_municipio' => $requestV["town"],
                'fk_id_tipo' => $requestV["type"]
            ]);
            Log::create([
                'fecha' => Carbon::now()->toDateString(),
                'hora' => Carbon::now()->toTimeString(),
                'fk_id_administrador' => '1',
                'fk_id_seccion' => '6',
                'fk_id_evento' => '2'
            ]);
            return redirect()->route('establecimiento.redirecToSection', ['section' => 'modificar']);
        }
    }

    //Ajax----------------------------------------------------

    //Obtener tipologias
    public function getEstablecimientos(Request $request){
        switch ($request->get('type')) {
            case "Min":
                $select = ['nombre'];
                break;
            case "Bas":
                $select = ['id_establecimiento','nombre'];
                break;
            case "Max":
                $select = ['*'];
                break;
            default:
                $select = ['*'];
                break;
        }
        $where = ($request->get('all')=="1") ? "1" : "estado = 1";
        $establecimientos = Establecimiento::select($select)->whereRaw($where)->get();
        return $establecimientos;
    }

    //Obtener tipologia
    public function getEstablecimiento(Request $request){
        $establecimiento = Establecimiento::select('*')->where('id_establecimiento', '=', $request->get('id'))->get();
        return $establecimiento;
    }

    //Buscar y obtener tipologias
    public function searchEstablecimientos(Request $request){
        switch ($request->get('type')) {
            case "Min":
                $select = ['nombre'];
                break;
            case "Bas":
                $select = ['id_establecimiento','nombre'];
                break;
            case "Max":
                $select = ['*'];
                break;
            default:
                $select = ['*'];
                break;
        }
        $where = "";
        if($request->get('all')=="0"){
            $where = "estado = 1";
        }
        $like = "nombre LIKE '".$request->get('term')."%'";
        if(!is_null($request->get('term'))){
            $where .= ($where == "") ? $like : " AND ".$like;
        }
        $where .= ($where=="") ? "1" : "";
        $establecimientos = Establecimiento::select($select)->whereRaw($where)->get();
        return $establecimientos;
    }
}
