@extends('layouts.logedBase')

@section('title')
	<title>eAdmin MiRuta | Gestión de Administradores</title>
@endsection

@section('style')
	<script src="{{ asset("js/panelShowHide.js") }}"></script>
@endsection

@section('ubication')
	<span class="menuHoriTextN1">&nbsp;|&nbsp;</span><a href="{{ route('home') }}" class="menuHoriTextN1">Inicio</a><span class="menuHoriTextN2">&nbsp;|&nbsp;</span><span class="menuHoriTextN3">Gestión de Administradores</span>
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
			<a href="{{ route('administradorCrud.redirecToSection', "agregar") }}" class="{{$section=="agregar" ? 'panelBotonesActived' : 'panelBotonesInactived'}}"><span>Agregar</span></a>
			<a href="{{ route('administradorCrud.redirecToSection', "modificar")}}" class="{{$section=="modificar" ? 'panelBotonesActived' : 'panelBotonesInactived'}}"><span>Modificar</span></a>
			<a href="{{ route('administradorCrud.redirecToSection', "consultar") }}" class="{{$section=="consultar" ? 'panelBotonesActived' : 'panelBotonesInactived'}}"><span>Consultar</span></a>
		</div>
		<div class="divForm" id="divFormulario" style="width: 800px;">
			@switch($section)
				@case("agregar")
					@include('panels.adminAdministrator.add')
				@break

				@case("modificar")
					@include('panels.adminAdministrator.modify')
				@break

				@case("consultar")
					@include('panels.adminAdministrator.consult')
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
			@include('scripts.adminAdministrator.fillRols')
			@include('scripts.show&hidePass')
			@include('scripts.verifyPass')
		@break

		@case("modificar")
			@include('scripts.setVCheckToInput')
			@include('scripts.adminAdministrator.modify.selectedUserList')
			@include('scripts.adminAdministrator.modify.fillNullUserList')
			@include('scripts.adminAdministrator.searchUser')
			
		@break

		@case("consultar")
			@include('scripts.adminAdministrator.selectedUserList')
			@include('scripts.adminAdministrator.fillNullUserList')
			@include('scripts.adminAdministrator.searchUser')
		@break

		@default
		@break
	@endswitch
@endsection