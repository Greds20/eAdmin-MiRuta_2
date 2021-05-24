@extends('layouts.loged')

@section('title')
	<title>Inicio | Gestión de Inventario | Gestionar POIs</title>
@endsection

@section('style')
	<script src="{{ asset("js/panelShowHide.js") }}"></script>
@endsection

@section('ubication')
	<span class="menuHoriTextN1">&nbsp;|&nbsp;</span><a href="{{ route('home') }}" class="menuHoriTextN1">Inicio</a><span class="menuHoriTextN2">&nbsp;|&nbsp;</span><a href="{{ route('inventary') }}" class="menuHoriTextN2">Gestión de inventario turístico</a><span class="menuHoriTextN3">:: Gestión de PoI</span>
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
			<a href="{{ route('adminPoi.redirecToSection', "agregar") }}" class="{{$section=="agregar" ? 'panelBotonesActived' : 'panelBotonesInactived'}}"><span>Agregar</span></a>
			<a href="{{ route('adminPoi.redirecToSection', "modificar")}}" class="{{$section=="modificar" ? 'panelBotonesActived' : 'panelBotonesInactived'}}"><span>Modificar</span></a>
			<a href="{{ route('adminPoi.redirecToSection', "consultar") }}" class="{{$section=="consultar" ? 'panelBotonesActived' : 'panelBotonesInactived'}}"><span>Consultar</span></a>
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

		@break

		@case("modificar")
			
			@include('scripts.adminPoi.fillPoiList')
			@include('scripts.adminPoi.fillTownxTipo')
			@include('scripts.adminPoi.selectedTipoList')
			@include('scripts.adminPoi.searchPoi')
			@include('scripts.adminPoi.selectedPoiList')
			@include('scripts.adminPoi.loadImageReview')

			@include('scripts.adminPoi.setVCheckToInput')
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