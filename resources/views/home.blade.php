@extends('layouts.loged')

@section('title')
	<title>Inicio</title>
@endsection

@section('style')
	
@endsection

@section('ubication')
	<span class="menuHoriTextN1">&nbsp;|&nbsp;</span><a href="{{ route('home') }}" class="menuHoriTextN1">Inicio</a>
@endsection

@section('content')
	<div class="menuMetro">
		@include('menuMetro.homeMetro')
	</div>
@endsection

@section('script')
	<script src="js/main.js"></script>
@endsection