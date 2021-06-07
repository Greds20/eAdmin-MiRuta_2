@extends('layouts.logedBase')

@section('title')
	<title>eAdmin MiRuta | Gestión de Fórmulas de Ponderación</title>
@endsection

@section('style')
	<script src="{{ asset("js/panelShowHide.js") }}"></script>
@endsection

@section('ubication')
	<span class="menuHoriTextN1">&nbsp;|&nbsp;</span><a href="{{ route('home') }}" class="menuHoriTextN1">Inicio</a><span class="menuHoriTextN2">&nbsp;|&nbsp;</span><span class="menuHoriTextN3">Gestión de Fórmulas de Ponderación</span>
@endsection

@section('secundario')
	@switch($section)
		@case("agregar")
			@include("panels.secundary.alertFormFactor")
			@include("panels.secundary.adminSubF")
		@break

		@case("modificar")
			@include("panels.secundary.alertFormFactor")
			@include("panels.secundary.selectItem")
			@include("panels.secundary.adminSubF")
		@break

		@case("consultar")
			@include("panels.secundary.selectItem")
		@break

		@default
		@break
	@endswitch
@endsection

@section('content')
	<div class="panelContenido">
		<div class="panelBotones">
			<a href="{{ route('formulaCrud.redirecToSection', "agregar") }}" class="{{$section=="agregar" ? 'panelBotonesActived' : 'panelBotonesInactived'}}"><span>Agregar</span></a>
			<a href="{{ route('formulaCrud.redirecToSection', "modificar") }}" class="{{$section=="modificar" ? 'panelBotonesActived' : 'panelBotonesInactived'}}"><span>Modificar</span></a>
			<a href="{{ route('formulaCrud.redirecToSection', "consultar")}}" class="{{$section=="consultar" ? 'panelBotonesActived' : 'panelBotonesInactived'}}"><span>Consultar</span></a>
		</div>
		<div class="divFormTable" style="width: 1500px;">
			@switch($section)
				@case("agregar")
					@include('panels.adminFormula.add')
				@break

				@case("modificar")
					@include('panels.adminFormula.mod')
				@break

				@case("consultar")
					@include('panels.adminFormula.consult')
				@break
				@default
				@break
			@endswitch
		</div>
	</div>
@endsection

@section('script')
	@switch($section)
		@case("agregar")
			@include('scripts.adminFormula.addxmod.createSFOriginal')
			@include('scripts.adminFormula.addxmod.promDetect')
			@include('scripts.adminFormula.addxmod.sumDetect')
			@include('scripts.adminFormula.addxmod.adminRowF')
			@include('scripts.adminFormula.addxmod.adminRowV')
			@include('scripts.adminFormula.addxmod.adminRowSF')
			@include('scripts.adminFormula.addxmod.fillTSF')
			@include('scripts.adminFormula.addxmod.createSF')
			@include('scripts.adminFormula.addxmod.saveSF')
		@break

		@case("modificar")
			@include('scripts.adminFormula.mod.fillForm')
			@include('scripts.adminFormula.addxmod.promDetect')
			@include('scripts.adminFormula.addxmod.sumDetect')
			@include('scripts.adminFormula.mod.fillTables')
			@include('scripts.adminFormula.addxmod.adminRowF')
			@include('scripts.adminFormula.addxmod.adminRowV')
			@include('scripts.adminFormula.addxmod.adminRowSF')
			@include('scripts.adminFormula.addxmod.fillTSF')
			@include('scripts.adminFormula.addxmod.createSF')
			@include('scripts.adminFormula.addxmod.saveSF')
		@break

		@case("consultar")
			@include('scripts.adminFormula.consult.fillForm')
			@include('scripts.adminFormula.consult.fillTables')
		@break

		@default
		@break
	@endswitch
@endsection