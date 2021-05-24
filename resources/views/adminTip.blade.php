@extends('layouts.loged')

@section('title')
	<title>Inicio | Gestión de Inventario | Gestionar Tipologías</title>
@endsection

@section('style')
	<script src="{{ asset("js/panelShowHide.js") }}"></script>
@endsection

@section('ubication')
	<span class="menuHoriTextN1">&nbsp;|&nbsp;</span><a href="{{ route('home') }}" class="menuHoriTextN1">Inicio</a><span class="menuHoriTextN2">&nbsp;|&nbsp;</span><a href="{{ route('inventary') }}" class="menuHoriTextN2">Gestión de inventario turístico</a><span class="menuHoriTextN3">:: Gestión de Tipologías</span>
@endsection

@section('secundario')
	@switch($section)
		@case("agregar")
			@include('panels.secundary.alertFormFactor')
		@break

		@case("modificar")
			@include('panels.secundary.selectPoiMod')
			@include('panels.secundary.alertFormFactor')
		@break
		@default
		@break
	@endswitch
@endsection

@section('content')
	<div class="panelContenido">
		<div class="panelBotones">
			<a href="{{ route('adminTipologias.redirecToSection', "agregar") }}" class="{{$section=="agregar" ? 'panelBotonesActived' : 'panelBotonesInactived'}}"><span>Agregar</span></a>
			<a href="{{ route('adminTipologias.redirecToSection', "modificar")}}" class="{{$section=="modificar" ? 'panelBotonesActived' : 'panelBotonesInactived'}}"><span>Modificar</span></a>
			<a href="{{ route('adminTipologias.redirecToSection', "consultar") }}" class="{{$section=="consultar" ? 'panelBotonesActived' : 'panelBotonesInactived'}}"><span>Consultar</span></a>
		</div>
		<div class="divForm" id="divFormulario" style="width: 700px;">
			@switch($section)
				@case("agregar")
					@include('panels.adminTip.add')
				@break

				@case("modificar")
					@include('panels.adminTip.modify')
				@break

				@case("consultar")
					@include('panels.adminTip.consult')
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

		@break

		@case("modificar")
			@include('scripts.adminTip.modify.selectedTipList')
			@include('scripts.adminTip.modify.fillNullTipList')
			@include('scripts.adminTip.searchTip')
			@include('scripts.setVCheckToInput')
		@break

		@case("consultar")
			@include('scripts.adminTip.consult.selectedTipList')
			@include('scripts.adminTip.consult.fillNullTipList')
			@include('scripts.adminTip.searchTip')
			
		@break

		@default
		@break
	@endswitch
@endsection