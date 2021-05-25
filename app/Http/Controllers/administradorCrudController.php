<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use App\Http\Requests\CreateAdministradorRequest;
use App\Http\Requests\ModifyAdministradorRequest;
use App\Mail\eAdminEmail;
use App\Models\Rol;
use Illuminate\Http\Request;
use App\Models\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class administradorCrudController extends Controller
{

    public function redirecToSection($section){
        return view('adminAdministrator', ['section' => $section]);
    }

    public function store(CreateAdministradorRequest $request)
    {
        $requestV = $request->validated();
        //Comprobar que el alias no existe
        $errorName = false;
        $nctNameAdmin = Administrador::select('alias')->whereRaw('UPPER(alias)=UPPER(\''.$requestV['alias'].'\')')->count();
        if($nctNameAdmin>0){
            $errorName = true;
        }

        //Comprobar que el rol existe
        $errorIdRol = false;
        $nctIdRol = Rol::where('id_rol','=',$requestV['rol'])->count();
        if($nctIdRol==0){
            $errorIdRol = true;
        }

        //Comprobar que el correo no existe
        $ctEmail = Administrador::select('id_administrador')->where('correo','=',$requestV['email'])->count();
        $errorxEmail = ($ctEmail > 0) ? true : false;

        $errores = [];
        if($errorName || $errorIdRol || $errorxEmail){
            if($errorName)
                array_push($errores, "Nombre del alias duplicado.");
            if($errorIdRol)
                array_push($errores, "El ID del rol seleccionado no existe.");
            if($errorxEmail)
                array_push($errores, "El correo electrónico ingresado ya está en uso.");
            return view('adminAdministrator', ['section' => 'agregar', 'errores' => $errores]);
        }else{ 
            Administrador::create([
                'alias' => $requestV["alias"],
                'prnombre' => $requestV["frname"],
                'sgnombre' => $requestV["scname"],
                'prapellido' => $requestV["frsurname"],
                'sgapellido' => $requestV["scsurname"],
                'contrasena' => $requestV["pass"],
                'correo' => $requestV["email"],
                'estado' => true,
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

    
    public function update(ModifyAdministradorRequest $request)
    {
        $requestV = $request->validated();

        //Comprobar que existe el id
        $errorvId = false;
        $errorAlias = false;
        $errorvSis = false;
        $admin = Administrador::select('id_administrador','alias','correo')->where('id_administrador','=',$requestV['id'])->get();        //COnsigue ID y correo
        if(count($admin)>0){
            //Comprobar que el alias no se repite
            $nctAlias = Administrador::select('alias')->whereRaw('UPPER(alias)=UPPER(\''.$requestV['alias'].'\')')->where('id_administrador','<>',$requestV['id'])->count();
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
            $estado = ($requestV["state"]==0) ? false : true;
            if(isset($requestV["recover"])){
                $pass = $this->randomPass();
                $msgfirst = "Le informamos que su solicitud de cambio de contraseña se realizo con exito.";
                $msglast = "Le recomendamos cambiar prontamente la contraseña.";
                $contend = [ 'subject' => 'Recuperación de contraseña', 'alias' => $requestV["alias"], 'pass' => $pass, 'messagefirst' => $msgfirst, 'messagelast' => $msglast ];
                Mail::to($admin[0]->correo)->queue(new eAdminMail($contend));
                //return new eAdminMail($contend);
                Administrador::where('id_administrador', $requestV["id"])->update([
                    'alias' => $requestV["alias"],
                    'contrasena' => $pass,
                    'estado' => $estado
                ]);
            }else{
                Administrador::where('id_administrador', $requestV["id"])->update([
                    'alias' => $requestV["alias"],
                    'estado' => $estado
                ]);
            }
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
