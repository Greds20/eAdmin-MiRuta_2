@extends('layouts.logedBase')

@section('title')
	<title>eAdmin MiRuta | Gestión de Inventario | Gestionar PoIs</title>
@endsection

@section('style')
	<script src="{{ asset("js/panelShowHide.js") }}"></script>

	@if($section == "agregar" || $section == "modificar")
		<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css">
		<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
	@endif
@endsection

@section('ubication')
	<span class="menuHoriTextN1">&nbsp;|&nbsp;</span><a href="{{ route('home') }}" class="menuHoriTextN1">Inicio</a><span class="menuHoriTextN2">&nbsp;|&nbsp;</span><a href="{{ route('inventary') }}" class="menuHoriTextN2">Gestión de Inventario Turístico</a><span class="menuHoriTextN3">:: Gestión de PoIs</span>
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
			<a href="{{ route('poiCrud.redirecToSection', "agregar") }}" class="{{$section=="agregar" ? 'panelBotonesActived' : 'panelBotonesInactived'}}"><span>Agregar</span></a>
			<a href="{{ route('poiCrud.redirecToSection', "modificar")}}" class="{{$section=="modificar" ? 'panelBotonesActived' : 'panelBotonesInactived'}}"><span>Modificar</span></a>
			<a href="{{ route('poiCrud.redirecToSection', "consultar") }}" class="{{$section=="consultar" ? 'panelBotonesActived' : 'panelBotonesInactived'}}"><span>Consultar</span></a>
		</div>
		<div class="divForm" id="divFormulario" style="width: 1010px;">
			@switch($section)
				@case("agregar")
					@include('panels.adminPoi.add')
				@break

				@case("modificar")
					@include('panels.adminPoi.modify')
				@break

				@case("consultar")
					@include('panels.adminPoi.consult')
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
			@include('scripts.adminPoi.fillTownxTipo')
			@include('scripts.adminPoi.selectedTipoList')
			@include('scripts.adminPoi.loadImageReview')
			@include('scripts.showMap&setCoord')
		@break

		@case("modificar")
			
			@include('scripts.adminPoi.fillPoiList')
			@include('scripts.adminPoi.fillTownxTipo')
			@include('scripts.adminPoi.selectedTipoList')
			@include('scripts.adminPoi.searchPoi')
			@include('scripts.adminPoi.selectedPoiList')
			@include('scripts.adminPoi.loadImageReview')
			@include('scripts.adminPoi.setVCheckToInput')
			@include('scripts.showMap&setCoord')
		@break

		@case("consultar")
			@include('scripts.adminPoi.selectedPoiList')
			@include('scripts.adminPoi.searchPoi')
			@include('scripts.adminPoi.fillPoiList')
			
		@break

		@default
		@break
	@endswitch
@endsection