@extends('layouts.logedBase')

@section('title')
	<title>eAdmin MiRuta | Monitorizar Administradores</title>
@endsection

@section('style')
	<script src="{{ asset("js/panelShowHide.js") }}"></script>
@endsection

@section('ubication')
	<span class="menuHoriTextN1">&nbsp;|&nbsp;</span><a href="{{ route('home') }}" class="menuHoriTextN1">Inicio</a><span class="menuHoriTextN2">&nbsp;|&nbsp;</span><span class="menuHoriTextN3">Monitorizar Administradores</span>
@endsection

@section('secundario')
	@include('panels.secundary.selectPoiMod')
@endsection

@section('content')
	<div class="panelContenido">
		<div class="divFormNoButtons" id="divFormulario" style="width: 1010px;">
			@include('panels.log.content')
		</div>
	</div>
@endsection

@section('script')
	@include('scripts.log.fillEvxSexDate')
	@include('scripts.log.fillNullUserList')
	@include('scripts.log.searchUser')
	@include('scripts.log.consultLog')
	@include('scripts.log.downloadLog')
@endsection