@extends('layouts.logedBase')

@section('title')
	<title>eAdmin MiRuta | Gestión de Inventario Turístico | Gestión de Tipologías</title>
@endsection

@section('style')
	<script src="{{ asset("js/panelShowHide.js") }}"></script>
@endsection

@section('ubication')
	<span class="menuHoriTextN1">&nbsp;|&nbsp;</span><a href="{{ route('home') }}" class="menuHoriTextN1">Inicio</a><span class="menuHoriTextN2">&nbsp;|&nbsp;</span><a href="{{ route('inventary') }}" class="menuHoriTextN2">Gestión de Inventario Turístico</a><span class="menuHoriTextN3">:: Gestión de Tipologías</span>
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
			<a href="{{ route('tipologia.redirecToSection', "agregar") }}" class="{{$section=="agregar" ? 'panelBotonesActived' : 'panelBotonesInactived'}}"><span>Agregar</span></a>
			<a href="{{ route('tipologia.redirecToSection', "modificar")}}" class="{{$section=="modificar" ? 'panelBotonesActived' : 'panelBotonesInactived'}}"><span>Modificar</span></a>
			<a href="{{ route('tipologia.redirecToSection', "consultar") }}" class="{{$section=="consultar" ? 'panelBotonesActived' : 'panelBotonesInactived'}}"><span>Consultar</span></a>
		</div>
		<div class="divForm" id="divFormulario" width="700px">
			@switch($section)
				@case("agregar")
					@include('panels.adminTipology.add')
				@break

				@case("modificar")
					@include('panels.adminTipology.modify')
				@break

				@case("consultar")
					@include('panels.adminTipology.consult')
				@break

				@default
				@break
			@endswitch
		</div>
	</div>
@endsection

@section('script')
	@switch($section)
		@case("modificar")
			@include('scripts.adminTipology.modify.selectedTipList')
			@include('scripts.adminTipology.modify.fillNullTipList')
			@include('scripts.adminTipology.searchTip')
			@include('scripts.setVCheckToInput')
		@break

		@case("consultar")
			@include('scripts.adminTipology.List_searchTipologys')
		@break

		@default
		@break
	@endswitch
@endsection