@extends('layouts.logedBase')

@section('title')
	<title>eAdmin MiRuta | Perfil</title>
@endsection

@section('style')
	<script src="{{ asset("js/panelShowHide.js") }}"></script>
@endsection

@section('ubication')
	<span class="menuHoriTextN1">&nbsp;|&nbsp;</span><a href="{{ route('home') }}" class="menuHoriTextN1">Inicio</a><span class="menuHoriTextN2">&nbsp;|&nbsp;</span><span class="menuHoriTextN3">Perfil</span>
@endsection

@section('secundario')
	@include('panels.secundary.alertFormFactor')
@endsection

@section('content')
	<div class="panelContenido">
		<div class="divFormNoButtons" id="divFormulario" style="width: 800px;">
			@include('panels.adminAccount.account')
		</div>
	</div>
@endsection

@section('script')
	
@endsection