@extends('layouts.loged')

@section('title')
	<title>Inicio | Gestión de Inventario</title>
@endsection

@section('style')
@endsection

@section('ubication')
	<span class="menuHoriTextN1">&nbsp;|&nbsp;</span><a href="{{ route('home') }}" class="menuHoriTextN1">Inicio</a><span class="menuHoriTextN2">&nbsp;|&nbsp;</span><a href="{{ route('inventary') }}" class="menuHoriTextN2">Gestión de inventario turístico</a>
@endsection

@section('content')
	<div class="menuMetro">
		@include('menuMetro.inventaryMetro')
	</div>
@endsection

@section('script')
@endsection