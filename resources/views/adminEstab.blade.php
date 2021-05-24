@extends('layouts.loged')

@section('title')
	<title>Inicio | Gestión de Inventario | Gestionar Establecimientos de Servicio</title>
@endsection

@section('style')
	<script src="{{ asset("js/panelShowHide.js") }}"></script>
@endsection

@section('ubication')
	<span class="menuHoriTextN1">&nbsp;|&nbsp;</span><a href="{{ route('home') }}" class="menuHoriTextN1">Inicio</a><span class="menuHoriTextN2">&nbsp;|&nbsp;</span><a href="{{ route('inventary') }}" class="menuHoriTextN2">Gestión de inventario turístico</a><span class="menuHoriTextN3">:: Gestionar Establecimientos de Servicio</span>
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
			<a href="{{ route('adminEstab.redirecToSection', "agregar") }}" class="{{$section=="agregar" ? 'panelBotonesActived' : 'panelBotonesInactived'}}"><span>Agregar</span></a>
			<a href="{{ route('adminEstab.redirecToSection', "modificar")}}" class="{{$section=="modificar" ? 'panelBotonesActived' : 'panelBotonesInactived'}}"><span>Modificar</span></a>
			<a href="{{ route('adminEstab.redirecToSection', "consultar") }}" class="{{$section=="consultar" ? 'panelBotonesActived' : 'panelBotonesInactived'}}"><span>Consultar</span></a>
		</div>
		<div class="divForm" id="divFormulario" style="width: 700px;">
			@switch($section)
				@case("agregar")
					@include('panels.adminEstab.add')
				@break

				@case("modificar")
					@include('panels.adminEstab.modify')
				@break

				@case("consultar")
					@include('panels.adminEstab.consult')
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
			@include('scripts.adminEstab.modify.selectedEstabList')
			@include('scripts.adminEstab.modify.fillNullEstabList')
			@include('scripts.adminEstab.searchEstab')
			@include('scripts.setVCheckToInput')
		@break

		@case("consultar")
			@include('scripts.adminEstab.consult.selectedEstabList')
			@include('scripts.adminEstab.consult.fillNullEstabList')
			@include('scripts.adminEstab.searchTip')
		@break

		@default
		@break
	@endswitch
@endsection