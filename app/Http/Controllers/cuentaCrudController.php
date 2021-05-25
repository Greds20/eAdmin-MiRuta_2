<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ModifyPassAdministradorRequest;
use App\Http\Requests\ModifyInfoAdministradorRequest;
use App\Models\Administrador;

class cuentaCrudController extends Controller
{
    public function redirecToAccount(Request $request){
    	$infoAdmin = $this->getInfoAdmin($request->alias); 
        return view('adminAccount', ['alias' => $infoAdmin->alias, 'infoAdmin'=>$infoAdmin]);
    }

    public function getInfoAdmin($alias){
    	return (Administrador::select('id_administrador','alias','prnombre','sgnombre','prapellido','sgapellido','nombre','correo')->leftjoin('rol','id_rol','=','fk_id_rol')->where('alias','=',$alias)->get())[0];
    }

    public function updatePublic(ModifyInfoAdministradorRequest $request){
        $requestV = $request->validated();

        //Comprobar que el usuario exista y no sea el SISTEMA
        $errorid = false;
        $errorAliasSis = false;
        $admin = Administrador::select('id_administrador','alias')->where('alias','=',$request->alias)->get();		//Se obtiene el ID
        if(count($admin) == 0){
        	$errorid = true;
        }else{
        	$errorAliasSis = ($request->alias == "SISTEMA") ? true : false;
        }

        //Comprobar que el nuevo correo no existe
        $ctEmail = Administrador::select('id_administrador')->where([['alias','<>',$request->alias],['correo','=',$requestV['email']]])->count();
        $errorxEmail = ($ctEmail > 0) ? true : false;

        $errores = [];
        if($errorid || $errorAliasSis || $errorxEmail){
            if($errorid)
                array_push($errores, "El ID del administrador no existe.");
            if($errorAliasSis)
                array_push($errores, "No tiene permisos para modificar el usuario SISTEMA.");
            if($errorxEmail)
                array_push($errores, "El correo electrónico ingresado ya está en uso.");
            $infoAdmin = $this->getInfoAdmin($request->alias); 
            return view('adminAccount', ['alias' => $request->alias, 'infoAdmin'=>$infoAdmin, 'errores' => $errores]);
        }else{ 
        	Administrador::where('id_administrador', $admin[0]->id_administrador)->update([
                'prnombre' => $requestV["frname"],
                'sgnombre' => $requestV["scname"],
                'prapellido' => $requestV["frsurname"],
                'sgapellido' => $requestV["scsurname"],
                'correo' => $requestV["email"]
            ]);
            return redirect()->route('cuentaCrud.redirecToAccount', $request->alias);
        }
    }

    public function updatePass(ModifyPassAdministradorRequest $request){
        $requestV = $request->validated();
        //Comprobar que el usuario exista y no sea el SISTEMA
        $errorid = false;
        $errorAliasSis = false;
        $admin = Administrador::select('id_administrador','alias')->where('alias','=',$request->alias)->get();		//Se obtiene el ID
        if(count($admin) == 0){
        	$errorid = true;
        }else{
        	$errorAliasSis = ($request->alias == "SISTEMA") ? true : false;
        }

        //Comprobar que la contraseña actual es igual a la de la BBDD
        $ctpass = Administrador::select('id_administrador')->where([['alias','=',$request->alias],['contrasena','=',$requestV['oldpass']]])->count();
        $errorOldPass = ($ctpass == 0) ? true : false;

        //Comprobar que la contraseña nueva es igual a la repetida
        $errorPassfxPassl = false;
        if($requestV['newpassf'] != $requestV['newpassl']){
        	$errorPassfxPassl = true;
        }
        
        //Comprobar que la nueva contraseña es diferente a la actual
        $errorNpassvOpass = false;
        if($requestV['oldpass']==$requestV['newpassf']){
        	$errorNpassvOpass = true;
        }

        $errores = [];
        if($errorid || $errorAliasSis || $errorOldPass || $errorPassfxPassl || $errorNpassvOpass){
            if($errorid)
                array_push($errores, "El ID del administrador no existe.");
            if($errorAliasSis)
                array_push($errores, "No tiene permisos para modificar el usuario SISTEMA.");
            if($errorOldPass)
                array_push($errores, "La contraseña actual no coincide con la contraseña de la base de datos.");
            if($errorPassfxPassl)
                array_push($errores, "La nueva contraseña no coinciden.");
            if($errorNpassvOpass)
                array_push($errores, "La contraseña actual y la contraseña nueva son similares.");
            $infoAdmin = $this->getInfoAdmin($request->alias); 
            return view('adminAccount', ['alias' => $request->alias, 'infoAdmin'=>$infoAdmin, 'errores' => $errores]);
        }else{ 
        	Administrador::where('id_administrador', $admin[0]->id_administrador)->update([
                'contrasena' => $requestV["newpassf"]
            ]);
            return redirect()->route('cuentaCrud.redirecToAccount', $request->alias);
        }
    }
}
