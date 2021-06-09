<div>
	<a href="{!! ((session('usuario'))['FK_ID_ROL'] == 1) ? route('administradorCrud.redirecToSection', "agregar") : "#" !!}"><img src="img/menu/usersMetroIcon.png" alt="IMG" class="inicioBoton"></a>
	<a href="{!! ((session('usuario'))['FK_ID_ROL'] == 1) ? route('log') : "#" !!}"><img src="img/menu/monitorMetroIcon.png" alt="IMG" class="inicioBoton"></a>
</div>
<div>
	<a href="{!! ((session('usuario'))['FK_ID_ROL'] == 2) ? route('inventary') : "#" !!}"><img src="img/menu/inventaryMetroIcon.png" alt="IMG" class="inicioBoton"></a>
	<a href="{!! ((session('usuario'))['FK_ID_ROL'] == 2) ? route('formulaCrud.redirecToSection', "agregar") : "#" !!}"><img src="img/menu/formulaMetroIcon.png" alt="IMG" class="inicioBoton"></a>
</div>

