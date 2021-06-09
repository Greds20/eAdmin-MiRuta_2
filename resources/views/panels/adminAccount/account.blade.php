<form method="POST" action="{{ route('cuentaCrud.updatePersonal', ["alias"=>$infoAdmin->alias]) }}" enctype="multipart/form-data">
	@csrf
	<div class="monoDiv">
		<h3 class="titleH3Form">Información personal</h3>
	</div>
	<div class="monoDiv">
		<h3>{!! $alias !!} ( {!! $infoAdmin->nombre !!} )</h3>
	</div>
	<div class="monoDivSep">
		<h3>Nombre</h3>
	</div>
	<div class="rowsForm">
		<input type="text" class="inputSimple" name="frname" maxlength="10" placeholder="Ingrese el primer nombre" required="" autocomplete="off" value="{!! $infoAdmin->prnombre !!}">
	</div>
	<div class="rowsForm">
		<input type="text" class="inputSimple" name="scname" maxlength="10" placeholder="Ingrese el segundo nombre" required="" autocomplete="off" value="{!! $infoAdmin->sgnombre !!}">
	</div>
	<div class="monoDivSep">
		<h3>Apellidos</h3>
	</div>
	<div class="rowsForm">
		<input type="text" class="inputSimple" name="frsurname" maxlength="10" placeholder="Ingrese el primer apellido" required="" autocomplete="off" value="{!! $infoAdmin->prapellido !!}">
	</div>
	<div class="rowsForm">
		<input type="text" class="inputSimple" name="scsurname" maxlength="10" placeholder="Ingrese el segundo apellido" required="" autocomplete="off" value="{!! $infoAdmin->sgapellido !!}">
	</div>
	<div class="monoDiv">
		<h3>Correo</h3>
		<input type="text" class="inputSimple" name="email" maxlength="40" required="" autocomplete="off" placeholder="Ingrese su correo electronico personal" value="{!! $infoAdmin->correo !!}">
	</div>
	<div class="monoDiv divBottomForm">
		<button class="formAddPoiBtn" type="submit">Guardar cambios</button>
	</div>
</form>
<form method="POST" style="margin-top: 20px;" action="{{ route('cuentaCrud.updatePass', ["alias"=>$infoAdmin->alias]) }}" enctype="multipart/form-data">
	@csrf
	<div class="monoDiv">
		<h3 class="titleH3Form">Contraseña</h3>
	</div>
	<div class="monoDivSep">
		<h3>Contraseña actual</h3>
	</div>
	<div class="monoDiv">
		<input type="password" class="inputSimple" name="oldpass" maxlength="40" placeholder="Ingrese la contraseña actual" required="">
	</div>
	<div class="monoDivSep">
		<h3>Nueva contraseña</h3>
	</div>
	<div class="rowsForm">
		<input type="password" class="inputSimple" name="newpassf" maxlength="40" placeholder="Nueva contraseña" required="">
	</div>
	<div class="rowsForm">
		<input type="password" class="inputSimple" name="newpassl" maxlength="40" placeholder="Repetir nueva contraseña" required="">
	</div>
	<div class="monoDiv divBottomForm">
		<button class="formAddPoiBtn" type="submit">Guardar cambios</button>
	</div>
</form>