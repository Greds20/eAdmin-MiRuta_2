@extends('layouts.logedBase')

@section('title')
	<title>eAdmin MiRuta | Gestión de Inventario | Gestionar Establecimientos de Servicio</title>
@endsection

@section('style')
	<script src="{{ asset("js/panelShowHide.js") }}"></script>

	@if($section == "agregar" || $section == "modificar")
		<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css">
		<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
	@endif
@endsection

@section('ubication')
	<span class="menuHoriTextN1">&nbsp;|&nbsp;</span><a href="{{ route('home') }}" class="menuHoriTextN1">Inicio</a><span class="menuHoriTextN2">&nbsp;|&nbsp;</span><a href="{{ route('inventary') }}" class="menuHoriTextN2">Gestión de Inventario Turístico</a><span class="menuHoriTextN3">:: Gestión de Establecimientos de Servicio</span>
@endsection

@section('secundario')
	@switch($section)
		@case("agregar")
			@include('panels.secundary.alertFormFactor')
			@include('panels.secundary.coordsMap')
		@break

		@case("modificar")
			@include('panels.secundary.selectPoiMod')
			@include('panels.secundary.alertFormFactor')
			@include('panels.secundary.coordsMap')
		@break
		@default
		@break
	@endswitch
@endsection

@section('content')
	<div class="panelContenido">
		<div class="panelBotones">
			<a href="{{ route('establecimiento.redirecToSection', "agregar") }}" class="{{$section=="agregar" ? 'panelBotonesActived' : 'panelBotonesInactived'}}"><span>Agregar</span></a>
			<a href="{{ route('establecimiento.redirecToSection', "modificar")}}" class="{{$section=="modificar" ? 'panelBotonesActived' : 'panelBotonesInactived'}}"><span>Modificar</span></a>
			<a href="{{ route('establecimiento.redirecToSection', "consultar") }}" class="{{$section=="consultar" ? 'panelBotonesActived' : 'panelBotonesInactived'}}"><span>Consultar</span></a>
		</div>
		<div class="divForm" id="divFormulario" style="width: 900px;">
			@switch($section)
				@case("agregar")
					@include('panels.adminEstablishment.add')
				@break

				@case("modificar")
					@include('panels.adminEstablishment.modify')
				@break

				@case("consultar")
					@include('panels.adminEstablishment.consult')
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
			@include('scripts.fillCB_Tipo')
			@include('scripts.fillCB_Town')
			@include('scripts.showMap&setCoord')
		@break

		@case("modificar")
			@include('scripts.adminEstablishment.List_searchEstablishment')
			@include('scripts.fillCB_Tipo')
			@include('scripts.fillCB_Town')
			@include('scripts.setVCheckToInput')
			@include('scripts.showMap&setCoord')
		@break

		@case("consultar")
			@include('scripts.adminEstablishment.List_searchEstablishment')
		@break

		@default
		@break
	@endswitch
@endsection