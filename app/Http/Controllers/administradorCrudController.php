<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use App\Http\Requests\administradorRequest;
use App\Mail\eAdminEmail;
use App\Models\Rol;
use Illuminate\Http\Request;
use App\Models\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class administradorCrudController extends Controller
{

    public function redirecToSection($section){
        return view('adminAdministrator', ['section' => $section]);
    }

    public function store(administradorRequest $request)
    {
        $requestV = $request->validated();

        //Comprobar que el alias no existe
        $errorName = false;
        $nctNameAdmin = Administrador::select('alias')->where('alias','=',$requestV['alias'])->count();
        if($nctNameAdmin>0){
            $errorName = true;
        }

        //Comprobar que el rol existe
        $errorIdRol = false;
        $nctIdRol = Rol::where('id_rol','=',$requestV['rol'])->count();
        if($nctIdRol==0){
            $errorIdRol = true;
        }

        //Comprobar que las contraseñas son iguales
        $errorPass=false;
        if($requestV['pass']!=$requestV['passR']){
            $errorPass = true;
        }

        //Comprobar que el correo no existe
        $ctEmail = Administrador::select('id_administrador')->where('correo','=',$requestV['email'])->count();
        $errorxEmail = ($ctEmail > 0) ? true : false;

        $errores = [];
        if($errorName || $errorIdRol || $errorxEmail || $errorPass){
            if($errorName)
                array_push($errores, "Alias no disponible.");
            if($errorIdRol)
                array_push($errores, "El rol seleccionado no existe.");
            if($errorxEmail)
                array_push($errores, "El correo electrónico ingresado ya está en uso.");
            if($errorPass)
                array_push($errores, "La contraseña y la confirmación de la contraseña no corresponden.");
            return view('adminAdministrator', ['section' => 'agregar', 'errores' => $errores]);
        }else{ 
            Administrador::create([
                'alias' => $requestV["alias"],
                'prnombre' => $requestV["frname"],
                'sgnombre' => $requestV["scname"],
                'prapellido' => $requestV["frsurname"],
                'sgapellido' => $requestV["scsurname"],
                'contrasena' => Hash::make($requestV["pass"]),
                'recuperador' => "0",
                'tiempoRecuperador' => "2000-01-01 00:00:00",
                'correo' => $requestV["email"],
                'estado' => 1,
                'fk_id_rol' => $requestV["rol"]
            ]);
            Log::create([
                'fecha' => Carbon::now()->toDateString(),
                'hora' => Carbon::now()->toTimeString(),
                'fk_id_administrador' => '1',
                'fk_id_seccion' => '5',
                'fk_id_evento' => '1'
            ]);
            return redirect()->route('administradorCrud.redirecToSection', ['section' => 'agregar']);
        }
    }

    
    public function update(Request $request)
    {
        $requestV = $request->validate([
            'id' => 'required|integer|min:0|max:127',
            'alias' => 'required|max:30',
            'state' => 'required|integer|digits_between:0,1'
        ],[
            'id.required' => 'El ID es requerido.',
            'id.integer' => 'El ID debe estar en números enteros.',
            'id.min' => 'El ID debe ser mayor a 0.',
            'id.max' => 'El ID súpera el límite establecido.',

            'alias.required' => 'Alias de usuario requerido.',
            'alias.max' => 'El alias del usuario debe tener menos de 30 carácteres.',

            'state.required' => 'El estado es requerido.',
            'state.integer' => 'El estado debe estar en números enteros.',
            'state.digits_between' => 'El estado no está dentro del rango establecido.'
        ]);

        //Comprobar que existe el id
        $errorvId = false;
        $errorAlias = false;
        $errorvSis = false;
        $admin = Administrador::select('id_administrador','alias','correo')->where('id_administrador','=',$requestV['id'])->get();        //Consigue ID y correo
        if(count($admin)>0){
            //Comprobar que el alias no se repite
            $nctAlias = Administrador::select('alias')->where([['id_administrador','<>',$requestV['id']],['alias','=',$requestV['alias']]])->count();
            if($nctAlias>0){
                $errorAlias = true;
            }
            //Comprobar si es administrador SISTEMA
            $errorvSis = ($admin[0]->alias == "SISTEMA") ? true : false;
        }else{
            $errorvId = true;
        }

        $errores = [];
        if($errorvId || $errorAlias || $errorvSis){
            if($errorAlias)
                array_push($errores, "Nombre del alias duplicado.");
            if($errorvId)
                array_push($errores, "El ID del usuario seleccionado no existe.");
            if($errorvSis)
                array_push($errores, "No tiene permisos para modificar el usuario SISTEMA.");
            return view('adminAdministrator', ['section' => 'modificar', 'errores' => $errores]);
        }else{
            Administrador::where('id_administrador', $requestV["id"])->update([
                    'alias' => $requestV["alias"],
                    'estado' => $requestV["state"]
                ]);
            Log::create([
                'fecha' => Carbon::now()->toDateString(),
                'hora' => Carbon::now()->toTimeString(),
                'fk_id_administrador' => '1',
                'fk_id_seccion' => '5',
                'fk_id_evento' => '2'
            ]);
            return redirect()->route('administradorCrud.redirecToSection', ['section' => 'modificar']);
        }
    }

    public function randomPass(){
       $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890!#$%&./<=>?@[\]_|";
       $password = "";
       for($i=0;$i<11;$i++) {
          $password .= substr($str,rand(0,79),1);
       }
       return $password;
    }
}
