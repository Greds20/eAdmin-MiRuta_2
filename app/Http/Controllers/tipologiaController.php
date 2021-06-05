<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tipologia;
use App\Http\Requests\tipologiaRequest;
use App\Models\Log;
use Carbon\Carbon;

class tipologiaController extends Controller
{
    public function redirecToSection($section){
        return view('adminTipology', ['section' => $section]);
    }

    //CRUD----------------------------------------------------

    public function store(tipologiaRequest $request)
    {
        $requestV = $request->validated();

        //Comprobar que la tipologia no tenga el mismo nombre a otra tipologia
        $errorName = false;
        $nctNameTip = Tipologia::select('nombre')->where('nombre','=',$requestV['name'])->count();
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
                'estado' => 1
            ]);
            Log::create([
                'fecha' => Carbon::now()->toDateString(),
                'hora' => Carbon::now()->toTimeString(),
                'fk_id_administrador' => '1',
                'fk_id_seccion' => '3',
                'fk_id_evento' => '1'
            ]);
            return redirect()->route('tipologia.redirecToSection', ['section' => 'agregar']);
        }
    }

    public function update(tipologiaRequest $request)
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

        //Comprobar que la tipologia existe
        $errorvTip = false;
        $countTip=Tipologia::select('id_tipologia')->where('id_tipologia','=',$requestEx['id'])->count();
        if($countTip==0){
            $errorvTip = true;
        }
        
        //Comprobar que la tipologia no tenga el mismo nombre a otra tipologia
        $errorName = false;
        $nctNameTip = Tipologia::select('nombre')->where([['nombre','=',$requestV['name']],['id_tipologia','<>',$requestEx['id']]])->count();
        if($nctNameTip>0){
            $errorName = true;
        }

        $errores = [];
        if($errorvTip || $errorName){
            if($errorvTip)
                array_push($errores, "El ID no existe.");
            if($errorName)
                array_push($errores, "Nombre duplicado.");
            return view('adminTipology', ['section' => 'modificar', 'errores' => $errores]);
        }else{
            Tipologia::where('id_tipologia', $requestEx["id"])->update([
                'nombre' => $requestV["name"],
                'descripcion' => $requestV["description"],
                'estado' => $requestEx["state"],
            ]);
            Log::create([
                'fecha' => Carbon::now()->toDateString(),
                'hora' => Carbon::now()->toTimeString(),
                'fk_id_administrador' => '1',
                'fk_id_seccion' => '3',
                'fk_id_evento' => '2'
            ]);
            return redirect()->route('tipologia.redirecToSection', ['section' => 'modificar']);
        }
    }

    //Ajax----------------------------------------------------

    //Obtener tipologias
    public function getTipologias(Request $request){
        switch ($request->get('type')) {
            case "Min":
                $select = ['nombre'];
                break;
            case "Bas":
                $select = ['id_tipologia','nombre'];
                break;
            case "Max":
                $select = ['*'];
                break;
            default:
                $select = ['*'];
                break;
        }
        $where = ($request->get('all')=="1") ? "1" : "estado = 1";
        $tipologias = Tipologia::select($select)->whereRaw($where)->get();
        return $tipologias;
    }

    //Obtener tipologia
    public function getTipologia(Request $request){
        $tipologia = Tipologia::select('*')->where('id_tipologia', '=', $request->get('id'))->get();
        return $tipologia;
    }

    //Buscar y obtener tipologias
    public function searchTipologias(Request $request){
        switch ($request->get('type')) {
            case "Min":
                $select = ['nombre'];
                break;
            case "Bas":
                $select = ['id_tipologia','nombre'];
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
        $tipologias = Tipologia::select($select)->whereRaw($where)->get();
        return $tipologias;
    }
}
