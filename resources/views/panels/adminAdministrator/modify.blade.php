<form method="POST" action="{{ route('administradorCrud.update') }}" enctype="multipart/form-data">
	@csrf
	<input type="hidden" name="id" id="id" required="" maxlength="2">
	<div class="rowsForm">
		<h3>Alias</h3>
		<div class="divInputxButton">
			<input type="text" class="inputSimple" name="alias" id="alias" placeholder="Alias" required="" maxlength="30" autocomplete="off" style="width: 87%;">
			<a href="#" onclick="showPanel('#searchPanel')"><img src="{{ asset("img/icons/searchIcon.png") }}"></a>
		</div>
	</div>
	<div class="rowsForm">
		<h3>Estado</h3>
		<div class="divCheckSpan"><input type="checkbox" id="stateV">&nbsp;<span id="stateText">Inactivo</span></div>
		<input type="hidden" name="state" id="state" required="" maxlength="1">
	</div>
	<div class="monoDiv">
		<h3>Correo de recuperación de contraseña</h3>
		<div class="divInputxButton">
			<input type="text" class="inputSimple elementRM" id="email" autocomplete="off" readonly="">
			<a href="#" class="aTagBtnText" id="btnShowSetCoord">Recuperar contraseña</a>
		</div>
	</div>
	<div class="monoDiv divBottomForm">
		<button class="formAddPoiBtn" type="submit">Guardar</button>
	</div>
</form>