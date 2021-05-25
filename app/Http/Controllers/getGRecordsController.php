<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Municipio;

class getGRecordsController extends Controller
{
    //Obtener municipios según el estado
    public function getMunicipio(){
        $records = Municipio::select('id_municipio', 'nombre')->get();
        return $records;
    }
}
