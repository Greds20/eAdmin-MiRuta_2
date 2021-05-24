@extends('layouts.loged')

@section('title')
	<title>Inicio | Gestión de Administradores</title>
@endsection

@section('style')
	<script src="{{ asset("js/panelShowHide.js") }}"></script>
@endsection

@section('ubication')
	<span class="menuHoriTextN1">&nbsp;|&nbsp;</span><a href="{{ route('home') }}" class="menuHoriTextN1">Inicio</a><span class="menuHoriTextN3">:: Gestión de Administradores</span>
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
			<a href="{{ route('adminAdministradores.redirecToSection', "agregar") }}" class="{{$section=="agregar" ? 'panelBotonesActived' : 'panelBotonesInactived'}}"><span>Agregar</span></a>
			<a href="{{ route('adminAdministradores.redirecToSection', "modificar")}}" class="{{$section=="modificar" ? 'panelBotonesActived' : 'panelBotonesInactived'}}"><span>Modificar</span></a>
			<a href="{{ route('adminAdministradores.redirecToSection', "consultar") }}" class="{{$section=="consultar" ? 'panelBotonesActived' : 'panelBotonesInactived'}}"><span>Consultar</span></a>
		</div>
		<div class="divForm" id="divFormulario" style="width: 800px;">
			@switch($section)
				@case("agregar")
					@include('panels.adminAdministrators.add')
				@break

				@case("modificar")
					@include('panels.adminAdministrators.modify')
				@break

				@case("consultar")
					@include('panels.adminAdministrators.consult')
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
			@include('scripts.adminAdministrators.fillRols')
		@break

		@case("modificar")
			@include('scripts.setVCheckToInput')
			@include('scripts.adminAdministrators.modify.selectedUserList')
			@include('scripts.adminAdministrators.modify.fillNullUserList')
			@include('scripts.adminAdministrators.searchUser')
			
		@break

		@case("consultar")
			@include('scripts.adminAdministrators.selectedUserList')
			@include('scripts.adminAdministrators.fillNullUserList')
			@include('scripts.adminAdministrators.searchUser')
		@break

		@default
		@break
	@endswitch
@endsection