<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Factor;
use App\Models\Factor_Variable;
use App\Models\Variable;
use App\Models\Formula;

class formulaDynamicController extends Controller
{
	public function fillTVarxFac(Request $request){
		if($request->all=="true"){
			$factor = Factor::select('id_factor','nombre','peso','valormaximo','valorminimo','descripcion','factor.estado AS estado')->leftjoin('factor_variable', 'id_factor', '=', 'fk_id_factor')->whereNull('fk_id_factor')->where('fk_id_formula', '=', $request->id)->get();
			$var = Variable::select('id_variable','variable.nombre','variable.descripcion','variable.valormaximo','variable.estado')->leftjoin('factor_variable','fk_id_variable','=','id_variable')->leftjoin('factor','id_factor','=','fk_id_factor')->where('fk_id_formula','=',$request->id)->groupBy('id_variable')->get();
			$sfactor = Factor::select('fk_id_variable','factor.id_factor','factor.nombre','factor.descripcion','valorminimo','factor.valormaximo','peso','factor.estado')->leftjoin('factor_variable','fk_id_factor','=','id_factor')->leftjoin('variable','id_variable','=','fk_id_variable')->where('fk_id_formula', '=', $request->id)->get();
		}else{
			$factor = Factor::select('id_factor','nombre','peso','valormaximo','valorminimo','descripcion','factor.estado AS estado')->leftjoin('factor_variable', 'id_factor', '=', 'fk_id_factor')->whereNull('fk_id_factor')->where([['fk_id_formula', '=', $request->id],['factor.estado','=',true]])->get();
			$var = Variable::select('id_variable','variable.nombre','variable.descripcion','variable.valormaximo','variable.estado')->leftjoin('factor_variable','fk_id_variable','=','id_variable')->leftjoin('factor','id_factor','=','fk_id_factor')->where([['fk_id_formula','=',$request->id],['variable.estado','=',true]])->groupBy('id_variable')->get();
			$sfactor = Factor::select('fk_id_variable','factor.id_factor','factor.nombre','factor.descripcion','valorminimo','factor.valormaximo','peso','factor.estado')->leftjoin('factor_variable','fk_id_factor','=','id_factor')->leftjoin('variable','id_variable','=','fk_id_variable')->where([['factor.estado','=',true],['variable.estado','=',true],['fk_id_formula', '=', $request->id]])->get();
		}
		$form = (Formula::select('estado','descripcion')->where('id_formula','=',$request->id)->get())[0];
		return [$factor, $var, $sfactor, $form];
	}

	public function fillTVarxFacxSfac(Request $request){
		$fac = Factor::select('nombre','peso','valormaximo','valorminimo','descripcion')->leftjoin('factor_variable', 'id_factor', '=', 'fk_id_factor')->whereNull('fk_id_factor')->where([['fk_id_formula', '=', $request->id],['factor.estado','=',true]])->get();
		$var = Variable::select('variable.nombre','variable.descripcion','variable.valormaximo')->leftjoin('factor_variable','fk_id_variable','=','id_variable')->leftjoin('factor','id_factor','=','fk_id_factor')->where([['fk_id_formula','=',$request->id],['variable.estado','=',true]])->groupBy('id_variable')->get();
		$subf = Factor::select('variable.nombre AS variable','factor.nombre','factor.descripcion','valorminimo','factor.valormaximo','peso','variable.valormaximo AS valormaximoV')->leftjoin('factor_variable','fk_id_factor','=','id_factor')->leftjoin('variable','id_variable','=','fk_id_variable')->where([['factor.estado','=',true],['variable.estado','=',true],['fk_id_formula', '=', $request->id]])->get();
		$form = (Formula::select('estado','descripcion')->where('id_formula','=',$request->id)->get())[0];
		return [$form, $fac, $var, $subf];
	}

	public function getAllForm(){
		$form = Formula::select('id_formula','nombre')->get();
		return $form;
	}

	public function getForm(){
		$form = Formula::select('id_formula','nombre')->where('id_formula','<>',1)->get();
		return $form;
	}
}
