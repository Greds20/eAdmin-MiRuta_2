<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;
use App\Models\Administrador;

class administradoresDynamicController extends Controller
{
    //Obtener todos los roles
    public function fillRoles(){
        $query = Rol::select('id_rol','nombre')->where('estado','=','true')->get();
        return $query;
    }

    public function searchUser(Request $request){
        if(is_null($request->get('term'))){
        	if($request->get('state') == "1"){
        		$querys = Administrador::select('id_administrador', 'alias')->where('id_administrador','<>',1)->get();
        	}else{
        		$querys = Administrador::select('id_administrador', 'alias')->where([['estado','=',1],['id_administrador','<>',1]])->get();
        	}
        }else{
        	if($request->get('state') == "1"){
        		$querys = Administrador::select('id_administrador', 'alias')->where([['alias', 'LIKE', $request->get('term').'%'],['id_administrador','<>','1']])->get();
        	}else{
        		$querys = Administrador::select('id_administrador', 'alias')->where([['alias', 'LIKE', $request->get('term').'%'],['estado','=',1],['id_administrador','<>','1']])->get();
        	}
        }
        
        $data = [];

        foreach ($querys as $query) {
            $data[] = [
                'label' => $query->alias,
                'id' => $query->id_administrador
            ];
        }
        return $data;
    }

    //Obtener info de un usuario traida por un ID (Info propia)
    public function getAllSelectedUser(Request $request){
        $sUser = Administrador::select('alias','prnombre', 'sgnombre', 'prapellido', 'sgapellido', 'estado','fk_id_rol','correo')->where('id_administrador', '=', $request->id)->get();

        $sRol = Rol::select('nombre')->where('id_rol','=',$sUser[0]->fk_id_rol)->get();

        return [$sUser[0], $sRol[0]];
    }

    public function searchAllUser(Request $request){
        if(is_null($request->get('term'))){
        	$querys = Administrador::select('id_administrador', 'alias')->get();
        }else{
        	$querys = Administrador::select('id_administrador', 'alias')->where([['alias', 'LIKE', '%' . $request->get('term') . '%'],['id_administrador','<>','1']])->get();
        }
        
        $data = [];

        foreach ($querys as $query) {
            $data[] = [
                'label' => $query->alias,
                'id' => $query->id_administrador
            ];
        }
        return $data;
    }

    //Obtener info de un usuario traida por un ID (Info propia)
    public function getSelectedUser(Request $request){
        $id = $request->get('id');
        $sUser = Administrador::select('id_administrador', 'alias', 'estado', 'correo')->where('id_administrador', '=', $id)->get();

        return [$sUser[0]];
    }

}
