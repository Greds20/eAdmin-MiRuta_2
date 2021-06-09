<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	@yield('title')
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="{{ asset("img/icons/pageImage.ico") }}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset("css/main.css") }}">
	<script src="{{ asset("js/jquery-3.5.1.min.js") }}"></script>
	@yield('style')
</head>
<body>
	<div class="limiterLoged horizontalDiv">
		<div class="menuVert">
			<ul>
				<li><a href="{{ route('cuentaCrud.redirecToAccount', "SISTEMA") }}" class="perfilPanel"><img src="{{ asset("img/icons/adminSIsIcon.png") }}" alt="IMG"><div><h3>{{ (session('usuario'))['alias'] }}</h3><span>Rol: {{ ((session('usuario'))['FK_ID_ROL'] == 1) ? "Administrador del sistema" : "Administrador del inventario turístico"}}</span><span>Nombre: {{ (session('usuario'))['prNombre']." ".(session('usuario'))['sgNombre']." ".(session('usuario'))['prApellido']." ".(session('usuario'))['sgApellido'] }}</span></div></a></li>
				<li><a href="{!! ((session('usuario'))['FK_ID_ROL'] == 1) ? route('administradorCrud.redirecToSection', "agregar") : "#" !!}"><img src="{{ asset("img/icons/usersIcon.png") }}" alt="IMG"></a></li>
				<li><a href="{!! ((session('usuario'))['FK_ID_ROL'] == 1) ? route('log') : "#" !!}"><img src="{{ asset("img/icons/monitorIcon.png") }}" alt="IMG"></a></li>
				<li><a href="{!! ((session('usuario'))['FK_ID_ROL'] == 2) ? route('inventary') : "#" !!}"><img src="{{ asset("img/icons/inventaryIcon.png") }}" alt="IMG"></a></li>
				<li><a href="{!! ((session('usuario'))['FK_ID_ROL'] == 2) ? route('formulaCrud.redirecToSection', "agregar") : "#" !!}"><img src="{{ asset("img/icons/formulaIcon.png") }}" alt="IMG"></a></li>
			</ul>
			<a href="#" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();"><img src="{{ asset("img/icons/logoutIcon.png") }}" alt="IMG" style="height: 62px; width: 62px;"></a>
			<form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
		</div>
		<div class="verticalDiv">
			<div class="menuHori">
				<div class="routeDiv">
					<img src="{{ asset("img/icons/homeIcon.png") }}" alt="IMG">
					@yield('ubication')
				</div>
				<div class="fontSystemxWarning"><a href="{{ route('poiFactorCrud.redirecToSection', "emparejar") }}" hidden="" class="textHover" id="warning"><img src="{{ asset("img/icons/warningIcon.png") }}"><span id="numWarnings"></span></a><h1>MiRuta</h1>
				</div>
			</div>
			<div class="absoluteContend">
				<div class="divOscurecer" id="panelOsc" hidden="" style="z-index: 1;"></div>
				@yield('secundario')
				<div class="contendLimiter">
					@yield('content')
				</div>
			</div>
		</div>
	</div>

</body>
	@yield('script')
	@include('scripts.inspectPois')
</html >