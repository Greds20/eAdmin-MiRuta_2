<!DOCTYPE html>
	@extends('layouts.loginBase')

	@section('title')
		<title>eAdmin MiRuta | Iniciar Sesión</title>
	@endsection

	@section('style')
		<link rel="stylesheet" type="text/css" href="css/main.css">
	@endsection
	

	@section('content')
		<div class="container-login"> <!--fondo, centra los elementos que lo contienen, main.css--->
			<div class="wrap-login">		<!--si se quita se centra los elementos del panel, main.css-->
				<form class="padding-panels validate-form" action="/backend/login.php"  method="post">
					<div class="login-form-title same_margin">
						<div class="login-form-titleline"></div>
						<div class="login-form-title-text"> 
							<span class="login-form-titletext-e login-text">
								e
							</span>
							<span class="login-form-titletext login-text">
								ADMIN
							</span>
						</div>
					</div>
					<span class="login-form-text login-text same_margin">
						Ingresa tus datos para iniciar sesión
					</span>
					<div class="same_margin">
						<div class="wrap-input validate-input" data-validate = "Ingrese el nombre de usuario" style="margin-bottom: 15px; ">
							<div class="input-image"></div>
							<input class="input" type="text" name="usu" placeholder="Usuario">
							<span class="symbol-input">
								<i class="fa fa-envelope" aria-hidden="true"></i>
							</span>
						</div>
						<div class="wrap-input validate-input" data-validate = "Ingrese la contraseña">
							<div class="input-image"></div>
							<input class="input" type="password" name="pas" placeholder="Contraseña">
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
					<img src="img/icons/loginIcon.png" alt="IMG">
					<span class="login-text login-desc_text">
						Inicia sesión con tu cuenta de MiRuta para gestionar los usuarios e inventario turístico.
					</span>
				</div>
			</div>
		</div>
	@endsection
</html >