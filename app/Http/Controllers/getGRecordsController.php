<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Municipio;
use App\Models\Tipo;
use App\Models\Rol;

class getGRecordsController extends Controller
{
    //Obtener municipios
    public function getMunicipios(){
        $municipios = Municipio::select('id_municipio', 'nombre')->orderBy('id_municipio','ASC')->get();
        return $municipios;
    }

    //Obtener tipos de establecimientos
    public function getTipos(){
        $tipos = Tipo::select('id_tipo', 'nombre')->orderBy('id_tipo','ASC')->get();
        return $tipos;
    }

    //Obtener roles de administrador
    public function getRoles(){
        $roles = Rol::select('id_rol', 'nombre')->orderBy('id_rol','ASC')->get();
        return $roles;
    }
}
