<!DOCTYPE html>
	@extends('layouts.loginBase')

	@section('title')
		<title>eAdmin MiRuta | Iniciar Sesión</title>
	@endsection

	@section('style')
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<script src="{{ asset("js/jquery-3.5.1.min.js") }}"></script>
		<script src="{{ asset("js/panelShowHide.js") }}"></script>
	@endsection

	@section('secundario')
		@include('panels.secundary.alertFormFactor')
	@endsection
	

	@section('content')
		<div class="container-login"> <!--fondo, centra los elementos que lo contienen, main.css--->
			<div class="wrap-login">		<!--si se quita se centra los elementos del panel, main.css-->
				<form class="padding-panels validate-form" action="{{ route('login') }}"  method="post">
					@csrf
					<div class="login-form-title same_margin">
						<span class="login-form-titletext login-text">Inicio de Sesión</span>
					</div>
					<span class="login-form-text login-text same_margin">
						Ingresa tus datos para iniciar sesión
					</span>
					<div class="same_margin">
						<div class="wrap-input validate-input" data-validate = "Ingrese el nombre de usuario" style="margin-bottom: 15px; ">
							<div class="boxImage"><img src="{{ asset('img/icons/userIcon.png') }}"></div>
							<input class="inputSimple" type="text" name="alias" placeholder="Usuario" value="{{ old('alias') }}" autocomplete="off">
							<span class="symbol-input">
								<i class="fa fa-envelope" aria-hidden="true"></i>
							</span>
						</div>
						<div class="wrap-input validate-input" data-validate = "Ingrese la contraseña">
							<div class="boxImage"><img src="{{ asset('img/icons/passIcon.png') }}"></div>
							<input class="inputSimple" type="password" name="password" placeholder="Contraseña">
							<span class="symbol-input">
								<i class="fa fa-lock" aria-hidden="true"></i>
							</span>
						</div>
					</div>
					<div class="same_margin">
						<a class="login-text login-form-ref" href="#">
							¿Has olvidado la contraseña?
						</a>
					</div>
					<div class="container-login-form-btn">
						<button class="login-form-btn" type="submit"> <!-- boton enviar, efectos en main.css -->
							Iniciar Sesión
						</button>
					</div>
				</form>
				<div class="login-descripcion padding-panels">
					<img src="{{ asset('img/icons/tituloIcon.png') }}" alt="IMG">
					<span class="login-text login-desc_text">
						Inicia sesión con tu cuenta de MiRuta eAdmin para gestionar los usuarios, inventario turístico y fórmula de ponderación de puntos de interés.
					</span>
				</div>
			</div>
		</div>
	@endsection
</html >